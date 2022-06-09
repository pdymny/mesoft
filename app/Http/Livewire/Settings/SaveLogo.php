<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Team;

use App\Notifications\NotifyUser;

class SaveLogo extends Component
{
	use WithFileUploads;

	public $logo_widget;
	public $user;

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
        return view('settings.save_logo');
    }

    public function save()
    {
    	$path = 'teams_logo/'.$this->user->current_team_id;
        $d_path = $this->logo_widget->store($path);

        Storage::setVisibility($d_path, 'public');

    	$doc = Team::find($this->user->current_team_id);
    	$doc->logo_widget = $d_path;
    	$doc->save();

      	$this->user->notify(new NotifyUser('Zmieniono logo widgetu.'));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Zmieniono poprawnie logo widgetu.']);
    }
}
