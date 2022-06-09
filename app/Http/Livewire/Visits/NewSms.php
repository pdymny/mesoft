<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use Auth;
use Carbon\Carbon;

use App\Models\Sms;
use App\Models\Team;
use App\Models\Patient;

use App\Notifications\NotifyUser;

class NewSms extends Component
{
	public $text;
	public $patient;
	public $user;

    protected $listeners = ['openSms' => 'openSms'];
	
    protected $rules = [
        'text' => 'required|string|min:3|max:500',
    ];

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
        return view('visits.new_sms');
    }

    public function openSms(Patient $patient)
    {
    	$this->patient = $patient;
    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'sendSms']);
    }

    public function saveSentSms()
    {
        $this->validate();

    	$sms = new Sms;
    	$sms->team_id = $this->user->current_team_id;
    	$sms->visit_id = 0;
    	$sms->patient_id = $this->patient->id;
    	$sms->date_send = Carbon::now();
    	$sms->status = 0;
    	$sms->message = $this->text;
    	$sms->save();

    	Team::find($this->user->current_team_id)->decrement('pack_sms');

        $this->user->notify(new NotifyUser('SMS do <i>'.$this->patient->firstname.' '.$this->patient->name.'</i> został dodany do wysłania.'));

    	$this->dispatchBrowserEvent('close-modal', ['modal' => 'sendSms']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Sms został dodany do wysłania.']);
    }
}
