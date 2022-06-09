<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowFunkcje extends Component
{
    public function render()
    {
        return view('start.funkcje')->layout('layouts.start');
    }
}
