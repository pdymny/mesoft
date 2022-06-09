<?php

namespace App\Http\Livewire\Terms;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Visit;


class TableTerms extends Component
{
	use WithPagination;

    public $user;
    public $usersInTeam;
    public $account = 0;
    public $dashboard = false;


    public function mount()
    {
    	$this->user = Auth::user();
        $this->account = $this->user->id;
    }

    public function render()
    {
        $this->usersInTeam = $this->user->currentTeam->allUsers();

        $data = $this->editData($this->resultData());
        
        $this->dispatchBrowserEvent('DOMContentLoaded', ['data' => $data]);

        return view('terms.table_terms', [
            'data' => $this->resultData()
        ]);
    }

    private function resultData()
    {
        /*
        return Visit::where('worker_id', '=', $this->account)
        ->where('teams_visits.team_id', '=', $this->user->current_team_id)
        ->join('teams_services', 'teams_visits.service_id', '=', 'teams_services.id')
        ->join('teams_client', 'teams_visits.patient_id', '=', 'teams_client.id')
        ->select('teams_visits.*', 'teams_services.time AS time', 'teams_client.*', 'teams_services.title')
        ->get();
        */


        return Visit::where(function ($query) {
            $query->where('users.id', '=', $this->account);
            $query->where('teams_visits.team_id', '=', $this->user->current_team_id);

        })
        ->rightJoin('teams_patients', 'teams_visits.patient_id', '=', 'teams_patients.id')
        ->rightJoin('teams_workers', 'teams_visits.worker_id', '=', 'teams_workers.id') 
        ->rightJoin('users', 'teams_workers.user_id', '=', 'users.id') 
        ->join('teams_services', 'teams_visits.service_id', '=', 'teams_services.id') 
        ->select('teams_patients.*', 'teams_visits.date_visit', 'users.firstname as w_firstname', 'users.name as w_name', 'teams_services.title', 'teams_services.time AS time', 'teams_services.cost', 'teams_visits.patient_id as idp', 'teams_visits.id as idv', 'teams_visits.status')
        ->get();
    } 

    private function editData($data) 
    {
        $json = [];
        foreach($data as $tab) {
            $json[] = array('title' => $tab['firstname']." ".$tab['name']." (".$tab['title'].")", 
                            'start' => $tab['date_visit'], 
                            'end' => Carbon::create($tab['date_visit'])->addMinute($tab['time'])
                            );

        }

        return json_encode($json);
    }
}
