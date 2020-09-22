<?php

namespace App\Http\Controllers;

use Auth;
use Notification;
use App\Notifications\EmailToParticipants;
use Carbon\Carbon;

use App\Models\ParticipantNotification;
use App\Models\Booking;
use App\Models\Student;
use Illuminate\Http\Request;

class ParticipantNotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'subject' => 'required | max:191',
            'body_text' => 'required | max:600',
            'respond_email' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $event_id = request('event_id');

        $notification = new ParticipantNotification();
        $notification->user_id = $user_id;
        $notification->event_id = $event_id;
        $notification->subject = request('subject');
        $notification->body_text = request('body_text');
        $notification->respond_email = request('respond_email');
        $notification->status_id= 5;

        $notification->save();

    }

    public function schedule(Request $request)
    {
        $request->validate([
            'event_id' => 'required',
            'scheduled_date' => 'required',
            'scheduled_time' => 'required',
            'timezone' => 'required',
        ]);


        $event_id = request('event_id');

        $notification = ParticipantNotification::where('event_id', $event_id)
                                                ->first();

        $date = request('scheduled_date');
        $notification->scheduled_date = $date;
        $time = request('scheduled_time');
        $notification->scheduled_time = $time;
        $notification->timezone = request('timezone');
        $notification->status_id = 2;
        $notification->save();

        //UTCへ変換
        $datetime = $date.' '.$time.':00';
        $notification->time_utc = $datetime;
        $notification->save();

    }


    public function fetchList()
    {
        $user_id = Auth::user()->id;

        $emails = ParticipantNotification::join('statuses', 'participant_notifications.status_id', '=', 'statuses.id')
                                        ->join('events', 'participant_notifications.event_id', '=', 'events.id')
                                        ->where('participant_notifications.user_id', $user_id)
                                        ->select(
                                            'events.id',
                                            'events.title', 
                                            'participant_notifications.user_id',  
                                            'participant_notifications.subject',  
                                            'participant_notifications.body_text',  
                                            'participant_notifications.respond_email',  
                                            'participant_notifications.scheduled_date',  
                                            'participant_notifications.scheduled_time',  
                                            'participant_notifications.time_utc',  
                                            'participant_notifications.timezone', 
                                            'statuses.status'
                                        )
                                        ->get();

        // DD($emails);

        return response()->json(['emails'=>$emails],200);

    }

    public function sendEmailToParticipants ()
    {

        //Notificationを送る準備
        $participants = Booking::join('students', 'bookings.student_id', '=', 'students.id')
                                ->where('bookings.event_id', $event_id)
                                ->where('bookings.cancelled', '0')
                                ->get();

        $time = ParticipantNotification::where('event_id', $event_id)
                                        ->select('time_utc')
                                        ->first();

        $when = Carbon::parse($time->time_utc);

        foreach($participants as $participant){

            Notification::send($participant, new EmailToParticipants())->delay($when);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParticipantNotification  $participantNotification
     * @return \Illuminate\Http\Response
     */
    public function show(ParticipantNotification $participantNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParticipantNotification  $participantNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(ParticipantNotification $participantNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParticipantNotification  $participantNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParticipantNotification $participantNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParticipantNotification  $participantNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParticipantNotification $participantNotification)
    {
        //
    }
}
