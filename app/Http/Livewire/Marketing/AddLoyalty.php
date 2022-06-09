<?php

namespace App\Http\Livewire\Marketing;

use Livewire\Component;
use Auth;

use App\Models\Loyalty;

use App\Notifications\NotifyUser;


class AddLoyalty extends Component
{
	public $user;
    public $visits;
    public $what;
    public $rabat;

    protected $rules = [
        'visits' => 'required|numeric|min:1',
        'rabat' => 'required|numeric|min:1',
    ];

    protected $listeners = ['createLoyalty' => 'createLoyalty'];

	public function mount()
	{
        $this->user = Auth::user();
	}

    public function render()
    {
        return view('marketing.add_loyalty');
    }

    public function createLoyalty()
    {

        $this->validate();

        $save = new Loyalty;
        $save->user_id = $this->user->id;
        $save->team_id = $this->user->current_team_id;
        $save->visit = $this->visits;
        $save->what = $this->what;
        $save->rabat = $this->rabat;
        $save->save();

        $this->user->notify(new NotifyUser('Regułka programu lojalnościowego została dodana.'));

        $this->visits = 0;
        $this->what = "";
        $this->rabat = 0;   

        $this->emit('refreshLoyalty');
        $this->dispatchBrowserEvent('close-modal', ['modal' => 'addLoyalty']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Regułka została dodana poprawnie.']);
    }
}
