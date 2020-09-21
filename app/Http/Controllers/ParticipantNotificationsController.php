<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\ParticipantNotification;
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
            'scheduled_date' => 'required',
            'scheduled_time' => 'required',
            'timezone' => 'required',
        ]);

        $user_id = Auth::user()->id;

        $notification = new ParticipantNotification();
        $notification->user_id = $user_id;
        $notification->event_id = request('event_id');
        $notification->subject = request('subject');
        $notification->body_text = request('body_text');
        $notification->respond_email = request('respond_email');

        $date = request('scheduled_date');
        $notification->scheduled_date = $date;
        $time = request('scheduled_time');
        $notification->scheduled_time = $time;

        $notification->timezone = request('timezone');
        $notification->scheduled = 0;

        $notification->save();

        //UTCへ変換
        $datetime = $date.' '.$time.':00';

        ParticipantNotification::latest('created_at')
                            ->where('user_id', $user_id)
                            ->update([ 
                                'time_utc' => $datetime
                            ]);
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
