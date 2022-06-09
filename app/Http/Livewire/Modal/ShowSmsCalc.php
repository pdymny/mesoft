<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use Auth;
use Carbon\Carbon;

use App\Models\Invoice;
use App\Models\InvoiceRecords;
use App\Models\DataInvoice;


class ShowSmsCalc extends Component
{
	public $sms = [
		['id' => '1', 'quantity' => '100', 'cost' => '15'],
		['id' => '2', 'quantity' => '200', 'cost' => '30'],
		['id' => '3', 'quantity' => '500', 'cost' => '75'],
		['id' => '4', 'quantity' => '1000', 'cost' => '150'],
	];

	public $switch_sms;
    public $cost;
    public $user;
    public $data_invoice;

    protected $listeners = ['generateInvoiceSms' => 'generateInvoiceSms'];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $this->data_invoice = DataInvoice::where('team_id', '=', $this->user->current_team_id)->first();

        return view('modal.show_sms_calc');
    }

    public function switch($id) 
    {
    	$this->switch_sms = $id;
    }

    public function generateInvoiceSms()
    {
        $count_invoice = Invoice::whereYear('created_at', Carbon::now()->year)->count();

        $this->cost = $this->sms[$this->switch_sms-1]['cost'];
        $quantity = $this->sms[$this->switch_sms-1]['quantity'];

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
            $record->name = "Pakiet ".$quantity." sztuk sms.";
            $record->unity = 1;
            $record->pieces = $this->cost;
            $record->sum = $this->cost;
            $record->settings = json_encode(['what' => 'sms', 'quantity' => $quantity]);
            $record->save();

            $this->emit('refreshTableInvoice');
            
            $this->dispatchBrowserEvent('close-modal', ['modal' => 'printSms']);
            $this->emit('modalPay', [$invoice->id]);

        } else {
            return 'Błąd';
        }
    }
}
