<?php

namespace App\Http\Livewire\WorkSchedule;

use Livewire\Component;
use Auth;

use App\Models\WorkSchedule;
use App\Models\User;

use App\Notifications\NotifyUser;

class AddWorkSchedule extends Component
{
	public $idEdit;
	public $name;
	public $monday;
	public $tuesday;
	public $wednesday;
	public $thursday;
	public $friday;
	public $saturday;
	public $sunday;
	public $func = 'create';

    protected $rules = [
        'name' => 'required|string|min:3|max:200',
    ];


	protected $listeners = ['editWorkSchedule' => 'editWorkSchedule',
							'switchWorkSchedule' => 'switchWorkSchedule',
							'createWorkSchedule' => 'createWorkSchedule'
						];

    public function render()
    {
        return view('work_schedule.add_work_schedule');
    }

    public function switchWorkSchedule(WorkSchedule $work_schedule) 
    {
    	if($work_schedule->id > 0) {
    		$this->editWorkSchedule($work_schedule);
    	} else {
    		$this->func = 'create';
    		$this->name = "";
			$this->monday = "";
			$this->tuesday = "";
			$this->wednesday = "";
			$this->thursday = "";
			$this->friday = "";
			$this->saturday = "";
			$this->sunday = "";
    	}

    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'addWorkScheldule']);
    }

    public function createWorkSchedule(WorkSchedule $work_schedule)
    {
        $user = Auth::user();

        $this->validate();

        $schedule = ['monday' => $this->monday, 
        			'tuesday' => $this->tuesday,
        			'wednesday' => $this->wednesday,
        			'thursday' => $this->thursday,
        			'friday' => $this->friday,
        			'saturday' => $this->saturday,
        			'sunday' => $this->sunday
        		];

        $work_schedule->team_id = $user->current_team_id;
        $work_schedule->name = $this->name;
        $work_schedule->schedule = json_encode($schedule);
        $work_schedule->save();

        if($this->func == 'create') {
            $text = 'Grafik pracy <i>'.$this->name.'</i> został dodany.';
            $mes = 'Grafik pracy został zapisany poprawnie.';
        } else {
            $text = 'Grafik pracy <i>'.$this->name.'</i> został edytowany.';
            $mes = 'Grafik pracy został zaaktualizowany poprawnie.';
        }

        $user->notify(new NotifyUser($text));

       	$this->dispatchBrowserEvent('close-modal', ['modal' => 'addWorkScheldule']);
       	$this->emit('ShowTableWorkScheduleRefresh');

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => $mes]);
    }

    public function editWorkSchedule($work_schedule)
    {
    	$this->func = 'edit';
    	$this->idEdit = $work_schedule->id;
    	$this->name = $work_schedule->name;

    	$schedule = json_decode($work_schedule->schedule);

    	$this->decodeSwitch($schedule, 'monday');
    	$this->decodeSwitch($schedule, 'tuesday');
    	$this->decodeSwitch($schedule, 'wednesday');
    	$this->decodeSwitch($schedule, 'thursday');
    	$this->decodeSwitch($schedule, 'friday');
    	$this->decodeSwitch($schedule, 'saturday');
    	$this->decodeSwitch($schedule, 'sunday');
    }

    private function decodeSwitch($schedule, $day)
    {
    	if(!empty($schedule->$day->check)) {
    		$check = $schedule->$day->check;
    	} else {
    		$check = "";
    	}

    	if(!empty($schedule->$day->start)) {
    		$start = $schedule->$day->start;
    	} else {
    		$start = "";
    	}

    	if(!empty($schedule->$day->end)) {
    		$end = $schedule->$day->end;
    	} else {
    		$end = "";
    	}

    	$this->$day = ['check' => $check, 'start' => $start, 'end' => $end];
    }
}
