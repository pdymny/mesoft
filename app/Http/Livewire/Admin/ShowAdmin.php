<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Auth;
use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\User;


class ShowAdmin extends Component
{

    public function render(Request $request)
    {
    
    	$user = Auth::user();

    	$patient = Patient::find($request->id);


        return view('admin.show');
    }

}
