<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Paynow\Notification;
use Carbon\Carbon;
//use Paynow\Client;
//use Paynow\Environment;
//use Paynow\Exception\PaynowException;
//use Paynow\Service\Payment;
use Przelewy24\Przelewy24;

use App\Models\Invoice;
use App\Models\InvoiceRecords;
use App\Models\Team;


class PayStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pay:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sprawdzenie i zatwierdzenie, czy płatnośc została dokonana.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $invoices = Invoice::where('status', '=', '2')->get();

        foreach($invoices as $invoice) {

            if(!empty($invoice->payment_id)) {
                $this->settingsUpdate($invoice);

                $invoice->status = 3;
                $invoice->save();
            }
        }

        return 0;
    }

    private function whatStatus($invoice) 
    {
        /*
        $client = new Client('2fde49df-3034-4b01-99f8-740bf9efd461', 'c9f20015-b6b1-4986-9946-16cdfefdd918', Environment::SANDBOX);

        $payment = new Payment($client);
        $status = $payment->status($invoice['payment_id']);

        return $status;
        */

        $invoice_sum = InvoiceRecords::where('invoice_id', '=', $invoice['id'])->sum('sum');
        $amount = round($invoice_sum + (($invoice_sum * 23) / 100), 2);


        $przelewy24 = new Przelewy24([
            'merchant_id' => '133683',
            'crc' => '4c5e95dbbbf60b48',
            'live' => false, // `true` for production/live mode
        ]);

       // $webhook = $przelewy24->handleWebhook();

        $test = $przelewy24->verify([
            'session_id' => $invoice['name'],
            'order_id' => '300147701',   // przelewy24 order id
            'amount' => $amount*100,
        ]);



        dd($test);
    }

    private function settingsUpdate($invoice) {
        $records = InvoiceRecords::where('invoice_id', '=', $invoice->id)->get();

        foreach($records as $tab) {
            $settings = json_decode($tab->settings);

            switch($settings->what) {
                case 'pack':
                    $team = Team::where('id', '=', $invoice->team_id)->first();

                    $actual_term = new Carbon($team->pack_term);

                    if($actual_term > Carbon::now()) {
                        $term = $actual_term->addMonths($settings->time);
                    } else {
                        $term = Carbon::now();
                        $term->addMonths($settings->time);
                    }

                    $team->id_pack = $settings->id_pack;
                    $team->pack_term = $term;
                    $team->pack_sms = $team->pack_sms + $settings->sms_plus;
                    $team->pack_email = $team->pack_email + $settings->email_plus;
                    $team->save();
                break;
                case 'sms':
                    $team = Team::where('id', '=', $invoice->team_id)->first();
                    $team->pack_sms = $team->pack_sms + $settings->quantity;
                    $team->save();
                break;
                case 'email':
                    $team = Team::where('id', '=', $invoice->team_id)->first();
                    $team->pack_email = $team->pack_email + $settings->quantity;
                    $team->save();
                break;
            }

        }

    }
}
