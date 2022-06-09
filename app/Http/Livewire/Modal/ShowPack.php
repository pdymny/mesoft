<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use Auth;

use App\Models\Worker;
use App\Models\Visit;
use App\Models\Document;


class ShowPack extends Component
{
	public $name_pack;
	public $user;
	public $worker;
	public $visit;
	public $document;
	public $account;
	public $pack;

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
    	$this->worker = Worker::where('team_id', '=', $this->user->currentTeam->id)->count();
    	$this->visit = Visit::where('team_id', '=', $this->user->currentTeam->id)->count();
    	$document = Document::where('team_id', '=', $this->user->currentTeam->id)->sum('size');
    	$this->document = $this->size($document);

    	$this->account = $this->user->currentTeam->allUsers()->count();

    	$this->pack = $this->packing($this->user->currentTeam->id_pack);

        return view('modal.show_pack');
    }

    private function size($value) 
    {
    	$value = $value / 1024;
        if($value > 1024) {
            return round($value / 1024).' MB';
        } else {
            return round($value).' KB';
        }
    }

    public static function packing($id)
    {
    	switch($id) {
    		case 0:
    		// free 
    			return array('work' => 1, 'visit' => 30, 'data' => '100 MB', 'sms' => 0, 'email' => 0, 'account' => 1);
    		break;
    		case 1:
    		// mini
    			return array('work' => 5, 'visit' => 'bez limitu', 'data' => '2 GB', 'sms' => 50, 'email' => 200, 'account' => 5);
    		break;
    		case 2:
    		// medium
    			return array('work' => 10, 'visit' => 'bez limitu', 'data' => '5 GB', 'sms' => 100, 'email' => 500, 'account' => 10);
    		break;
    		case 3:
    		// maxi
    			return array('work' => 'bez limitu', 'visit' => 'bez limitu', 'data' => '20 GB', 'sms' => 200, 'email' => 1000, 'account' => 'bez limitu');
    		break;
    		default:
    			return array('work' => 1, 'visit' => 30, 'data' => '100 MB', 'sms' => 0, 'email' => 0, 'account' => 1);
    		break;
    	}
    }
}
