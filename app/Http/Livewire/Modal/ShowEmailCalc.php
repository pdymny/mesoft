<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use Auth;
use Carbon\Carbon;

use App\Models\Invoice;
use App\Models\InvoiceRecords;
use App\Models\DataInvoice;


class ShowEmailCalc extends Component
{
	public $email = [
		['id' => '1', 'quantity' => '1000', 'cost' => '5'],
		['id' => '2', 'quantity' => '2000', 'cost' => '10'],
		['id' => '3', 'quantity' => '5000', 'cost' => '25'],
		['id' => '4', 'quantity' => '10000', 'cost' => '50'],
	];

	public $switch_email;
    public $cost;
    public $user;
    public $data_invoice;

    protected $listeners = ['generateInvoiceEmail' => 'generateInvoiceEmail'];


    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $this->data_invoice = DataInvoice::where('team_id', '=', $this->user->current_team_id)->first();

        return view('modal.show_email_calc');
    }

    public function generateInvoiceEmail()
    {
        $count_invoice = Invoice::whereYear('created_at', Carbon::now()->year)->count();

        $this->cost = $this->email[$this->switch_email-1]['cost'];
        $quantity = $this->email[$this->switch_email-1]['quantity'];

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
            $record->name = "Pakiet ".$quantity." sztuk e-mail.";
            $record->unity = 1;
            $record->pieces = $this->cost;
            $record->sum = $this->cost;
            $record->settings = json_encode(['what' => 'email', 'quantity' => $quantity]);
            $record->save();

            $this->emit('refreshTableInvoice');
            
            $this->dispatchBrowserEvent('close-modal', ['modal' => 'printEmail']);
            $this->emit('modalPay', [$invoice->id]);

        } else {
            return 'Błąd';
        }
    }
}
