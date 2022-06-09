<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use Auth;

use App\Models\Visit;
use App\Models\Loyalty;

use App\Notifications\NotifyUser;

class CardVisit extends Component
{
	public $idVisit;
	public $date_visit;
	public $firstname;
	public $name;
	public $visit;
	public $w_firstname;
	public $w_name;
	public $generated;
	public $title;
	public $time;
	public $cost;
	public $status;
	public $textRabate;

	protected $listeners = ['cardVisit' => 'cardVisit', 'statusVisit' => 'statusVisit'];


    public function render()
    {
        return view('visits.card_visit');
    }

    public function cardVisit($id)
	{
		$this->idVisit = $id;

		$visit = Visit::where('teams_visits.id', '=', $id)
			->rightJoin('teams_patients', 'teams_visits.patient_id', '=', 'teams_patients.id')
		    ->rightJoin('teams_workers', 'teams_visits.worker_id', '=', 'teams_workers.id') 
		    ->rightJoin('users', 'teams_workers.user_id', '=', 'users.id') 
		    ->join('teams_services', 'teams_visits.service_id', '=', 'teams_services.id') 
		    ->select('teams_patients.*', 'teams_visits.date_visit', 'users.firstname as w_firstname', 'users.name as w_name', 'teams_services.title', 'teams_services.time', 'teams_services.cost', 'teams_visits.patient_id as idp', 'teams_visits.id as idv', 'teams_visits.status')
		    ->first();

		$this->visit = $visit;

		$this->date_visit = $visit['date_visit'];
		$this->firstname = $visit['firstname'];
		$this->name = $visit['name'];
		$this->w_firstname = $visit['w_firstname'];
		$this->w_name = $visit['w_name'];
		$this->generated = $visit['created_at'];
		$this->title = $visit['title'];
		$this->time = $visit['time'];
		$this->cost = $visit['cost'];
		$this->status = $visit['status'];

		$user = Auth::user();
		$count = Visit::where('team_id', '=', $user->current_team_id)
                        ->where('patient_id', '=', $visit['idp'])
                        ->where('status', '=', '4')
                        ->count();
		$this->searchRabate($count);

	    $this->dispatchBrowserEvent('open-modal', ['modal' => 'cardVisit']);
	}

	public function statusVisit($status) 
	{
		$user = Auth::user();
		
		$visit = Visit::find($this->idVisit);
		$visit->status = $status;
		$visit->save();

		$user->notify(new NotifyUser('Wizyta <i>'.$visit->date_visit.'</i> zmieniła swój status.'));

		$this->emit('refreshVisitTable');
		$this->dispatchBrowserEvent('close-modal', ['modal' => 'cardVisit']);

		$this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Status wizyty został poprawnie zmieniony.']);
	}

	private function searchRabate($count)
	{
		$user = Auth::user();

		$loyal = Loyalty::where('team_id', '=', $user->current_team_id)
                    ->where('visit', '<=', $count)
                    ->orderBy('visit', 'desc')
                    ->first();

		$text = '';
		if(!empty($loyal)) {
			if($loyal['what'] == 2) {
				$rabat = $this->cost * $loyal['rabat']/100;
				$sum = $this->cost - $rabat;
				$this->cost = $sum;

				$text = 'Za odbycie '.$count.' wizyt pacjentowi przysługuje rabat w wysokości '.$loyal['rabat'].' %, czyli '.$rabat.' zł. i kwota do zapłaty wynosi '.$sum.' zł.';
			} else {
				$rabat = $loyal['rabat'];
				$sum = $this->cost - $rabat;

				$text = 'Za odbycie '.$count.' wizyt pacjentowi przysługuje rabat w wysokości '.$rabat.' zł. i kwota do zapłaty wynosi '.$sum.' zł.';
				$this->cost = $sum;
			}
		}

		$this->textRabate = $text;
	}
}
