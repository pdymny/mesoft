<?php

namespace App\Http\Livewire\Workers;

use Livewire\Component;
use Auth;

use App\Models\User;
use App\Models\WorkSchedule;
use App\Models\Membership;
use App\Models\Worker;

use App\Http\Livewire\Modal\ShowPack;


class ModalWorker extends Component
{
	public $func = 'create';
	public $user;
	public $base_schedule = [];
	public $base_users = [];
	public $worker;
	public $schedule;
	public $position;
	public $title;
	public $specialization;
	public $description;
	public $idEdit;
	public $editWorker;

    public $pack_work;
    public $count_work;

	protected $rules = [
        'worker' => 'required',
        'schedule' => 'required',
        'position' => 'required|string|min:3|max:200',
        'title' => 'required|string|min:3|max:200',
        'specialization' => 'required|string|min:3|max:200',
        'description' => 'nullable|string',
    ];

	protected $listeners = ['modalWorker' => 'modalWorker',
							'editWorker' => 'editWorker',
							'editSaveWorker' => 'editSaveWorker'
						];

	public function mount()
	{
        $this->user = Auth::user();

        $this->pack_work = ShowPack::packing($this->user->currentTeam->id_pack)['work'];
        $this->count_work = Worker::where('team_id', '=', $this->user->currentTeam->id)->count();
	}

    public function render()
    {
        return view('workers.modal_worker');
    }

    public function modalWorker() 
    {
    	$this->func = 'create';
    	$this->worker = 0;
		$this->schedule = 0;
		$this->position = "";
		$this->title = "";
		$this->specialization = "";
		$this->description = "";

    	$this->base_schedule = WorkSchedule::where('team_id', '=', $this->user->current_team_id)->get()->toArray();
    	$base_users = $this->user->currentTeam->allUsers();
    	$base_workers = Worker::where('team_id', '=', $this->user->current_team_id)->get()->toArray();

    	$this->base_users = [];
    	foreach($base_users as $user) {
    		$key = array_search($user['id'], array_column($base_workers, 'user_id'));

    		if($key !== false) { 
    			// No musi tak być, bo inaczej nie działa. 
    		} else {
    		    $this->base_users[] = $user;
    		}
    	}

	    $this->dispatchBrowserEvent('open-modal', ['modal' => 'modalWorker']);
    }

    public function editWorker($id)
    {
    	$this->func = false;
    	$this->idEdit = $id;

    	$this->editWorker = Worker::where('teams_workers.id', '=', $id)
    						->leftJoin('users', 'teams_workers.user_id', '=', 'users.id')
    						->select('users.*', 'teams_workers.*')
    						->first();
    	$this->base_schedule = WorkSchedule::where('team_id', '=', $this->user->current_team_id)->get()->toArray();

    	$this->worker = $id;
		$this->schedule = $this->editWorker->schedule_id;
		$this->position = $this->editWorker->position;
		$this->title = $this->editWorker->title;
		$this->specialization = $this->editWorker->specialization;
		$this->description = $this->editWorker->description;

    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'modalWorker']);
    }

    public function editSaveWorker($id)
    {
    	$this->validate();

    	$worker = Worker::find($id);
		$worker->schedule_id = $this->schedule;
		$worker->position = $this->position;
		$worker->title = $this->title;
		$worker->specialization = $this->specialization;
		$worker->description = $this->description;
		$worker->save();

		$this->emit('refreshTableWorkers');
		$this->dispatchBrowserEvent('close-modal', ['modal' => 'modalWorker']);
    }

    public function addWorker()
    {
    	$this->validate();

    	$worker = new Worker;
    	$worker->team_id = $this->user->current_team_id;
		$worker->user_id = $this->worker;
		$worker->schedule_id = $this->schedule;
		$worker->position = $this->position;
		$worker->title = $this->title;
		$worker->specialization = $this->specialization;
		$worker->description = $this->description;
		$worker->save();

		$this->emit('refreshTableWorkers');
		$this->dispatchBrowserEvent('close-modal', ['modal' => 'modalWorker']);
    }
}
