<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;

use App\Modals\Patient;

use App\Notifications\NotifyUser;

class DeletePatient extends Component
{
	public $patient;

    public function render()
    {
        return view('patients.delete_patient');
    }

    public function deletePatient() 
    {
    	$this->patient->delete();

        $user = Auth::user();
        $user->notify(new NotifyUser('Pacjent o nazwie <i>'.$this->patient->firstname.' '.$this->patient->name.'</i> został usunięty.'));

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Usunięto pacjenta poprawnie.']);

    	return redirect('/patients');
    }
}
