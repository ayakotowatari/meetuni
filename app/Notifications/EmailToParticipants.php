<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class EmailToParticipants extends Notification implements ShouldQueue
{
    use Queueable;

    protected $students;
    protected $message;
    protected $subject; 

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($students, $message, $subject)
    {
        
        $this->students = $students;
        $this->message = $message;
        $this->subject = $subject;

        // $this->delay(Carbon::parse($message->time_utc));
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
                    ->subject($this->subject)
                    ->markdown('emails.email_to_participants', ['message' => $this->message]);
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
