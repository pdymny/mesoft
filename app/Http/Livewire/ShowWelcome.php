<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowWelcome extends Component
{
    public function render()
    {
        return view('start.welcome')->layout('layouts.start');
    }
}
