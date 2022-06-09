<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Mail\VisitSend;
use Illuminate\Support\Facades\Mail;

use App\Models\Email;
use App\Models\Team;
use App\Models\Visit;
use App\Models\Worker;
use App\Models\User;
use App\Models\Patient;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Wysyłanie e-maili czekających na wysłanie.';

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
        $data = Email::where('status', '=', '0')
                ->whereDate('date_send', '<=', Carbon::now())
                ->whereTime('date_send', '<', Carbon::now())
                ->get();

        foreach($data as $tab) {
            $patient = Patient::where('id', '=', $tab->patient_id)->first();
            $visit = Visit::where('id', '=', $tab->visit_id)->first();
            $text = $this->textFilter($tab);

            if($tab->visit_id > 0) {
                $visit = Visit::where('id', '=', $tab->visit_id)->first();

                $send = Mail::to($patient->email)->send(new VisitSend($visit->date_visit, $text, $patient->email));
            } else {
                $send = Mail::to($patient->email)->send(new MailingSend($text, $patient->email));
            }

            // zmiana statusu
            if($send == null) {
                $email = Email::find($tab->id);
                $email->status = 2;
                $email->save();
            } else {
                $email = Email::find($tab->id);
                $email->status = 1;
                $email->save();   

                Team::find($tab->team_id)->increment('pack_email');             
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
            $cancel_visit = 'http://mesoft.pl/widget/'.$team->id.'/'.$visit->id;

            $code = array("{date_visit}", "{clock_visit}", "{name}", "{address}", "{dr_name}", "{email}", "{phone}", "{cancel_visit}");
            $paste = array($date->format('d-m-Y'), $date->format('H:s'), $team->name, $address, $doctor, $team->email, $team->phone, $cancel_visit);

            return str_replace($code, $paste, $messages->message);
        } else {
            return $messages->message;
        }
    }
}
