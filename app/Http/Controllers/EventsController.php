<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\InstUser;
use App\Models\Inst;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
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
        $user_id = Auth::user()->id;
        $inst = InstUser::join('insts', 'inst_users.inst_id', 'insts.id')
                ->where('inst_users.id', $user_id)
                ->select('insts.id')
                ->first();

        $validatedData = $request->validate([
                'title' => 'required | max:191',
                'date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'regions' => 'required',
                'levels' => 'required',
                "subjects" => 'required',
                'description' => 'required | max:300',
        ]);
        
        //store event
        $event = new Event();
        
        $event->title = request('title');
        $event->inst_id = $inst->id;
        $date = request("date");
        $event->date = $date;
        $start_time = request("start_time");
        $event->start_time = $start_time;
        $end_time = request("end_time");
        $event->end_time = $end_time;

        // $event->start_utc = '2020-10-20 10:00:00';
       
        $date_starttime = $date.' '.$start_time.':00';
        $event->start_utc = $date_starttime;
       
        $date_endtime = $date.' '.$end_time.':00';
        $event->end_utc = $date_endtime;
        
        // $event->end_utc = '2020-10-20 11:00:00';

        $event->description = request('description');

        $event->img = ''; 

        $event->capacity_id = 1;
        $event->status_id = 3;
        $event->inst_user_id = $user_id;

        $event->save();

        //event_regionテーブルへの挿入
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
