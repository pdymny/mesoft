<?php

namespace App\Http\Livewire\Communicator;

use Livewire\Component;

class LoadMessages extends Component
{
	public $tab;

	protected $listeners = ['refreshChat' => '$refresh'];

    public function render()
    {
        return view('communicator.load_chat');
    }
}
