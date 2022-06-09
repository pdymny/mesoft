<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;

use App\Models\User;
use App\Models\Recomend;

class TableRecommend extends Component
{
	use WithPagination;

    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'desc';
    public $user;

    public function mount()
    {
    	$this->user = Auth::user();
    }

    public function render()
    {
        return view('profile.table_recomend', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }

    private function headerConfig()
    {
        return [
            'created_at' => 'Data',
            'description' => 'Opis',
            'income' => [
                'label' => 'Akcja',
                'func' => function ($value) {
                	switch($value) {
                		case 1: return '<span class="badge badge-danger">Wypłata</span>'; break;
                		case 2: return '<span class="badge badge-success">Wpłata</span>'; break;
                	}
                }
            ],
            'amount' => [
                'label' => 'Kwota',
                'func' => function ($value) {
                    return $value.' PLN';
                }
            ],
            'account' => [
                'label' => 'Stan konta',
                'func' => function ($value) {
                    return $value.' PLN';
                }
            ],
        ];
    }   

    public function sort($column)
    {
        $this->sortColumn = $column;
        $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
    }

    private function resultData()
    {
        return Recomend::where(function ($query) {
            $query->where('team_id', '=', $this->user->current_team_id);
            $query->where('user_id', '=', $this->user->id);
        })
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
    }
}
