<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $student;
    protected $event;
    protected $inst_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($student, $event, $inst_name)
    {
        $this->student = $student;
        $this->event = $event;
        $this->inst_name = $inst_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->from(config('mail.from.address'))
                ->subject('New Event from '.$this->inst_name)
                ->markdown('emails.email_to_followers', ['student' => $this->student, 'event'=>$this->event, 'inst_name'=>$this->inst_name]);
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
            //
        ];
    }
}
