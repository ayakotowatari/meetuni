<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserInviteNotification extends Notification
{
    use Queueable;

    protected $notification_url;

    /**
     * Create a new notification_url instance.
     * @param $notification_url
     * @return void
     */
    public function __construct($notification_url, $user)
    {
        $this->notification_url = $notification_url;
        $this->full_name = $user->first_name.' '.$user->last_name;
        
        $inst = User::join('insts', 'users.inst_id', '=', 'insts.id')
                    ->where('users.id', $user->id)
                    ->select('insts.name')
                    ->first();
                    
        $this->inst = $inst->name;
    }

    /**
     * Get the notification_url's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification_url.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
                    ->subject($this->full_name.' invites you to join meetUni')
                    ->greeting('Greetings!')
                    ->line($this->full_name.' from '.$this->inst.' is to invite you to join the platform: '.config('app.name'))
                    ->action('Register Here', $this->notification_url)
                    ->line('Thank you for registering to our service!');
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
