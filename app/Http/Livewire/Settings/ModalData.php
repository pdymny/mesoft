<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Auth;

use App\Models\DataInvoice;


class ModalData extends Component
{
	public $name;
	public $nip;
	public $regon;
	public $city;
	public $code;
	public $street;
	public $number;
	public $user;


    protected $rules = [
    	'name' => 'required|string|min:3|max:200',
        'nip' => 'required|string|min:3|max:100',
        'regon' => 'nullable|string|max:100',
        'city' => 'required|string|min:3|max:200',
        'code' => 'required|string|min:3|max:20',
        'street' => 'required|string|min:3|max:200',
        'number' => 'required|string',
    ];


	protected $listeners = ['switchModalData' => 'switchModalData'
						];

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
        return view('settings.modal_data');
    }

    public function switchModalData()
    {
    	$data = DataInvoice::where('team_id', '=', $this->user->current_team_id)->first();

    	if(!empty($data) > 0) {
    		$this->name = $data->name;
			$this->nip = $data->nip;
			$this->regon = $data->regon;
			$this->city = $data->city;
			$this->code = $data->code;
			$this->street = $data->street;
			$this->number = $data->number;
    	}

    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'modalData']);
    }

    public function saveData()
    {
    	$data = DataInvoice::where('team_id', '=', $this->user->current_team_id)->first();
    	if(empty($data)) {
    		$data = new DataInvoice();
    		$data->team_id = $this->user->current_team_id;
    	}

    	$this->validate();

    	$data->name = $this->name;
    	$data->nip = $this->nip;
		$data->regon = $this->regon;
		$data->city = $this->city;
		$data->code = $this->code;
		$data->street = $this->street;
		$data->number = $this->number;
		$data->save();

		$this->dispatchBrowserEvent('close-modal', ['modal' => 'modalData']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Zapisano poprawnie.']);
    }
}
