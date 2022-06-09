<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;

use App\Models\User;

use App\Notifications\NotifyUser;

class ModalAction extends Component
{
    use WithPagination;

    public $idA;
    public $firstname;
    public $name;

    protected $listeners = ['action' => 'action'];

    public function action($id)
    {
        $this->idA = $id;

        $user = User::find($id);

        $this->firstname = $user->firstname;
        $this->name = $user->name;

        $this->dispatchBrowserEvent('open-modal', ['modal' => 'actionUser']);
    }

    public function render()
    {
        return view('admin.modal-action', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    private function headerConfig()
    {
        return [
            'date_action' => 'Data akcji',
            'text' => 'Treść akcji'
        ];
    }   

    private function resultData()
    {
        return User::find($this->idA);
    }
}
