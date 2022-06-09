<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;

use App\Models\Team;

use App\Notifications\NotifyUser;

class AllSalon extends Component
{
    use WithPagination;

    public $idSalon;
    public $pack;
    public $term;
    public $sms;
    public $email;

    protected $listeners = ['allSalon' => 'allSalon', 'saveSalon' => 'saveSalon'];

    public function allSalon($id)
    {
        $this->idSalon = $id;

        $this->dispatchBrowserEvent('open-modal', ['modal' => 'allSalon']);
    }

    public function render()
    {
        if($this->idSalon > 0) {
            $team = Team::find($this->idSalon);

            $this->pack = $team->id_pack;
            $this->term = $team->pack_term;
            $this->sms = $team->pack_sms;
            $this->email = $team->pack_email;

        } else {
            $team = "";
        }

        return view('admin.all-salon', ['team' => $team]);
    }

    public function saveSalon()
    {
        $team = Team::find($this->idSalon);
        $team->id_pack = $this->pack;
        $team->pack_term = $this->term;
        $team->pack_sms = $this->sms;
        $team->pack_email = $this->email;
        $team->save();

        $this->emit('refreshAdminSalon');
        $this->dispatchBrowserEvent('close-modal', ['modal' => 'allSalon']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Uaktualniono dane poprawnie.']);
    }

}
