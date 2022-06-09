<?php

namespace App\Http\Livewire\Communicator;

use Livewire\Component;
use Auth;
use Chat;

use App\Models\Membership;
use App\Models\User;

class NewCommunicator extends Component
{
	public $team;
	public $contact;
	public $user;
	public $text;
	public $participants;
	public $title;

    protected $rules = [
        'text' => 'required|string|min:3',
        'title' => 'required|string|min:3',
        'participants' => 'required'
    ];

	protected $listeners = ['refreshNew' => '$refresh', 'searchUser' => 'searchUser', 'sendMessages' => 'sendMessages'];

	public function mount()
	{
		$this->user = Auth::user();
		$this->team = $this->user->currentTeam->id;

		$this->contact = $this->user->currentTeam->allUsers();
	}

    public function render()
    {
        return view('communicator.new');
    }

    public function searchUser()
    {
    	$user = Membership::where('team_id', '=', $this->team)
    		->join('users', 'team_user.user_id', '=', 'users.id')
    		->get()->toArray();

    	$this->contact = $user;
    }

    public function sendMessages()
    {
        $this->validate();

    	$send = $this->participants;

    	$model[] = User::find($this->user->id);
    	foreach($send as $tab) {
    		$model[] = User::find($tab);
    	}
    	//dd($model);
    	$conversation = Chat::createConversation($model);
    	$message = Chat::message($this->text)
            ->from($this->user)
            ->to($conversation)
            ->send();
        $data = ['title' => $this->title];
		$conversation->update(['data' => $data]);

		$this->participants = 0;
		$this->title = '';
		$this->text = '';
		
		$this->emit('refreshAll');

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Wysłano wiadomość poprawnie.']);
    }
}
