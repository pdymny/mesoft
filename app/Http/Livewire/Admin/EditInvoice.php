<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Auth;

use App\Models\Invoice;

use App\Notifications\NotifyUser;

class EditInvoice extends Component
{

    public $idInv;
    public $name;
    public $status;

    protected $listeners = ['editInvoice' => 'editInvoice', 'saveInvoice' => 'saveInvoice'];

    public function editInvoice($id)
    {

        $this->idInv = $id;

        $this->dispatchBrowserEvent('open-modal', ['modal' => 'editInvoice']);
    }

    public function render()
    {
        if($this->idInv > 0) {
            $invoice = Invoice::find($this->idInv);

            $this->name = $invoice->name;
            $this->status = $invoice->status;

            $settings = json_decode($invoice->settings);

            $settings = $settings->client;

        } else {
            $invoice = "";
            $settings = "";
        }

        return view('admin.edit-invoice', ['invoice' => $invoice, 'settings' => $settings]);
    }

    public function saveInvoice()
    {
        $invoice = Invoice::find($this->idInv);
        $invoice->name = $this->name;
        $invoice->status = $this->status;
        $invoice->save();

        $this->emit('refreshTableInvoice');
        $this->dispatchBrowserEvent('close-modal', ['modal' => 'editInvoice']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Uaktualniono dane poprawnie.']);     
    }

}
