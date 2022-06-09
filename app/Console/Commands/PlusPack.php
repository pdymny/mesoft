<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Models\Team;


class PlusPack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pack:plus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dodawanie sms i e-maili z pakietu co miesiąc.';

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
        $teams = Team::where('id_pack', '>', '0')
                ->whereDate('pack_term', '>', Carbon::now())
                ->get();

        foreach($teams as $tab) {

            switch($tab->id_pack) {
                case 1:
                    $plus_sms = 50;
                    $plus_email = 200;
                break;
                case 2:
                    $plus_sms = 100;
                    $plus_email = 500;
                break;
                case 3:
                    $plus_sms = 200;
                    $plus_email = 1000;
                break;
                default:
                    $plus_sms = 0;
                    $plus_email = 0;
                break;
            }

            $tab->pack_sms = $tab->pack_sms + $plus_sms;
            $tab->pack_email = $tab->pack_email + $plus_email;
            $tab->save();
        }

        return 0;
    }
}
