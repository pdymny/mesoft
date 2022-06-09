<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Auth;

use App\Models\Card;
use App\Models\User;
use App\Models\Stock;

use App\Notifications\NotifyUser;

class AddCard extends Component
{

	public $title;
    public $text;

    protected $rules = [
        'title' => 'required|string|min:3',
        'text' => 'required|string|min:3|max:500',
    ];

    public function hydrate() 
    {
    	$this->dispatchBrowserEvent('xd', ['modal' => 'addCart']);
    }

    public function render()
    {
        return view('dashboard.addcard');
    }

    public function createCart(Card $card)
    {
        $user = Auth::user();

        $this->validate();

        $card->user_id = $user->id;
        $card->team_id = $user->current_team_id;
        $card->title = $this->title;
        $card->text = $this->text;
        $card->save();

        $user->notify(new NotifyUser('Karteczka o nazwie <i>'.$this->title.'</i> została dodana.'));

       	$this->dispatchBrowserEvent('close-modal', ['modal' => 'addCart']);
       	$this->emit('ShowCardRefresh');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Karteczka została dodana poprawnie.']);
    }
}
