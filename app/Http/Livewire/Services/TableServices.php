<?php

namespace App\Http\Livewire\Services;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;
use Rap2hpoutre\FastExcel\FastExcel;

use App\Models\Service;

use App\Notifications\NotifyUser;

class TableServices extends Component
{
	use WithPagination;

    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $user;

    protected $listeners = ['ShowTableServicesRefresh' => '$refresh',
    						'removeService' => 'removeService'
						];

    public function mount()
    {
    	$this->user = Auth::user();
    }

    public function render()
    {
        return view('services.table_services', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    private function headerConfig()
    {
        return [
            'title' => 'Nazwa usługi',
            'cost' => [
                'label' => 'Koszt usługi',
                'func' => function ($value) {
                    return $value.' PLN';
                }
            ],
            'time' => [
                'label' => 'Czas usługi',
                'func' => function ($value) {
                    return $value.' minut';
                }
            ],
        ];
    }   

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return Service::where(function ($query) {
            $query->where('team_id', '=', $this->user->current_team_id);

            if($this->searchTerm != "") {
                $query->where('title', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('time', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('cost', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
    }

    public function removeService(Service $service) 
    {
    	$service->delete();

        $this->user->notify(new NotifyUser('Usługa o nazwie <i>'.$service->title.'</i> została usunięta.'));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Usługa została usunięta poprawnie.']);
    }

    public function downloadList()
    {
        $services = Service::where('team_id', $this->user->current_team_id)
            ->orderBy('created_at', 'desc')
            ->get();

        (new FastExcel($services))->export('uslugi.xlsx');

        return response()->download('uslugi.xlsx', 'uslugi.xlsx');
    }
}
