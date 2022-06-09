<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Auth;

use App\Models\Team;

use App\Notifications\NotifyUser;

class SaveSettingsNotify extends Component
{

	public $switch_sms;
	public $switch_email;
	public $sms_clock;
	public $email_clock;
	public $sms_text;
	public $email_text;
	public $user;

    protected $rules = [
        'switch_sms' => 'required|boolean',
        'switch_email' => 'required|boolean',
        'sms_clock' => 'required|numeric|min:1|max:48',
        'email_clock' => 'required|numeric|min:1|max:48',
        'sms_text' => 'required|string|min:3|max:200',
        'email_text' => 'required|string|min:3|max:500',
    ];

	protected $listeners = ['ShowNotifyRefresh' => '$refresh'];

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
    	$this->switch_sms = $this->user->currentTeam->switch_sms;
    	$this->switch_email = $this->user->currentTeam->switch_email;
    	$this->sms_clock = $this->user->currentTeam->sms_clock;
    	$this->email_clock = $this->user->currentTeam->email_clock;
    	$this->sms_text = $this->user->currentTeam->sms_text;
    	$this->email_text = $this->user->currentTeam->email_text;

        return view('settings.save_notify');
    }

    public function saveSettingsNotify()
    {
        $this->validate();

    	$team = Team::find($this->user->current_team_id);
    	$team->switch_sms = $this->switch_sms;
    	$team->switch_email = $this->switch_email;
    	$team->sms_clock = $this->sms_clock;
    	$team->email_clock = $this->email_clock;
    	$team->sms_text = $this->sms_text;
    	$team->email_text = $this->email_text;
    	$team->save();

        $this->user->notify(new NotifyUser('Zmieniono ustawienia powiadomień.'));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Zmieniono poprawnie ustawienia powiadomień.']);
        
    	$this->emit('ShowNotifyRefresh');
    }
}
