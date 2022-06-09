<?php

namespace App\Http\Livewire\Marketing;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;

use App\Models\Loyalty;
use App\Notifications\NotifyUser;


class TableLoyalty extends Component
{
	use WithPagination;

    public $user;

    protected $listeners = ['addLoyalty' => 'addLoyalty', 'refreshLoyalty' => '$refresh', 'removeLoyalty' => 'removeLoyalty'];

    public function mount()
    {
    	$this->user = Auth::user();
    }

    public function render()
    {
        return view('marketing.table_loyalty', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    private function headerConfig()
    {
        return [
            'visit' => 'Ilość wizyt',
            'what' => [
                'label' => 'Rodzaj rabatu',
                'func' => function ($value) {
                    if($value == 1) {
                        return 'Kwotowy';
                    } else {
                        return 'Procentowy';
                    }
                }
            ],
            'rabat' => 'Wysokość rabatu'
        ];
    }   

    private function resultData()
    {
        return Loyalty::where('team_id', '=', $this->user->current_team_id)->get();
    }

    public function removeLoyalty($id) 
    {
        $loyalty = Loyalty::find($id);
        $loyalty->delete();

        $this->user->notify(new NotifyUser('Regułka programu lojalnościowego została usunięta.'));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Regułka została usunięta.']);
    }

    public function addLoyalty()
    {
        $this->dispatchBrowserEvent('open-modal', ['modal' => 'addLoyalty']);
    }
}
