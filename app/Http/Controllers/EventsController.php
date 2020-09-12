<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\InstUser;
use App\Models\Inst;
use App\Models\Student;
use App\Models\Event;
use App\Models\EventRegion;
use App\Models\EventLevel;
use App\Models\EventSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Storage;
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

    public function fetchAllEvents(){

        $events = Event::join('insts', 'events.inst_id', '=', 'insts.id')
                    ->where('events.id', '>', '82')
                    ->where('events.id', '<', '90')
                    ->orderBy('events.created_at')
                    ->select('events.id', 'events.title', 'insts.name', 'events.date', 'events.timezone', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image')
                    ->get();

        // DD($event->liked_by_user);

        // return view ('student/test', ['events'=>$events]);

        return response()->json(['events'=>$events],200);
    }

    public function fetchSingleEvent(Request $request, $id){

        $event = Event::join('insts', 'events.inst_id', '=', 'insts.id')
                    ->where('events.id', $id)
                    ->select('events.id', 'events.title', 'insts.name', 'events.inst_id', 'events.date', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image')
                    ->first();

        $regions = Event::join('event_regions', 'events.id', '=', 'event_regions.event_id')
                            ->join('regions', 'event_regions.region_id', '=', 'regions.id')
                            ->where('events.id', $id)
                            ->select('regions.region')
                            ->get();

        $levels = Event::join('event_levels', 'events.id', '=', 'event_levels.event_id')
                            ->join('levels', 'event_levels.level_id', '=', 'levels.id')
                            ->where('events.id', $id)
                            ->select('levels.level')
                            ->get();

        $subjects = Event::join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                            ->join('subjects', 'event_subjects.subject_id', '=', 'subjects.id')
                            ->where('events.id', $id)
                            ->select('subjects.subject')
                            ->get();

        return response()->json(['event'=>$event, 'regions'=>$regions, 'levels'=>$levels, 'subjects'=>$subjects],200);
        
    }       

    public function recommendSubjectEvents(Request $request, $id){

        // $levels = Student::join('level_students', 'students.id' ,'=', 'level_students.student_id')
        //                     ->join('levels', 'levels.id', '=', 'level_students.level_id')
        //                     ->where('students.id', $id)
        //                     ->select('levels.id')
        //                     ->get();

        // DD($levels);

        $subjects = Student::join('student_subjects', 'students.id', '=', 'student_subjects.student_id')
                                ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
                                ->where('students.id', $id)
                                ->select('subjects.id')
                                ->get();
        // DD($subjects);

        // $events=[];

        foreach($subjects as $subject){
            $events[] = Event::join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                    ->join('insts', 'events.inst_id', '=', 'insts.id')
                    ->join('event_levels', 'events.id', '=', 'event_levels.event_id')
                    ->join('subjects', 'event_subjects.subject_id', '=', 'subjects.id')
                    ->where('event_subjects.subject_id', $subject->id)
                    ->where(function($query){
                        $query->where('event_levels.level_id', 6)
                              ->orWhere('event_levels.level_id', 1);
                    })
                    ->select('subjects.subject', 'events.id', 'events.title', 'insts.name', 'events.date', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image')
                    ->get();
        };
        // DD($events);
        $array = $events;
        $flattened_events = Arr::flatten($array);
        $unique = array_unique($flattened_events);

        // DD($unique);

        // return view('student.test', ['events'=>$unique]);
        return response()->json(['events'=>$unique],200);
    }

    public function recommendDestinationEvents(Request $request, $id)
    {
        $destinations = Student::join('country_students', 'students.id' ,'=', 'country_students.student_id')
                            ->join('countries', 'countries.id', '=', 'country_students.country_id')
                            ->where('students.id', $id)
                            ->select('countries.id')
                            ->get();

        // DD($destinations);

        foreach($destinations as $destination){

            $events[] = Event::join('insts', 'events.inst_id', '=', 'insts.id')
                            ->join('countries', 'insts.country_id', '=', 'countries.id')
                            ->join('event_levels', 'events.id', '=', 'event_levels.event_id')
                            ->join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                            ->where('countries.id', $destination->id)
                            ->where('event_subjects.subject_id', 1)
                            ->where(function($query){
                                $query->where('event_levels.level_id', 1)
                                      ->orWhere('event_levels.level_id', 6)
                                      ->orWhere('event_levels.level_id', 10);
                            })
                            ->select('events.id', 'events.title', 'insts.name', 'events.date', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image')
                            ->get();
        }

        // DD($events);

        $array = $events;
        $flattened_events = Arr::flatten($array);
        $unique = array_unique($flattened_events);

        // DD($unique);

        // DD($unique);

        return response()->json(['events'=>$unique],200);

        // return view('student.test',['events'=>$unique]);

    }

    public function recommendRegionEvents(Request $request, $id)
    {
        $region = Student::join('countries', 'students.country_id', '=', 'countries.id')
                        ->join('regions', 'countries.region_id', '=', 'regions.id')
                        ->where('students.id', $id)
                        ->select('regions.id')
                        ->get();

        // DD($region);

        $events = Event::join('event_regions', 'events.id', '=', 'event_regions.event_id')
                    ->join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                    ->join('event_levels', 'events.id', '=', 'event_levels.event_id')
                    ->where('event_regions.region_id', $region)
                    ->where('event_subjects.subject_id', 1)
                    ->where(function($query){
                        $query->where('event_levels.level_id', 1)
                              ->orWhere('event_levels.level_id', 6)
                              ->orWhere('event_levels.level_id', 10);
                    })
                    ->get();

        // DD($events);

        // $array = $events;
        // $flattened_events = Arr::flatten($array);

        if($events->isEmpty()){
            return 'There was no record';
        }else{
            $unique = array_unique($events);
            return response()->json(['events'=>$unique],200);
        }
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
    public function storeBasics(Request $request)
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
        ]);

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

        // UTCへの変換
        $date_starttime = $date.' '.$start_time.':00';
        $event->start_utc = $date_starttime;
       
        $date_endtime = $date.' '.$end_time.':00';
        $event->end_utc = $date_endtime;
        
        $event->description = Null;
        $event->image = Null;

        $event->capacity_id = 1;
        $event->status_id = 3;
        $event->inst_user_id = $user_id;

        $event->save();
    }

    public function storeSelects(Request $request)
    {
        $user_id = Auth::user()->id;
        $event = Event::latest('created_at')
                ->where('events.inst_user_id', $user_id)
                ->first();
        
        $request->validate([
            'regions' => 'required',
            'levels' => 'required',
            'subjects' => 'required',
        ]);

        // $update = [
        //     'title' => $request->title,
        //     'details' => $request->details
        // ];
        // Test::where('id', $id)->update($update);

        $event_id = $event->id;

        $regions = request("regions");

        //event_regionテーブルへの挿入
        foreach($regions as $region){
            $event_region = new EventRegion();
            $event_region->event_id = $event_id;
            $event_region->region_id = $region;
            $event_region->save();
        }

        $levels = request('levels');

        //event_levelテーブルへの挿入
        foreach($levels as $level){
            $event_level = new EventLevel();
            $event_level->event_id = $event_id;
            $event_level->level_id = $level;
            $event_level->save();
        }

        $subjects = request('subjects');

        //event_subjectテーブルへの挿入
        foreach($subjects as $subject){
            $event_subject = new EventSubject();
            $event_subject->event_id = $event_id;
            $event_subject->subject_id = $subject;
            $event_subject->save();
        }
    }

    public function storeFile(Request $request)
    {
        $user_id = Auth::user()->id;
        $event = Event::latest('created_at')
                ->where('events.inst_user_id', $user_id)
                ->first();
        $event_id = $event->id;

        $request->validate([
                'description' => 'required | max:600',
                'image' => 'required | image | max:5000'
        ]);

        $description = request('description');

        $image = $request->file('image');
        $disk = Storage::disk('local');
        // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる
        // $disk = Storage::disk('s3');

        $path = $disk->put('public', $image);
        $filename = ltrim($path, 'public/');

        // if($image){
            
        //     $file_name = time().'.'.$request->file->getClientOriginalName();

        //     //putAsは自分で名前を決められる
        //     //（第一引数：保存場所、第二引数：画像ファイル、第三引数：ファイル名）
        //     $path = $disk->putFileAs('image', $image, $file_name);
        // }

        //update event

        Event::where('events.id', $event_id)
                ->update([ 
                    'description' => $description, 
                    'image' => $filename 
                ]);

        $event = Event::where('id', $event_id)
                    ->select('id')
                    ->first();

        return response()->json(['event' => $event],200);
    }
    
    public function updateBasics(Request $request){

        $request->validate([
            'id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'timezone' => 'required',
            'start_time' => 'required',
            'end_time' => 'required'
        ]);

        $id = request('id');
        $title = request('title');
        $date = request('date');
        $timezone = request('timezone');
        $start_time = request("start_time");
        $end_time = request("end_time");
        // UTCへの変換
        $date_starttime = $date.' '.$start_time.':00';
        $date_endtime = $date.' '.$end_time.':00';

        $event = Event::find($id);

        $event->title = $title;
        $event->date = $date;
        $event->timezone = $timezone;
        $event->start_time = $start_time;
        $event->end_time = $end_time;
        $event->start_utc = $date_starttime;
        $event->end_utc = $date_endtime;

        $event -> save();
    }
    public function updateRegions(Request $request)
    {

        $request->validate([
            'id' => 'required',
            'regions' => 'required'
        ]);

        $id = request('id');
        $regions = request('regions');

        EventRegion::where('event_id', $id)
            ->delete();

        foreach($regions as $region){
            $eventRegion = new EventRegion();
            $eventRegion->event_id = $id;
            $eventRegion->region_id = $region;
            $eventRegion->save();
        }
    }

    public function updateLevels(Request $request){

        $request->validate([
            'id' => 'required',
            'levels' => 'required'
        ]);

        $id = request('id');
        $levels = request('levels');

        EventLevel::where('event_id', $id)
            ->delete();

        foreach($levels as $level){
            $eventLevel = new EventLevel();
            $eventLevel->event_id = $id;
            $eventLevel->level_id = $level;
            $eventLevel->save();
        }
    }
    
    public function updateSubjects(Request $request){

        $request->validate([
            'id' => 'required',
            'subjects' => 'required'
        ]);

        $id = request('id');
        $subjects = request('subjects');

        EventSubject::where('event_id', $id)
            ->delete();

        foreach($subjects as $subject){
            $eventSubject = new EventSubject();
            $eventSubject->event_id = $id;
            $eventSubject->subject_id = $subject;
            $eventSubject->save();
        }
    } 
    
    public function updateDescription(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'description' => 'required'
        ]);

        $event_id = request('id');
        $description = request('description');

        Event::where('events.id', $event_id)
                ->update([ 
                    'description' => $description, 
                ]);
    }

    public function updateImage(Request $request){

        $request->validate([
            'id' => 'required',
            'image' => 'required'
        ]);

        $image = $request->file('image');
        $disk = Storage::disk('local');
        // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる
        // $disk = Storage::disk('s3');

        $path = $disk->put('public', $image);
        $filename = ltrim($path, 'public/');

        $event_id = request('id');

        Event::where('events.id', $event_id)
                ->update([ 
                    'image' => $filename, 
                ]);
    }

    public function publishEvent(Request $request, $id)
    {
        $status_id = 1;

        Event::where('events.id', $id)
        ->update([ 
            'status_id' => $status_id
        ]);
    }

    public function unpublishEvent(Request $request, $id)
    {
        $status_id = 3;

        Event::where('events.id', $id)
        ->update([ 
            'status_id' => $status_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {

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

    public function fetchEditEvent(Request $request, $id)
    {
        $event = Event::where('events.id', $id)
                    ->first();

        return response()->json(['event' => $event],200);
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
