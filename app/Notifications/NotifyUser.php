<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Auth;


class NotifyUser extends Notification
{
    use Queueable;

    public $user;
    public $text;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($text)
    {
        $this->user = Auth::user();
        $this->text = $text;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'team_id' => $this->user->current_team_id,
            'text' => $this->text,
        ];
    }
}
