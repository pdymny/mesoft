<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Auth;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

use App\Models\User;


class ShowTableUser extends Component
{
	use WithPagination;

    public $searchTerm;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';

    

    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    private function headerConfig()
    {
        return [
            'firstname' => 'Imię',
            'name' => 'Nazwisko',
            'email' => 'E-mail',
            'phone' => 'Telefon',
            'recomend_code' => 'Kod polecenia',
            'name_team' => 'Aktywny salon',
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
        return User::where(function ($query) {

            if($this->searchTerm != "") {
                $query->where('firstname', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('name', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('email', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('phone', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->select('users.*', DB::raw('(SELECT name FROM teams WHERE id = users.current_team_id) as name_team'))
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
    }

    public function render()
    {
        return view('admin.show-table-users', [
            'data' => $this->resultData(),
            'headers' => $this->headerConfig()
        ]);
    }


}
