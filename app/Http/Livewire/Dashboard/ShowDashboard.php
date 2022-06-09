<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Auth;

use App\Models\Card;
use App\Models\User;

class ShowDashboard extends Component
{
    public $test;

    public function render()
    {
        return view('dashboard.show');
    }
}
