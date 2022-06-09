<?php

namespace App\Http\Livewire\WorkSchedule;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;
use Rap2hpoutre\FastExcel\FastExcel;

use App\Models\WorkSchedule;
use App\Models\User;

use App\Notifications\NotifyUser;

class TableWorkSchedule extends Component
{
    use WithPagination;

    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $user;

	protected $listeners = ['removeWorkSchedule' => 'removeWorkSchedule',  
							'ShowTableWorkScheduleRefresh' => '$refresh'
						];

    public function mount()
    {
    	$this->user = Auth::user();
    }

    public function render()
    {
        return view('work_schedule.table_work_schedule', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    private function headerConfig()
    {
        return [
            'name' => 'Nazwa szablonu',
            'schedule' => [
                'label' => 'Ustawienia szablonu',
                'func' => function ($value) {
                    $value = json_decode($value);

                    $html = "<table>";
                    $i = 0;
                    foreach($value as $day) {
                    	$html.="<tr>";
                    	$html.= $this->switchDay($day, $i++);
                    	$html.="</tr>";
                    }
                    $html.= "</table>";

                    return $html;
                }
            ],
        ];
    }   

    private function switchDay($day, $number_day)
    {
    	switch($number_day) {
    		case 0: $name = 'Poniedziałek'; break;
    		case 1: $name = 'Wtorek'; break;
    		case 2: $name = 'Środa'; break;
    		case 3: $name = 'Czwartek'; break;
    		case 4: $name = 'Piątek'; break;
    		case 5: $name = 'Sobota'; break;
    		case 6: $name = 'Niedziela'; break;
    	}

    	if(!empty($day->check)) {
	        if($day->check == 'true') {
	            $data = '<td><b>'.$name.'</b></td><td> od <b>';
	            if(!empty($day->start)) {
	            	$data.= $day->start;
	            } else {
	            	$data.= '[Błąd]';
	            }
	            $data.= '</b> do <b>';
	            if(!empty($day->end)) {
	            	$data.= $day->end;
	            } else {
	            	$data.= '[Błąd]';
	            }
	            $data.= '</b>.</td>';
	        } else {
	            $data = '<td><b>'.$name.'</b></td> <td> zamknięte.</td>';
	        }
	    } else {
	    	$data = '<td><b>'.$name.'</b></td> <td> zamknięte.</td>';
	    }

        return $data;
    }

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return WorkSchedule::where(function ($query) {
            $query->where('team_id', '=', $this->user->current_team_id);

            if($this->searchTerm != "") {
                $query->Where('name', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(5);
    }

    public function removeWorkSchedule(WorkSchedule $work_schedule)
    {
    	$work_schedule->delete();

        $this->user->notify(new NotifyUser('Grafik pracy <i>'.$work_schedule->name.'</i> został usunięty.'));

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Grafik pracy został poprawnie usunięty.']);
    }
}
