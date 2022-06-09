<?php

namespace App\Http\Livewire\Visits;

use Livewire\Component;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Worker;
use App\Models\WorkSchedule;
use App\Models\Visit;
use App\Models\Team;
use App\Models\Sms;
use App\Models\Email;
use App\Models\Loyalty;

use App\Notifications\NotifyUser;

class NewVisit extends Component
{
	public $user;
    public $switch;

	public $patient;
	public $worker;
	public $service;

    public $select_time = array();
    public $switch_sms = true;
    public $switch_email = true;
    public $date;
    public $term;
    public $time;

    public $schedule;
    public $count_visit;

    public $team_id;
    public $team_base;
    public $what;
    public $idVisitEdit;

	protected $listeners = ['openNewVisit' => 'openNewVisit',
							'openNewVisitPatient' => 'openNewVisitPatient',
                            'updateTerm' => 'updateTerm',
                            'calcVisit' => 'calcVisit',
                            'editVisit' => 'editVisit',
                            'saveEditVisit' => 'saveEditVisit',
                            'refreshNewVisit' => '$refresh'
                        ];


	public function mount(Request $request)
	{
        if($request->id > 0) {
            $this->team_id = $request->id;

            $team = Team::where('id', '=', $request->id)->first();
            $this->team_base = $team;

            $this->user = User::where('id', '=', $team->user_id)->first();
        } else {
            $this->user = Auth::user();
            $this->team_id = $this->user->current_team_id;
            $this->team_base = $this->user->currentTeam;
        }

        $this->count_visit = Visit::where('team_id', '=', $this->team_id)->count();
	}

    public function render()
    {
    	$base_patient = Patient::where('team_id', '=', $this->team_id)->get()->toArray();
    	$base_service = Service::where('team_id', '=', $this->team_id)->get()->toArray();
    	$base_worker = Worker::where('team_id', '=', $this->team_id)
    								->join('users', 'teams_workers.user_id', '=', 'users.id')
    								->select('users.name', 'users.firstname', 'teams_workers.position', 'teams_workers.id')
    								->get()->toArray();

        $this->calcVisit();

        return view('visits.new_visit', ['base_patient' => $base_patient, 'base_service' => $base_service, 'base_worker' => $base_worker]);
    }

     public function calcVisit()
    {
        $worker = Worker::find($this->worker);
        if(!empty($worker)) {
            $schedule = WorkSchedule::where('id', '=', $worker->schedule_id)->first();
            $service = Service::where('id', '=', $this->service)->first();

            if(!empty($service) && !empty($this->date)) {
                $chosse_date = new Carbon($this->date); // wybrana data

                $base_visit = Visit::where('team_id', '=', $this->team_id)
                                ->whereDate('date_visit', $chosse_date->format('Y-m-d'))
                                ->get()->toArray();

                $this->rabate($service);

                $open = json_decode($schedule->schedule); // rozpakowanie godzin pracy lekarza
                
                $table = [];
                $int_day = 1; // tydzień zaczyna odliczanie od 1
                foreach($open as $name => $day) {
                    if($int_day == $chosse_date->dayOfWeek) {

                        if(!empty($day->check)) {
                            if($day->check == 'true') {

                                $chosse_date = $chosse_date->startOfDay(); // wyzerowanie godziny.
                                $date_start = new Carbon($chosse_date);
                                $date_end = new Carbon($chosse_date);

                                if(!empty($day->start)) {
                                    $start = explode(':', $day->start); // podzielnie godziny na minuty i godziny
                                    $end = explode(':', $day->end); // to samo co wyżej tylko dla end
             
                                    $date_start = $date_start->addHours($start[0])->addMinutes($start[1]); // data początkowa 
                                    $date_end = $date_end->addHours($end[0])->addMinutes($end[1]); // data końcowa

                                    while($date_start->lte($date_end)) {  // dostępne godziny od początku do końca

                                        if($date_start->minute == 0) {  // Usuwanie błędu z brakiem zera.
                                            $start_minute = '00';
                                        } else {
                                            $start_minute = $date_start->minute;
                                        }

                                        $table[] = $date_start->hour.':'.$start_minute; // zapis godziny do tablicy

                                        $date_start->addMinutes($service['time']); // dodanie 15 minut
                                    }
                                }

                                if(!empty($base_visit)) {   // wyszukiwanie i usuwanie godzin jeśli są zajęte
                                    $i = 0;

                                    foreach($table as $clock) {
                                        foreach($base_visit as $visit) {  

                                            $term_visit = new Carbon($visit['date_visit']); // termin wizyty
                                            $clocker = explode(':', $clock); // nowy termin
                                            $new_term = Carbon::now()->startOfDay(); // wyzerowanie nowego terminu
                                            $new_term = $new_term->addHours($clocker[0])->addMinutes($clocker[1]);
 
                                            $service_end = new Carbon($term_visit);
                                           // $service_end->addHours($clocker[0])->addMinutes($clocker[1]);
                                            $service_end->addMinutes($service['time']);

                                           // dd($service_end);

                                            if($new_term->hour == $term_visit->hour && $new_term->minute < $service_end->minute) {
                                                unset($table[$i]); // porównanie i sunięcie godziny z tabeli
                                            }
                                        }
                                        $i++;
                                    }
                                }
                            }
                        }
                    }

                    $int_day++;
                }

                $this->select_time = $table;

                $this->emit('refreshNewVisit');
            }
        }
    }

    public function rabate($service)
    {
        $count_visit = Visit::where('team_id', '=', $this->team_id)
                        ->where('patient_id', '=', $this->patient)
                        ->where('status', '=', '4')
                        ->count();
        $loyal = Loyalty::where('team_id', '=', $this->user->current_team_id)
                    ->where('visit', '<=', $count_visit)
                    ->orderBy('visit', 'desc')
                    ->first();

        $text = '';
        if(!empty($loyal)) {
            if($loyal['what'] == 2) {
                $rabat = $service->cost * $loyal['rabat']/100;
                $sum = $service->cost - $rabat;

                $text = 'Za odbycie '.$count_visit.' wizyt klientowi przysługuje rabat w wysokości '.$loyal['rabat'].' %, czyli '.$rabat.' zł. i kwota do zapłaty wynosi '.$sum.' zł.';
            } else {
                $rabat = $loyal['rabat'];
                $sum = $service->cost - $rabat;

                $text = 'Za odbycie '.$count_visit.' wizyt klientowi przysługuje rabat w wysokości '.$rabat.' zł. i kwota do zapłaty wynosi '.$sum.' zł.';
            }
        }

        $this->rabateText = $text;

    }

    public function saveVisit()
    {
        $id_email = 0;
        $id_sms = 0;

        $time = explode(':', $this->time);
        $visit_date = new Carbon($this->date);
        $visit_date->startOfDay();
        $visit_date->addHours($time[0])->addMinutes($time[1]);

        $date_visit_sms = new Carbon($visit_date);
        $date_visit_email = new Carbon($visit_date);

        $visit = new Visit;
        $visit->team_id = $this->team_id;
        $visit->user_id = $this->user->id;
        $visit->worker_id = $this->worker;
        $visit->patient_id = $this->patient;
        $visit->service_id = $this->service;
        $visit->send_sms_id = $id_sms;
        $visit->send_email_id = $id_email;
        $visit->date_visit = $visit_date;
        $visit->status = 1;
        $visit->save();

        if($this->team_base->switch_sms == true) {
            if($this->team_base->pack_sms > 0) {
                if($this->switch_sms == true) {
                    $sms = new Sms;
                    $sms->team_id = $this->team_id;
                    $sms->visit_id = $visit->id;
                    $sms->patient_id = $this->patient;
                    $sms->date_send = $date_visit_sms->subHours($this->team_base->sms_clock);
                    $sms->status = 0;
                    $sms->message = $this->team_base->sms_text;
                    $sms->save();

                    if($sms->id > 0) {
                        Team::find($this->team_id)->decrement('pack_sms');
                        $id_sms = $sms->id;
                    }
                }
            }
        }

        if($this->team_base->switch_email == true) {
            if($this->team_base->pack_email > 0) {
                if($this->switch_email == true) {
                    $email = new Email;
                    $email->team_id = $this->team_id;
                    $email->visit_id = $visit->id;
                    $email->patient_id = $this->patient;
                    $email->date_send = $date_visit_email->subHours($this->team_base->email_clock);
                    $email->status = 0;
                    $email->message = $this->team_base->email_text;
                    $email->save();

                    if($email->id > 0) {
                        Team::find($this->team_id)->decrement('pack_email');
                        $id_email = $email->id;
                    }
                }
            }
        }

        if($this->what != 'guest') {
            $this->user->notify(new NotifyUser('Wizyta <i>'.$visit_date.'</i> została zapisana.'));
        }

        $this->dispatchBrowserEvent('close-modal', ['modal' => 'newVisit']);
        $this->emit('refreshVisitTable');

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Wizyta została dodana poprawnie.']);
    }

    public function openNewVisit()
    {
        $this->switch = 'create';

    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'newVisit']);
    }

    public function openNewVisitPatient($id)
    {
    	$this->patient = $id;
    	$this->openNewVisit();
    }

    public function updateTerm($event)
    {
        $date = new Carbon($event);
        $this->date = $date->format('d.m.Y');
    }

    public function editVisit($id)
    {
        $this->switch = 'edit';
        $visit = Visit::find($id);
        $this->idVisitEdit = $id;

        $date = new Carbon($visit->date_visit);

        $this->patient = $visit->patient_id;
        $this->worker = $visit->worker_id;
        $this->service = $visit->service_id;
        $this->date = $date->format('d.m.Y');
        $this->term = $visit->date_visit;
        $this->time = $date->hour.':'.$date->minute;

        $this->dispatchBrowserEvent('open-modal', ['modal' => 'newVisit']);
    }

    public function saveEditVisit() 
    {
        $time = explode(':', $this->time);
        $visit_date = new Carbon($this->date);
        $visit_date->startOfDay();
        $visit_date->addHours($time[0])->addMinutes($time[1]);

        $visit = Visit::find($this->idVisitEdit);
        $visit->team_id = $this->team_id;
        $visit->user_id = $this->user->id;
        $visit->worker_id = $this->worker;
        $visit->patient_id = $this->patient;
        $visit->service_id = $this->service;
        $visit->date_visit = $visit_date;
        $visit->status = 1;
        $visit->save();

        $this->user->notify(new NotifyUser('Wizyta <i>'.$visit->date_visit.'</i> została edytowana.'));

        $this->emit('refreshVisitTable');
        $this->dispatchBrowserEvent('close-modal', ['modal' => 'newVisit']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Wizyta została uaktualniona poprawnie.']);
    }

}
