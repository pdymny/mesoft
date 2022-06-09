<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Przelewy24\Przelewy24;
use Carbon\Carbon;
use Illuminate\Http\Response;

use App\Models\Invoice;

class Przelewy24Call extends Component
{

    public function mount()
    {
        $przelewy24 = new Przelewy24([
            'merchant_id' => '133683',
            'crc' => '112a87977739036b',
            'live' => true, // `true` for production/live mode
        ]);

        $webhook = $przelewy24->handleWebhook();
        
        $przelewy24->verify([
            'session_id' => $webhook->sessionId(),
            'order_id' => $webhook->orderId(),   // przelewy24 order id
            'amount' => $webhook->amount(),
        ]); 

        $invoice = Invoice::where('name', '=', $webhook->sessionId())->first();
        $invoice->status = 2;
        $invoice->save();
    }

    public function render()
    {
        return new Response('ok');
    }

}
