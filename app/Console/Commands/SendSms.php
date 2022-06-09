<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use App\Models\Sms;
use App\Models\Team;
use App\Models\Visit;
use App\Models\Worker;
use App\Models\User;
use App\Models\Patient;

use Serwer\Sms\SerwerSMS\SerwerSMS;

class SendSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:sms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wysyłanie sms czekających na wysłanie.';

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
        $data = Sms::where('status', '=', '0')
                    ->whereDate('date_send', '<=', Carbon::now())
                    ->whereTime('date_send', '<', Carbon::now())
                    ->get();

        foreach($data as $tab) {

            try{
                $patient = Patient::where('id', '=', $tab->patient_id)->first();

                $text = $this->textFilter($tab);

                $serwersms = new SerwerSMS;

                $result = $serwersms->messages->sendSms(
                        array(
                                $patient->phone
                        ),
                        $text,
                        null,
                        array(
                                'details' => true
                        )
                );
                
              //  if($result->success == true) {
                    $sms = Sms::find($tab->id);
                    $sms->status = 2;
                    $sms->save();
                    /*
                } else {
                   $sms = Sms::find($tab->id);
                    $sms->status = 1;
                    $sms->save();   

                    Team::find($tab->team_id)->increment('pack_sms');   
                }
                */

            } catch(Exception $e){
                $sms = Sms::find($tab->id);
                $sms->status = 1;
                $sms->save();   

                Team::find($tab->team_id)->increment('pack_sms');  
            }
        }

        return 0;
    }

    public function textFilter($messages)
    {
        if($messages->visit_id > 0) {
            $team = Team::where('id', '=', $messages->team_id)->first();
            $visit = Visit::where('id', '=', $messages->visit_id)->first();
            $worker = Worker::where('id', '=', $visit['worker_id'])->first();
            $user = User::where('id', '=', $worker->user_id)->first();

            $date = new Carbon($visit->date_visit);
            $address = $team->address_code.' '.$team->address_city.', '.$team->address_street.' '.$team->address_number;
            $doctor = $user->firstname.' '.$user->name;

            $code = array("{date_visit}", "{clock_visit}", "{name}", "{address}", "{dr_name}", "{email}", "{phone}");
            $paste = array($date->format('d-m-Y'), $date->format('H:s'), $team->name, $address, $doctor, $team->email, $team->phone);

            return str_replace($code, $paste, $messages->message);
        } else {
            return $messages->message;
        }
    }
}
