<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use Auth;
//use Paynow\Client;
//use Paynow\Environment;
//use Paynow\Exception\PaynowException;
//use Paynow\Service\Payment;
//use Omnipay\Omnipay;

use Przelewy24\Przelewy24;

use App\Models\Invoice;
use App\Models\InvoiceRecords;
use App\Models\User;


class ModalPay extends Component
{
    public $idInvoice;
    public $invoice;
    public $invoice_records = [];
    public $invoice_sum;
    public $code;
    public $user;

    public $table_code = array('start20pack' => '20');


	protected $listeners = ['modalPay' => 'modalPay', 'refreshPay' => '$refresh'];

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('modal.modal_pay');
    }

    public function modalPay($id)
    {
        $this->idInvoice = $id;
        if($this->idInvoice > 0) {
            $this->baseData();
        }

    	$this->dispatchBrowserEvent('open-modal', ['modal' => 'modalPay']);
    }

    public function saveCode()
    {
        $code = User::where('recomend_code', '=', $this->code)->first();

        if(array_key_exists($this->code, $this->table_code)) {
            foreach($this->table_code as $tab => $value) {
                if($tab == $this->code) {
                    $this->generateRabate($value, '1');

                    session()->flash('message', 'Aktywowano rabat w postaci '.$value.'%.');
                }
            }
        } elseif(!empty($code)) {
            $this->generateRabate(5, $code->id);

            session()->flash('message', 'Aktywowano 5% zniżki z polecenia.');
        } else {
            session()->flash('message', 'Brak takiego kodu w systemie.');
        }
    }

    private function generateRabate($rabate, $stat)
    {
        $rabat = round(($this->invoice_sum*$rabate)/100, 2);

        $record = new InvoiceRecords;
        $record->invoice_id = $this->invoice->id;
        $record->name = "Rabat: ".$rabate."%";
        $record->unity = 1;
        $record->pieces = '-'.$rabat;
        $record->sum = '-'.$rabat;
        $record->settings = "";
        $record->save();

        $invoice = Invoice::find($this->invoice->id);
        $invoice->recommend_id = $stat;
        $invoice->save();

        $this->code = '';
        $this->baseData();

        $this->emit('refreshPay');
        $this->emit('refreshTableInvoice');
    }

    public function pay()
    {
        /*
        $client = new Client('2fde49df-3034-4b01-99f8-740bf9efd461', 'c9f20015-b6b1-4986-9946-16cdfefdd918', Environment::SANDBOX);

        $orderReference = $this->invoice['name'];
        $idempotencyKey = uniqid($orderReference . '_');
        $amount = round($this->invoice_sum + (($this->invoice_sum * 23) / 100), 2) * 100;

        $paymentData = [
            "amount" => $amount,
            "currency" => "PLN",
            "externalId" => $orderReference,
            "description" => "Płatność z systemu Mesoft.",
            "buyer" => [
                "email" => $this->user->email
            ]
        ];

        try {
            $payment = new Payment($client);
            $result = $payment->authorize($paymentData, $idempotencyKey);

            $invoice = Invoice::find($this->invoice->id);
            $invoice->payment_id = $result->getPaymentId();
            $invoice->status = 2;
            $invoice->save();

            $this->redirect($result->getRedirectUrl());

        } catch (PaynowException $exception) {
            session()->flash('message', 'Błąd połączenia z płatnościami. Skontaktuj się z administracją. ('.$exception.')');
        }
        */

        $amount = round($this->invoice_sum + (($this->invoice_sum * 23) / 100), 2);

        $przelewy24 = new Przelewy24([
            'merchant_id' => '133683',
            'crc' => '112a87977739036b',
            'live' => true, // `true` for production/live mode
        ]);

        $transaction = $przelewy24->transaction([
            'session_id' => $this->invoice['name'],
            'url_return' => 'https://www.mesoft.pl/payments',
            'url_status' => 'https://www.mesoft.pl/przelewy24',
            'amount' => $amount*100,
            'description' => 'Płatność z systemu Mesoft.',
            'email' => $this->user->email,
        ]);

        if(empty($transaction->token())) {
            session()->flash('message', 'Błąd połączenia z płatnościami. Skontaktuj się z administracją.');
        } else {
            $this->redirect($transaction->redirectUrl());

            $invoice = Invoice::find($this->invoice->id);
            $invoice->payment_id = $transaction->token();
            $invoice->save();
        }
    }

    private function baseData()
    {
        $this->invoice = Invoice::where('team_id', '=', $this->user->current_team_id)
                    ->where('id', '=', $this->idInvoice)
                    ->first();
        $this->invoice_records = InvoiceRecords::where('invoice_id', '=', $this->idInvoice)->get();
        $this->invoice_sum = InvoiceRecords::where('invoice_id', '=', $this->idInvoice)->sum('sum');
    }
}
