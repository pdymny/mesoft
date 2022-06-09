<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use Auth;
use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\User;


class ShowPatient extends Component
{
    public function render(Request $request)
    {
    
    	$user = Auth::user();

    	$patient = Patient::find($request->id);


        return view('patients.card', array('patient' => $patient));
    }

}
