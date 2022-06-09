<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use Illuminate\Http\Request;

use App\Models\Team;

use App\Notifications\NotifyUser;

class SaveSettingsWidget extends Component
{
    use WithFileUploads;

	public $switch_widget;
	public $delete_visit_widget;
	public $logo_widget;
	public $name_widget;
	public $url_widget;
	public $user;

    protected $rules = [
        'switch_widget' => 'required|boolean',
        'delete_visit_widget' => 'required|boolean',
        'name_widget' => 'nullable|string|max:200',
        'url_widget' => 'nullable|string|max:200',
    ];

	protected $listeners = ['ShowWidgetRefresh' => '$refresh'];


	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
    	$this->switch_widget = $this->user->currentTeam->switch_widget;
    	$this->delete_visit_widget = $this->user->currentTeam->delete_visit_widget;
    	$this->logo_widget = $this->user->currentTeam->logo_widget;
    	$this->name_widget = $this->user->currentTeam->name_widget;
    	$this->url_widget = $this->user->currentTeam->url_widget;

        return view('settings.widget_settings');
    }

    public function saveSettingsWidget(Request $request)
    {
        $this->validate();


    	$team = Team::find($this->user->current_team_id);
    	$team->switch_widget = $this->switch_widget;
    	$team->delete_visit_widget = $this->delete_visit_widget;
    	$team->name_widget = $this->name_widget;
    	$team->url_widget = $this->url_widget;
    	$team->save();

        $this->user->notify(new NotifyUser('Zmieniono ustawienia widgetu.'));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Zmieniono poprawnie ustawienia widgetu.']);
        
    	$this->emit('ShowWidgetRefresh');
    }
}
