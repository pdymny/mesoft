<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use Auth;
use Rap2hpoutre\FastExcel\FastExcel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

use App\Models\Visit;
use App\Models\Service;
use App\Models\Worker;
use App\Models\Patient;

use App\Notifications\NotifyUser;

class TableVisits extends Component
{
	use WithPagination;


    public $searchTerm;
    public $searchStatus;
    public $searchWorker;
    public $searchDate;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $user;
    public $email;
    public $patient;
    public $dashboard = 'false';

    protected $listeners = ['switchData' => 'switchData',
    'sendSmsPatient' => 'sendSmsPatient',
    'cancelVisit' => 'cancelVisit',
    'refreshVisitTable' => '$refresh'
];


public function mount()
{
   $this->user = Auth::user();
}

public function render()
{
    	//dd($this->resultData());
    return view('visits.table_visits', [
        'data' => $this->resultData(),
        'headers' => $this->headerConfig(),
        'workers' => $this->getWorkers()
    ]);
}

private function headerConfig()
{
    if($this->dashboard == 'true') {
        return [
           'date_visit' => 'Data wizyty',
           'firstname' => 'Imię pacjenta',
           'name' => 'Nazwisko pacjenta',
           'title' => 'Nazwa usługi',
           'time' => [
            'label' => 'Czas trwania',
            'func' => function ($value) {
                return $value.' min.';
            }
            ],
           'cost' => [
            'label' => 'Koszt usługi',
            'func' => function ($value) {
                return $value.' PLN';
            }
            ],
           'status' => [
            'label' => 'Status',
            'func' => function ($value) {
                return $this->switchAlert($value);
            }
            ],
        ];
    } elseif($this->patient > 0) {
        return [
           'date_visit' => 'Data wizyty',
           'title' => 'Nazwa usługi',
           'time' => [
            'label' => 'Czas trwania',
            'func' => function ($value) {
                return $value.' min.';
            }
            ],
           'cost' => [
            'label' => 'Koszt usługi',
            'func' => function ($value) {
                return $value.' PLN';
            }
            ],
           'w_firstname' => 'Imię pracownika',
           'w_name' => 'Nazwisko pracownika',
           'status' => [
            'label' => 'Status',
            'func' => function ($value) {
                return $this->switchAlert($value);
            }
            ],
        ];
    } else {
        return [
           'date_visit' => 'Data wizyty',
           'firstname' => 'Imię pacjenta',
           'name' => 'Nazwisko pacjenta',
           'title' => 'Nazwa usługi',
           'time' => [
            'label' => 'Czas trwania',
            'func' => function ($value) {
                return $value.' min.';
            }
            ],
           'cost' => [
            'label' => 'Koszt usługi',
            'func' => function ($value) {
                return $value.' PLN';
            }
            ],
           'w_firstname' => 'Imię pracownika',
           'w_name' => 'Nazwisko pracownika',
           'status' => [
            'label' => 'Status',
            'func' => function ($value) {
                return $this->switchAlert($value);
            }
            ],
        ];
    }
}   

private function switchAlert($value)
{
    switch($value) {
        case 0: return '<span class="badge badge-danger">Anulowana</span>'; break;
        case 1: return '<span class="badge badge-primary">Oczekująca</span>'; break;
        case 2: return '<span class="badge badge-danger">Anulowana <br/>przez klienta</span>'; break;
        case 3: return '<span class="badge badge-danger">Anulowana <br/>przez pracownika</span>'; break;
        case 4: return '<span class="badge badge-success">Zrealizowane</span>'; break;
        case 5: return '<span class="badge badge-success">Brak pacjenta <br/>na wizycie</span>'; break;
    }
}

public function sort($column)
{
    $this->sortColumn = $column;
    $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
}

public function switchData($what)
{
   if(!empty($this->searchDate) && $what == '0') {
      $this->searchDate = "";

      $this->dispatchBrowserEvent('switch-date', ['date' => 'Wszystkie dni']);
  } else {
      $date = Carbon::now();

      if($what == '-1') {
         $date = new Carbon($this->searchDate);
         $date = $date->sub('1 day');
     } elseif($what == '1') {
         $date = new Carbon($this->searchDate);
         $date = $date->add('1 day');
     }

     $this->searchDate = $date->toDateString();
     $this->dispatchBrowserEvent('switch-date', ['date' => $this->searchDate]);
 }
}

private function resultData()
{
    return Visit::where(function ($query) {
        $query->where('teams_visits.team_id', '=', $this->user->current_team_id);
        if($this->patient > 0) {
           $query->where('teams_visits.patient_id', '=', $this->patient);
        }
        if($this->dashboard == 'true') {
            $query->whereDate('date_visit', Carbon::now()->toDateString());
            $query->where('users.id', '=', $this->user->id);
        }

       if($this->searchTerm != "") {
          $query->where('users.firstname', 'like', '%'.$this->searchTerm.'%');
          $query->orWhere('users.name', 'like', '%'.$this->searchTerm.'%');
          $query->orWhere('teams_patients.firstname', 'like', '%'.$this->searchTerm.'%');
          $query->orWhere('teams_patients.name', 'like', '%'.$this->searchTerm.'%');
          $query->orWhere('teams_visits.date_visit', 'like', '%'.$this->searchTerm.'%');
          $query->orWhere('teams_services.title', 'like', '%'.$this->searchTerm.'%');
          $query->orWhere('teams_services.time', 'like', '%'.$this->searchTerm.'%');
          $query->orWhere('teams_services.cost', 'like', '%'.$this->searchTerm.'%');
      }
      if($this->searchStatus > 0) {
       $query->where('teams_visits.status', '=', $this->searchStatus-1);
   }
   if($this->searchWorker > 0) {
       $query->where('teams_visits.worker_id', '=', $this->searchWorker);
   }
   if(!empty($this->searchDate)) {
       $query->whereDate('date_visit', $this->searchDate);
   }
})
    ->rightJoin('teams_patients', 'teams_visits.patient_id', '=', 'teams_patients.id')
    ->rightJoin('teams_workers', 'teams_visits.worker_id', '=', 'teams_workers.id') 
    ->rightJoin('users', 'teams_workers.user_id', '=', 'users.id') 
    ->join('teams_services', 'teams_visits.service_id', '=', 'teams_services.id') 
    ->select('teams_patients.*', 'teams_visits.date_visit', 'users.firstname as w_firstname', 'users.name as w_name', 'teams_services.title', 'teams_services.time', 'teams_services.cost', 'teams_visits.patient_id as idp', 'teams_visits.id as idv', 'teams_visits.status')
    ->orderBy($this->sortColumn, $this->sortDirection)
    ->paginate(20);
}

private function getWorkers()
{
   return Worker::where('team_id', '=', $this->user->current_team_id)
   ->rightJoin('users', 'teams_workers.user_id', '=', 'users.id') 
   ->select('users.name', 'users.firstname', 'teams_workers.id')
   ->get();
}

public function downloadList()
{
    $visits = $this->resultData()->toArray();

    (new FastExcel($visits))->export('wizyty.xlsx');

    return response()->download('wizyty.xlsx', 'wizyty.xlsx');
}

public function cancelVisit($id)
{
    $visit = Visit::find($id);
    $visit->status = 3;
    $visit->save();

    $this->user->notify(new NotifyUser('Wizyta <i>'.$visit->date_visit.'</i> została anulowana.'));

    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Wizyta została anulowana poprawnie.']);
}
}
