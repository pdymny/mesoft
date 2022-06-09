<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Auth;

use App\Models\Card;
use App\Models\User;

use App\Notifications\NotifyUser;

class CardDashboard extends Component
{

	protected $listeners = ['removeCard' => 'removeCard', 'ShowCardRefresh' => '$refresh'];

    public $test;


    public function render()
    {
    	$user = Auth::user();

    	$cards = Card::addSelect(['name' => User::select('name')
    			->whereColumn('user_id', 'users.id')
    			->limit(1)])
    		->where('team_id', $user->current_team_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.card', array('cards' => $cards));
    }

    public function removeCard(Card $card) 
    {
    	$user = Auth::user();

    	if($user->hasTeamRole($card, 'admin')) {
    		$card->delete();

            $user->notify(new NotifyUser('Kartka o nazwie <i>'.$card->title.'</i> została usunięta.'));
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Karteczka została usunięta poprawnie.']);
    	}
    }


}
