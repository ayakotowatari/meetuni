<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventCancellationConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    protected $student;
    protected $event;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($student, $event)
    {
        $this->student = $student;
        $this->event = $event;
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
                ->subject('Event Booking Cancelled')
                ->markdown('emails.event_cancellation_confirmation', ['student' => $this->student, 'event'=>$this->event]);
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
