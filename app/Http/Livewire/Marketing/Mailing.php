<?php

namespace App\Http\Livewire\Marketing;

use Livewire\Component;
use Auth;
use Carbon\Carbon;

use App\Models\Email;
use App\Models\Sms;
use App\Models\Team;
use App\Models\Client;

use App\Notifications\NotifyUser;

class Mailing extends Component
{
	public $text;
	public $user;
    public $send;
    public $count = 0;

    protected $rules = [
        'text' => 'required|string|min:3',
    ];

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
        if($this->send == 'email') {
            $this->count = Client::where('team_id', '=', $this->user->current_team_id)
                                ->where('email', '!=', '')
                                ->count();
        } elseif($this->send == 'sms') {
            $this->count = Client::where('team_id', '=', $this->user->current_team_id)
                                ->where('phone', '!=', '')
                                ->count();
        } else {
            $this->count = 0;
        }

        return view('marketing.mailing');
    }

    public function sendMailing()
    {
        $this->validate();

        if($this->send == 'email') {
            $this->sendEmail();
        } elseif($this->send == 'sms') {
            $this->sendSms();
        }
        
        $this->text = "";
        $this->send = "";
        $this->count = 0;
    }

    private function sendEmail()
    {
        $clients = Client::where('team_id', '=', $this->user->current_team_id)
                                ->where('email', '!=', '')
                                ->get();

        foreach($clients as $tab) {
            $email = new Email;
            $email->team_id = $this->user->current_team_id;
            $email->visit_id = 0;
            $email->patient_id = $tab->id;
            $email->date_send = Carbon::now();
            $email->status = 0;
            $email->message = $this->text;
            $email->save();

            Team::find($this->user->current_team_id)->decrement('pack_email');

            $this->user->notify(new NotifyUser('E-mail do <i>'.$tab->firstname.' '.$tab->name.'</i> został dodany do wysłania.'));
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'E-mail został dodany do wysłania.']);
        }

    }

    private function sendSms()
    {
        $clients = Client::where('team_id', '=', $this->user->current_team_id)
                                ->where('phone', '!=', '')
                                ->get();

        foreach($clients as $tab) {
            $sms = new Sms;
            $sms->team_id = $this->user->current_team_id;
            $sms->visit_id = 0;
            $sms->patient_id = $tab->id;
            $sms->date_send = Carbon::now();
            $sms->status = 0;
            $sms->message = $this->text;
            $sms->save();

            Team::find($this->user->current_team_id)->decrement('pack_sms');

            $this->user->notify(new NotifyUser('Sms do <i>'.$tab->firstname.' '.$tab->name.'</i> został dodany do wysłania.'));
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Sms został dodany do wyslania.']);
        }
    }

}
