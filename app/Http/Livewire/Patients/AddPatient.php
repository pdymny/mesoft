<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use Auth;

use App\Models\Patient;
use App\Models\User;

use App\Notifications\NotifyUser;

class AddPatient extends Component
{
    public $switch = 'create';
    public $idEdit = 0;
	public $firstname;
    public $name;
    public $pesel;
    public $email;
    public $phone;
    public $birth;
    public $gender;
    public $address_city;
    public $address_code;
    public $address_street;
    public $address_number;
    public $description;

    protected $rules = [
        'firstname' => 'required|string|min:3|max:100',
        'name' => 'required|string|min:3|max:100',
        'pesel' => 'required|numeric|min:5',
        'email' => 'required|email',
        'phone' => 'required|numeric|min:8',
        'birth' => 'nullable|date',
        'gender' => 'nullable',
        'address_city' => 'nullable|string',
        'address_code' => 'nullable|string',
        'address_street' => 'nullable|string',
        'address_number' => 'nullable|numeric',
        'description' => 'nullable|string|max:500',
    ];


    protected $listeners = ['editPatient' => 'editPatient',
                            'saveEditPatient' => 'saveEditPatient',
                            'addPatient' => 'addPatient',
                            ];


    public function render()
    {
        return view('patients.addpatient');
    }

    public function createPatient(Patient $patient)
    {
        $user = Auth::user();

        $this->validate();

        $patient->team_id = $user->current_team_id;
        $patient->firstname = $this->firstname;
        $patient->name = $this->name;
        $patient->pesel = $this->pesel;
        $patient->email = $this->email;
        $patient->phone = $this->phone;
        if(!empty($this->birth)) {
            $patient->birth = $this->birth;
        }
        if(!empty($this->gender)) {
            $patient->gender = $this->gender;
        }
        if(!empty($this->address_city)) {
            $patient->address_city = $this->address_city;
        }
        if(!empty($this->address_code)) {
            $patient->address_code = $this->address_code;
        }
        if(!empty($this->address_street)) {
            $patient->address_street = $this->address_street;
        }
        if(!empty($this->address_number)) {
            $patient->address_number = $this->address_number;
        }
        if(!empty($this->description)) {
            $patient->description = $this->description;
        }
        $patient->save();

        $user->notify(new NotifyUser('Pacjent o nazwie <i>'.$this->firstname.' '.$this->name.'</i> został dodany.'));

       	$this->dispatchBrowserEvent('close-modal', ['modal' => 'addPatient']);
       	$this->emit('ShowTablePatientsRefresh');

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Dodano poprawnie nowego pacjenta.']);
    }

    public function saveEditPatient($id)
    {
        $this->validate();
        $user = Auth::user();

        $patient = Patient::find($id);
        $patient->firstname = $this->firstname;
        $patient->name = $this->name;
        $patient->pesel = $this->pesel;
        $patient->email = $this->email;
        $patient->phone = $this->phone;
        $patient->birth = $this->birth;
        $patient->gender = $this->gender;
        $patient->address_city = $this->address_city;
        $patient->address_code = $this->address_code;
        $patient->address_street = $this->address_street;
        $patient->address_number = $this->address_number;
        $patient->description = $this->description;
        $patient->save();

        $user->notify(new NotifyUser('Pacjent o nazwie <i>'.$this->firstname.' '.$this->name.'</i> został edytowany.'));

        $this->dispatchBrowserEvent('close-modal', ['modal' => 'addPatient']);
        $this->emit('ShowTablePatientsRefresh');

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Uaktualniono dane pacjenta.']);
    }

    public function addPatient()
    {
        $this->switch = 'create';
        $this->firstname = '';
        $this->name = '';
        $this->pesel = '';
        $this->email = '';
        $this->phone = '';
        $this->birth = '';
        $this->gender = '';
        $this->address_city = '';
        $this->address_code = '';
        $this->address_street = '';
        $this->address_number = '';
        $this->description = '';
        $this->idEdit = 0;

        $this->dispatchBrowserEvent('open-modal', ['modal' => 'addPatient']);
    }

    public function editPatient($id)
    {
        $this->switch = 'edit';

        $patient = Patient::find($id);
        $this->firstname = $patient->firstname;
        $this->name = $patient->name;
        $this->pesel = $patient->pesel;
        $this->email = $patient->email;
        $this->phone = $patient->phone;
        $this->birth = $patient->birth;
        $this->gender = $patient->gender;
        $this->address_city = $patient->address_city;
        $this->address_code = $patient->address_code;
        $this->address_street = $patient->address_street;
        $this->address_number = $patient->address_number;
        $this->description = $patient->description;
        $this->idEdit = $patient->id;

        $this->dispatchBrowserEvent('open-modal', ['modal' => 'addPatient']);
    }
}
