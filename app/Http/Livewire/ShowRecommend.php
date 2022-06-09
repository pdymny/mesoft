<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;

use App\Models\User;
use App\Models\Recomend;

class ShowRecommend extends Component
{
	public $code;
	public $recomend_acount;

    protected $rules = [
        'code' => 'required|string|min:5|max:10',
    ];

    protected $listeners = ['ShowRecRefresh' => '$refresh'];


    public function render()
    {
    	$this->recomend_acount = Recomend::where('user_id', '=', Auth::user()->id)
    								->latest()
                					->first();

        return view('profile.show_recommend');
    }

    public function saveCode()
    {
    	$users = User::where('recomend_code', '=', $this->code)->first();

    	if(empty($users)) {

            $this->validate();
            
    		$save = User::find(Auth::user()->id);
    		$save->recomend_code = $this->code;
    		$save->save();

    	}

        $this->emit('ShowRecRefresh');
    }
}
