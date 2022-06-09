<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use Auth;

use App\Models\Patient;
use App\Models\User;


class ShowPatients extends Component
{

    public function render()
    {
        return view('patients.show');
    }

}
