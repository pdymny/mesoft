<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $message;
    public $email;


    public function __construct($name, $subject, $message, $email)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->message = $message;
        $this->email = $email;
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
            ->view('emails.contact')
            ->with([
                'text' => $this->message,
            ]);
    }
}
