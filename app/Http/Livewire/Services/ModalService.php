<?php

namespace App\Http\Livewire\Services;

use Livewire\Component;
use Auth;

use App\Models\Service;

use App\Notifications\NotifyUser;

class ModalService extends Component
{
	public $idEdit;
	public $title;
	public $cost;
	public $time;
	public $func = 'create';

    protected $rules = [
        'title' => 'required|string|min:3|max:200',
        'cost' => 'required|numeric|min:3',
        'time' => 'required|numeric|min:5|max:200',
    ];

	protected $listeners = ['switchModalService' => 'switchModalService',
							'createService' => 'createService'
						];

    public function render()
    {
        return view('services.modal_service');
    }

    public function switchModalService(Service $service) 
    {
    	if($service->id > 0) {
	    	$this->func = 'edit';
	    	$this->idEdit = $service->id;
	    	$this->title = $service->title;
	    	$this->cost = $service->cost;
	    	$this->time = $service->time;
    	} else {
    		$this->func = 'create';
    		$this->title = "";
	    	$this->cost = "";
	    	$this->time = "";
    	}

    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'modalService']);
    }

    public function createService(Service $service)
    {
        $user = Auth::user();

        $this->validate();
        
        $service->team_id = $user->current_team_id;
        $service->title = $this->title;
        $service->cost = $this->cost;
        $service->time = $this->time;
        $service->save();

        if($this->func == 'create') {
            $text = "Usługa o nazwie <i>".$this->title."</i> została dodana.";
            $mes = "Usługa została dodana poprawnie.";
        } else {
            $text = "Usługa o nazwie <i>".$this->title."</i> została edytowana.";
            $mes = "Usługa została edytowana poprawnie.";
        }

        $user->notify(new NotifyUser($text));

        $this->dispatchBrowserEvent('close-modal', ['modal' => 'modalService']);
        $this->emit('ShowTableServicesRefresh');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => $mes]);
    }
}
