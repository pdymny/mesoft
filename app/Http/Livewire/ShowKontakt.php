<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;


class ShowKontakt extends Component
{
	public $name;
	public $subject;
	public $message;
	public $email;
	public $where = 'kontakt@mesoft.pl';
    public $send = 0;


    public function render()
    {
        return view('start.kontakt')->layout('layouts.start');
    }

    public function send()
    {

    	Mail::to($this->where)->send(new Contact($this->name, $this->subject, $this->message, $this->email));

        $this->send = 1;
    }
}
