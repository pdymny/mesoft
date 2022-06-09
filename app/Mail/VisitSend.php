<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitSend extends Mailable
{
    use Queueable, SerializesModels;

    public $date_visit;
    public $text;
    public $email;
    public $subject;


    public function __construct($date_visit, $text, $email)
    {
        $this->date_visit = $date_visit;
        $this->text = $text;
        $this->email = $email;

        $this->subject = "Przypominamy o wizycie dnia: ".$date_visit.".";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email, $this->email)
            ->replyTo($this->email, $this->email)
            ->subject($this->subject)
            ->view('emails.visit_send')
            ->with([
                'text' => $this->text,
            ]);
    }
}
