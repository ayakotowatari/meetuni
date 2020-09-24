<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ParticipantNotification;
use Notification;

class SendEmailToParticipantsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $booking;
    // protected $message_id;
    protected $notificationClass;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($booking, $notificationClass)
    {
        $this->booking = $booking;
        // $this->message_id = $message_id;
        $this->notificationClass = $notificationClass;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->booking, $this->notificationClass);

        // $message = ParticipantNotification::where('id', $this->message_id)->first();
        // $message->status_id = 10;
        // $message->save();

    }
}
