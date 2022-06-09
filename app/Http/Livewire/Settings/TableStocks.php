<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Auth;
use Livewire\WithPagination;

use App\Models\User;

class TableStocks extends Component
{
	use WithPagination;

    public $user;
    public $usersInTeam;
    public $account = 0;


    public function mount()
    {
    	$this->user = Auth::user();
        $this->account = $this->user->id;
    }

    public function render()
    {
        $this->usersInTeam = $this->user->currentTeam->allUsers();

        return view('settings.table_stocks', [
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
        return User::find($this->account);

        /*
        if(!empty($users)) {
            foreach($users->notifications as $tab) {

                $data[] = array('date' => $tab['created_at']);
            }

            return $date;
        }
*/

        /*
        return Stock::where(function ($query) {
            $query->where('team_id', '=', $this->user->current_team_id);

            if($this->searchTerm != "") {
                $query->where('teams_stocks.created_at', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('text', 'like', '%'.$this->searchTerm.'%');
                $query->orWhere('name', 'like', '%'.$this->searchTerm.'%');
            }
        })
        ->join('users', 'teams_stocks.user_id', '=', 'users.id')
        ->select('users.*', 'teams_stocks.created_at as date_action', 'teams_stocks.text as text')
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate(20);
        */
    }
}
