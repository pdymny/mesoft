<?php

namespace App\Http\Livewire\Communicator;

use Livewire\Component;
use Auth;
use App\Models\User;
use Chat;

class ShowCommunicator extends Component
{
	public $user;
	public $idConversation = 0;
    public $text;
    public $conversation;
    public $data_chat;

    protected $rules = [
        'text' => 'required|string|min:3',
    ];

	protected $listeners = [
							'getSwitch' => 'getSwitch',
							'refreshAll' => '$refresh',
							'sendMessagesConv' => 'sendMessagesConv'
						];

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
        return view('communicator.show', ['getConversation' => $this->getConversation()]);
    }

    public function getConversation()
    {
    	return Chat::conversations()->setPaginationParams(['sorting' => 'desc'])
		->setParticipant($this->user)
		->get()
		->toArray()['data'];
    }

    public function getSwitch($id)
    {
    	$this->idConversation = $id;

    	if($id > 0) {
    		$this->conversation = Chat::conversations()->getById($id);

    		$this->data_chat = $this->getData();

    		$this->dispatchBrowserEvent('chat_down');
    	}
    }

    private function getData()
    {
        if($this->idConversation > 0) {

	    	$message = Chat::conversation($this->conversation)->setParticipant($this->user)->setPaginationParams(['sorting' => 'asc'])->getMessages();

	    	Chat::conversation($this->conversation)->setParticipant($this->user)->readAll();

	    	foreach($message->toArray()['data'] as $tab) {

	    		$data[] = ['created_at' => $tab['created_at'], 'firstname' => $tab['sender']['firstname'], 'name' => $tab['sender']['name'], 'read_at' => $tab['read_at'], 'body' => $tab['body'], 'id' => $tab['id']];
	    	}

	    	return $data;
	    }	
    }

    public function sendMessagesConv()
    {
        $this->validate();
        
    	$conversation = Chat::conversations()->getById($this->conversation->id);
    	$message = Chat::message($this->text)
            ->from($this->user)
            ->to($conversation)
            ->send();

        $this->text = '';

        $this->data_chat = $this->getData();

  		$this->emit('refreshAll');
  		$this->dispatchBrowserEvent('chat_down');
    }
}
