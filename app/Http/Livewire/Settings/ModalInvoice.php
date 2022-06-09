<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Auth;
use Carbon\Carbon;

use App\Models\Invoice;
use App\Models\InvoiceRecords;
use App\Models\DataInvoice;


class ModalInvoice extends Component
{
	public $pack = [
		[	'id' => '1', 
			'name' => 'Mini', 
			'visit' => 'Brak limitu', 
			'data' => '2 GB', 
			'sms' => '50', 
			'email' => '200', 
			'account' => '5', 
			'workers' => '5', 
			'cost' => [
				'month' => '49',
				'three_month' => '45',
				'six_month' => '39',
				'twelve_month' => '29',
			],
		],
		[	'id' => '2', 
			'name' => 'Medium', 
			'visit' => 'Brak limitu', 
			'data' => '5 GB', 
			'sms' => '100', 
			'email' => '500', 
			'account' => '10', 
			'workers' => '10', 
			'cost' => [
				'month' => '89',
				'three_month' => '85',
				'six_month' => '79',
				'twelve_month' => '69',
			],
		],
		[	'id' => '3', 
			'name' => 'Maxi', 
			'visit' => 'Brak limitu', 
			'data' => '20 GB', 
			'sms' => '200', 
			'email' => '1000', 
			'account' => 0, 
			'workers' => 0, 
			'cost' => [
				'month' => '149',
				'three_month' => '145',
				'six_month' => '139',
				'twelve_month' => '129',
			],
		],
	];

	public $switch_pack = 1;
	public $time = 12;
	public $cost = 0;
	public $cost_month = '29';
	public $suma;
	public $vat;
	public $suma_vat;
	public $user;
	public $data_invoice;


	protected $listeners = ['switchModalInvoice' => 'switchModalInvoice', 'generateInvoicePack' => 'generateInvoicePack'];

	public function mount()
	{
		$this->user = Auth::user();
	}

    public function render()
    {
    	$this->data_invoice = DataInvoice::where('team_id', '=', $this->user->current_team_id)->first();

        return view('settings.modal_invoice');
    }

    public function switchModalInvoice()
    {
    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'modalInvoice']);
    }

    public function calcPack() 
    {
    	switch($this->time) {
    		case 1: $rec = "month"; break;
    		case 3: $rec = 'three_month'; break;
    		case 6: $rec = 'six_month'; break;
    		case 12: $rec = 'twelve_month'; break;
    		default: $rec = ''; break;
     	}

     	if(!empty($rec)) {
     		$this->cost_month = $this->pack[$this->switch_pack-1]['cost'][$rec];
     	} else {
     		$this->cost_month = 0;
     	}

     	$this->suma = $this->time * $this->cost_month;
     	$this->vat = $this->suma*23/100;
     	$this->suma_vat = $this->vat+$this->suma;
    }

    public function generateInvoicePack()
    {
    	$count_invoice = Invoice::whereYear('created_at', Carbon::now()->year)->count();

    	if(!empty($this->data_invoice)) {
	    	$invoice = new Invoice;
	    	$invoice->user_id = $this->user->id;
	    	$invoice->team_id = $this->user->current_team_id;
	    	$invoice->recommend_id = 0;
	    	$invoice->name = ($count_invoice+1).'/'.Carbon::now()->year.'/S1';
	    	$invoice->status = 1;
	    	$invoice->settings = json_encode([
	    		'client' => [
	    			'name' => $this->data_invoice->name,
	    			'nip' => $this->data_invoice->nip,
					'regon' => $this->data_invoice->regon,
					'city' => $this->data_invoice->city,
					'code' => $this->data_invoice->code,
					'street' => $this->data_invoice->street,
					'number' => $this->data_invoice->number,
	    		],
	    		'my' => [
	    			'name' => 'DymCode Paweł Dymny',
	    			'nip' => 'do uzupełnienia',
					'regon' => 'do uzupełnienia',
					'city' => 'Wielki Komorsk',
					'code' => '86-160',
					'street' => 'Kozłowiec',
					'number' => '18A',
	    		]
	    	]);
	    	$invoice->payment_id = "";
	    	$invoice->save();

	    	$record = new InvoiceRecords;
	    	$record->invoice_id = $invoice->id;
	    	$record->name = "Pakiet ".$this->pack[$this->switch_pack-1]['name']." na okres ".$this->time." miesięcy.";
	    	$record->unity = 1;
	    	$record->pieces = $this->suma;
	    	$record->sum = $this->suma;
	    	$record->settings = json_encode(['what' => 'pack', 'id_pack' => $this->switch_pack, 'time' => $this->time, 'sms_plus' => $this->pack[$this->switch_pack-1]['sms'], 'email_plus' => $this->pack[$this->switch_pack-1]['email']]);
	    	$record->save();

	    	$this->emit('refreshTableInvoice');
	    	
	    	$this->dispatchBrowserEvent('close-modal', ['modal' => 'modalInvoice']);
	    	$this->emit('modalPay', [$invoice->id]);

	    } else {
	    	return 'Błąd';
	    }
    }
}