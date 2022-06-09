<?php

namespace App\Http\Livewire\Widget;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Patient;
use App\Models\Visit;
use App\Models\Team;


class ShowWidgetGuest extends Component
{
	public $email;
	public $pesel;
    public $team_id;
    public $visit;
    public $team;
    public $logo;

    public $data_visit;

    protected $listeners = ['loginClient' => 'loginClient',
                            'statusVisit' => 'statusVisit'
    ];

public function mount(Request $request)
{
  $this->team_id = $request->id;
  if(!empty($request->visit)) {
    $this->visit = $request->visit;
  } else {
    $this->visit = 0;
  }
}

public function render()
{
    $this->team = Team::find($this->team_id);

    $this->logo = Storage::path($this->team->logo_widget);

    return view('widget.show_guest')->layout('layouts.guest');;
}

public function loginClient()
{
   $patient = Patient::where('team_id', '=', $this->team_id)
   ->where('pesel', '=', $this->pesel)
   ->where('email', '=', $this->email)
   ->orWhere('phone', '=', $this->email)
   ->first();

   if(!empty($patient)) {

    if($this->visit > 0) {
        $visit = Visit::where('team_id', '=', $this->team_id)
            ->where('id', '=', $this->visit)
            ->first();
        $this->data_visit = $visit;

        $this->dispatchBrowserEvent('open-modal', ['modal' => 'deleteVisit']);
    } else {

        $this->emit('openNewVisitPatient', $patient->id);
       // $this->dispatchBrowserEvent('open-modal', ['modal' => 'newVisitClient']);
    }

} else {
  session()->flash('status', 'Nie ma takiego klienta o tych danych.');
}
}

public function statusVisit($status)
{
    $this->email = '';
    $this->pesel = '';

    if($status == 0) {
        session()->flash('status', 'Nie anulowano wizyty. Nadal możesz przyjść na umuwioną wizytę.');
    } else {
        $visit = Visit::find($this->visit);
        $visit->status = 2;
        $visit->save();

        session()->flash('status', 'Anulowano wizytę poprawnie.');
    }

    $this->dispatchBrowserEvent('close-modal', ['modal' => 'deleteVisit']);
}
}
