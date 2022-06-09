<?php

namespace App\Http\Livewire\Patients;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;
use Rap2hpoutre\FastExcel\FastExcel;

use App\Models\Patient;
use App\Models\User;

use App\Notifications\NotifyUser;

class TableAllPatients extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';

	protected $listeners = ['removePatient' => 'removePatient', 'ShowTablePatientsRefresh' => '$refresh'];

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    private function headerConfig()
    {
        return [
            'firstname' => 'Imię',
            'name' => 'Nazwisko',
            'pesel' => 'PESEL',
            'email' => 'E-mail',
            'phone' => 'Telefon',
        ];
    }   

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return Patient::where(function ($query) {
            $query->where('team_id', '=', $this->user->current_team_id);

            if($this->searchTerm != "") {
                $query->where('firstname', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('name', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
    }

    public function render()
    {
        return view('patients.table_all_patients', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    public function removePatient(Patient $patient) 
    {
    	$patient->delete();

        $this->user->notify(new NotifyUser('Pacjent o nazwie <i>'.$patient->firstname.' '.$patient->name.'</i> został usunięty.'));

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Usunięto pacjenta poprawnie.']);
    }

    public function downloadList()
    {
        $patients = Patient::where('team_id', $this->user->current_team_id)
            ->orderBy('created_at', 'desc')
            ->get();

        (new FastExcel($patients))->export('klienci.xlsx');

        return response()->download('klienci.xlsx', 'klienci.xlsx');
    }

}
