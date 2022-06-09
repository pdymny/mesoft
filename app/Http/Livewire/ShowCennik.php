<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowCennik extends Component
{
	public $time = 12;
	public $pack_mini = 29;
	public $pack_medium = 69;
	public $pack_maxi = 129;

	protected $listeners = ['calcCennik' => 'calcCennik'];


    public function render()
    {
        return view('start.cennik')->layout('layouts.start');
    }

    public function calcCennik()
    {
    	switch($this->time) {
    		case 12:
    			$this->pack_mini = 29;
    			$this->pack_medium = 69;
    			$this->pack_maxi = 129;
    		break;
    		case 6:
    			$this->pack_mini = 39;
    			$this->pack_medium = 79;
    			$this->pack_maxi = 139;
    		break;
    		case 3:
    			$this->pack_mini = 45;
    			$this->pack_medium = 85;
    			$this->pack_maxi = 145;
    		break;
    		case 1:
    			$this->pack_mini = 49;
    			$this->pack_medium = 89;
    			$this->pack_maxi = 149;
    		break;
    	}
    }
}
