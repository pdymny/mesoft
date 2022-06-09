<?php

namespace App\Http\Livewire\Workers;

use Livewire\Component;
use Auth;
use Rap2hpoutre\FastExcel\FastExcel;

use App\Models\User;
use App\Models\Worker;


class TableWorkers extends Component
{

    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $user;
    public $email;

    protected $listeners = ['refreshTableWorkers' => '$refresh',
    						'removeWorker' => 'removeWorker'
						];


	public function mount()
    {
    	$this->user = Auth::user();
    }

    public function render()
    {
    	//dd($this->resultData());
        return view('workers.table_workers', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    private function headerConfig()
    {
        return [
            'firstname' => 'Imię',
            'name' => 'Nazwisko',
            'title' => 'Tytuł',
            'specialization' => 'Specjalizacja',
            'position' => 'Stanowisko',
            'name_schedule' => 'Grafik',
        ];
    }   

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {

        return Worker::where(function ($query) {
            $query->where('teams_workers.team_id', '=', $this->user->current_team_id);

            if($this->searchTerm != "") {
                $query->where('users.firstname', 'like', '%'.$this->searchTerm.'%');
             	$query->orWhere('users.name', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('title', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('position', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('teams_work_schedule.name', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->leftJoin('users', 'teams_workers.user_id', '=', 'users.id')
        ->leftJoin('teams_work_schedule', 'teams_workers.schedule_id', '=', 'teams_work_schedule.id') 
        ->select('teams_workers.title', 'teams_workers.description', 'teams_workers.position', 'teams_workers.specialization', 'users.*', 'teams_work_schedule.name AS name_schedule', 'teams_workers.id AS id_w')
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
    }

    public function downloadList()
    {
        $workers = $this->resultData()->toArray();

        (new FastExcel($workers))->export('pracownicy.xlsx');

        return response()->download('pracownicy.xlsx', 'pracownicy.xlsx');
    }

    public function removeWorker(Worker $worker)
    {
    	$worker->delete();
    }
}
