<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Auth;
use Illuminate\Http\Request;
use Livewire\WithPagination;


use App\Models\Team;


class ShowTableSalons extends Component
{
	use WithPagination;

    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';

    protected $listeners = ['refreshAdminSalon' => '$refresh'];

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    private function headerConfig()
    {
        return [
            'name' => 'Nazwa',
            'id_pack' => [
                'label' => 'Pakiet',
                'func' => function ($value) {
                    switch($value) {
                    	case 0: return 'Darmowy'; break;
                    	case 1: return 'Mini'; break;
                        case 2: return 'Medium'; break;
                    	case 3: return 'Maxi'; break;
                    }
                }
            ],
            'pack_term' => 'Koniec pakietu',
            'pack_sms' => 'Ilość sms',
            'pack_email' => 'Ilość email',
            'phone' => 'Telefon',
            'email' => 'E-mail',
            'created_at' => 'Data utworzenia',
        ];
    }   

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return Team::where(function ($query) {
            if($this->searchTerm != "") {
                $query->where('firstname', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('name', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
    }

    public function render()
    {
        return view('admin.show-table-salons', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }


}
