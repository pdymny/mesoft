<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use Auth;
use Carbon\Carbon;

use App\Models\Email;
use App\Models\Team;
use App\Models\Patient;

use App\Notifications\NotifyUser;

class NewEmail extends Component
{
	public $text;
	public $patient;
	public $user;

    protected $rules = [
        'text' => 'required|string|min:3|max:200',
    ];

	protected $listeners = ['openEmail' => 'openEmail'];

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
        return view('visits.new_email');
    }

    public function openEmail(Patient $patient)
    {
    	$this->patient = $patient;
    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'sendEmail']);
    }

    public function saveSentEmail()
    {
        $this->validate();
        
    	$email = new Email;
    	$email->team_id = $this->user->current_team_id;
    	$email->visit_id = 0;
    	$email->patient_id = $this->patient->id;
    	$email->date_send = Carbon::now();
    	$email->status = 0;
    	$email->message = $this->text;
    	$email->save();

    	Team::find($this->user->current_team_id)->decrement('pack_email');

        $this->user->notify(new NotifyUser('E-mail do <i>'.$this->patient->firstname.' '.$this->patient->name.'</i> został dodany do wysłania.'));

    	$this->dispatchBrowserEvent('close-modal', ['modal' => 'sendEmail']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'E-mail został dodany do wysłania.']);
    }
}
