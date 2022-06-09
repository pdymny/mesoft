<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowPomoc extends Component
{
    public function render()
    {
        return view('start.pomoc')->layout('layouts.start');
    }
}
