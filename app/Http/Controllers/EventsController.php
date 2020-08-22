<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\InstUser;
use App\Models\Inst;
use App\Models\Event;
use App\Models\EventRegion;
use App\Models\EventLevel;
use App\Models\EventSubject;
use Illuminate\Http\Request;
use Validator;

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

        $request->validate([
                'title' => 'required | max:191',
                'date' => 'required',
                'timezone' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'regions' => 'required',
                'levels' => 'required',
                "subjects" => 'required',
                'description' => 'required | max:300',
                // 'img' => 'required'
        ]);
        
        //store event
        $event = new Event();
        
        $event->title = request('title');
        $event->inst_id = $inst->id;
        $date = request("date");
        $event->date = $date;
        $event->timezone = request("timezone");
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

        $event->img = NULL; 

        $event->capacity_id = 1;
        $event->status_id = 3;
        $event->inst_user_id = $user_id;

        $event->save();

        //event_idの取得
        $event_id = $event->id;

        //event_regionテーブルへの挿入
        $regions = request("regions");

        foreach($regions as $region){
            $event_region = new EventRegion();
            $event_region->event_id = $event_id;
            $event_region->region_id = $region;
            $event_region->save();
        }

        //event_levelテーブルへの挿入
        $levels = request("levels");

        foreach($levels as $level){
            $event_level = new EventLevel();
            $event_level->event_id = $event_id;
            $event_level->level_id = $level;
            $event_level->save();
        }

        //event_subjectテーブルへの挿入
        $subjects = request("subjects");

        foreach($subjects as $subject){
            $event_subject = new EventSubject();
            $event_subject->event_id = $event_id;
            $event_subject->subject_id = $subject;
            $event_subject->save();
        }

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
