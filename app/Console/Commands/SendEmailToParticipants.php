<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ParticipantNotification;
use App\Models\Booking;
use App\Models\Event;
use App\Jobs\SendEmailToParticipantsJob;
use App\Notifications\EmailToParticipants;
use Carbon\Carbon;

class SendEmailToParticipants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emailtoparticipants';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to event participants';

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
     * @return mixed
     */
    public function handle()
    {
        // $messages = ParticipantNotification::all();
        
        // foreach($messages as $message){
        //     $bookings = Booking::where('event_id', $message->event_id)
        //                                 ->where('cancelled', 0)
        //                                 ->get();

        //     $event_detail = Event::find($message->event_id);

        //     $subject = $message->subject;

        //     foreach($bookings as $booking) {
        //         dispatch(new SendEmailToParticipantsJob(
        //             $booking, 
        //             new EmailToParticipants($booking, $message, $subject, $event_detail))
        //         );
        //     }
        //     $message->status_id = 10;
        //     $message->save();   
        // }
        // One hour is added to compensate for PHP being one hour faster 
        $now = date("Y-m-d H:i:00", strtotime(Carbon::now()));
        logger($now);

        $messages = ParticipantNotification::all();
        if($messages !== null){
            //Get all messages that their dispatch date is due
            $messages->where('time_utc', $now)->each(function($message) {
                if($message->status_id == 2)
                {
                    $bookings = Booking::where('event_id', $message->event_id)
                                        ->where('cancelled', 0)
                                        ->get();

                    $event_detail = Event::find($message->event_id);

                    $subject = $message->subject;

                    foreach($bookings as $booking) {
                        dispatch(new SendEmailToParticipantsJob(
                            $booking, 
                            new EmailToParticipants($booking, $message, $subject, $event_detail))
                        );
                    }
                    $message->status_id = 10;
                    $message->save();   
                }
            });
        }
    }
}
