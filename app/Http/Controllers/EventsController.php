<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Models\Inst;
use App\Models\Like;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventRegion;
use App\Models\EventLevel;
use App\Models\EventSubject;
use Illuminate\Http\Request;
use App\Notifications\EventPublishedNotification;
use Notification;
use Illuminate\Support\Arr;
use Storage;
use Validator;

use Illuminate\Database\Eloquent\Builder;

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

    //学生ページ用
    public function fetchAllEvents(){

        // DD($id);

        $user = Auth::guard('student')->user();

        if($user){

            $events = Event::with('bookings')
                        ->join('insts', 'events.inst_id', '=', 'insts.id')
                        ->join('countries', 'insts.country_id', '=', 'countries.id')
                        ->where('events.status_id', 1)
                        ->whereDoesntHave('bookings', function(Builder $query){
                            $query->where('student_id','=', Auth::guard('student')->user()->id);
                        })
                        ->orderBy('events.date', 'desc')
                        ->select('events.id', 'events.title', 'insts.name', 'events.date', 'events.timezone', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image', 'countries.icon')
                        ->get();
            // return view ('student/test', ['events'=>$events]);
            return response()->json(['events'=>$events],200);

        }else{

            $events = Event::with('bookings')
                        ->join('insts', 'events.inst_id', '=', 'insts.id')
                        ->join('countries', 'insts.country_id', '=', 'countries.id')
                        ->where('events.status_id', 1)
                        ->orderBy('events.date', 'desc')
                        ->select('events.id', 'events.title', 'insts.name', 'events.date', 'events.timezone', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image', 'countries.icon')
                        ->get();
            // return view ('student/test', ['events'=>$events]);
            return response()->json(['events'=>$events],200);

        }
        
    }

    public function fetchEventOwner(Request $request, $id)
    {
        $event_id = $id;
        
        $owner = Event::where('id', $event_id)
                    ->select('user_id')
                    ->first();

        // $owner_id = $owner->user_id;

        // DD($owner_id);

        // DD($owner);

        return response()->json(['owner'=>$owner],200);
    }

    //学生ページ用
    public function fetchSingleEvent(Request $request, $id){

        $event = Event::join('insts', 'events.inst_id', '=', 'insts.id')
                    ->join('countries', 'insts.country_id', '=', 'countries.id')
                    ->where('events.id', $id)
                    ->where('events.status_id', 1)
                    ->select('events.id', 'events.title', 'insts.name', 'events.inst_id', 'events.date', 'events.start_utc', 'events.end_utc', 'events.timezone', 'events.description', 'events.image', 'countries.icon')
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

    public function fetchSingleBookedEvent(Request $request, $id)
    {
        $event_id = $id;
        
        $user_id = Auth::guard('student')->user()->id;

        $event = Event::join('insts', 'events.inst_id', '=', 'insts.id')
                    ->join('bookings', 'events.id', '=', 'bookings.event_id')
                    ->where('events.id', $event_id)
                    ->where('bookings.student_id', $user_id)
                    ->where('events.status_id', 1)
                    ->select('events.id', 'events.title', 'insts.name', 'events.inst_id', 'events.date', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image')
                    ->first();

        $regions = Event::join('event_regions', 'events.id', '=', 'event_regions.event_id')
                        ->join('regions', 'event_regions.region_id', '=', 'regions.id')
                        ->where('events.id', $event_id)
                        ->select('regions.region')
                        ->get();

        $levels = Event::join('event_levels', 'events.id', '=', 'event_levels.event_id')
                        ->join('levels', 'event_levels.level_id', '=', 'levels.id')
                        ->where('events.id', $event_id)
                        ->select('levels.level')
                        ->get();

        $subjects = Event::join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                        ->join('subjects', 'event_subjects.subject_id', '=', 'subjects.id')
                        ->where('events.id', $event_id)
                        ->select('subjects.subject')
                        ->get();

        return response()->json(['event'=>$event, 'regions'=>$regions, 'levels'=>$levels, 'subjects'=>$subjects],200);


    }

    public function fetchLikedEvents($id)
    {
        $user_id = $id;

        // DD($user_id);

        // $events = Event::with('bookings')
        //                 ->join('likes', 'events.id', '=', 'likes.event_id')
        //                 ->join('insts', 'events.inst_id', '=', 'insts.id')
        //                 ->where('likes.student_id', $user_id)
        //                 ->doesntHave('bookings')
        //                 ->select('events.id', 'events.image', 'insts.name', 'events.title', 'events.date', "events.start_utc", "events.end_utc")
        //                 ->get();

        $events = Event::with('bookings')
                        ->join('likes', 'events.id', '=', 'likes.event_id')
                        ->join('insts', 'events.inst_id', '=', 'insts.id')
                        ->where('events.status_id', 1)
                        ->where('likes.student_id', $user_id)
                        ->whereNull('likes.deleted_at')
                        ->whereDoesntHave('bookings', function(Builder $query){
                            $query->where('student_id', '=', Auth::guard('student')->user()->id);
                        })
                        ->select('events.id', 'events.image', 'insts.name', 'events.title', 'events.date', "events.start_utc", "events.end_utc")
                        ->get();

        // DD($events);

        // foreach($events as $event){
        //     $event->liked_by_user = true;
        // }

        // $events = Event::join('bookings', 'events.id', '=', 'bookings.event_id')
        //                 ->where('bookings.student_id', $id)
        //                 ->get();

        // DD($events);
        return response()->json(['events' => $events],200);

        // return view ('student.test', ['events'=>$events]);
    }

    public function recommendSubjectEvents(Request $request){

        // $levels = Student::join('level_students', 'students.id' ,'=', 'level_students.student_id')
        //                     ->join('levels', 'levels.id', '=', 'level_students.level_id')
        //                     ->where('students.id', $id)
        //                     ->select('levels.id')
        //                     ->get();

        // DD($levels);

        // $subjects = Student::join('student_subjects', 'students.id', '=', 'student_subjects.student_id')
        //                         ->join('subjects', 'subjects.id', '=', 'student_subjects.subject_id')
        //                         ->where('students.id', $id)
        //                         ->select('subjects.id')
        //                         ->get();

        $user = Auth::guard('student')->user();

        if($user){

            $user_id = $user->id;

            $subjects = Subject::join('student_subjects', 'subjects.id', '=', 'student_subjects.subject_id')
                        ->where('student_subjects.student_id', $user_id)
                        ->select('subjects.id')
                        ->get();
        
            // DD($subjects);

            // $events=[];

            foreach($subjects as $subject){
                $events[] = Event::with('bookings')
                        ->join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                        ->join('insts', 'events.inst_id', '=', 'insts.id')
                        ->join('countries', 'insts.country_id', '=', 'countries.id')
                        ->join('event_levels', 'events.id', '=', 'event_levels.event_id')
                        ->join('subjects', 'event_subjects.subject_id', '=', 'subjects.id')
                        ->where('events.status_id', 1)
                        ->where('event_subjects.subject_id', $subject->id)
                        ->where(function($query){
                            $query->where('event_levels.level_id', 5)
                                ->orWhere('event_levels.level_id', 1)
                                ->orWhere('event_levels.level_id', 9);
                        })
                        ->whereDoesntHave('bookings', function(Builder $query){
                            $query->where('student_id', '=', Auth::guard('student')->user()->id);
                        })
                        ->orderBy('events.date', 'desc')
                        ->select('subjects.subject', 'events.id', 'events.title', 'insts.name', 'events.date', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image', 'countries.icon')
                        ->get();
            };
            // DD($events);
            $array = $events;
            $flattened_events = Arr::flatten($array);
            // $unique = array_unique($flattened_events);
            $tmp = [];
            $uniqueEvents = [];
            foreach($flattened_events as $event){
                if(!in_array($event['id'], $tmp)){
                    $tmp[] = $event['id'];
                    $uniqueEvents[] = $event;
                }
            }
            // $renumbered = array_values($unique);

            // DD($uniqueEvents);

            // DD($events);
            // DD($renumbered);
            // DD($unique);

            // return view('student.test', ['events'=>$renumbered]);
            return response()->json(['events'=>$uniqueEvents],200);

        }

        
    }

    public function recommendDestinationEvents(Request $request)
    {
        // $destinations = Student::join('country_students', 'students.id' ,'=', 'country_students.student_id')
        //                     ->join('countries', 'countries.id', '=', 'country_students.country_id')
        //                     ->where('students.id', $id)
        //                     ->select('countries.id')
        //                     ->get();

        $user = Auth::guard('student')->user();

        if($user){

            $user_id = $user->id;

            $destinations = Country::join('country_students', 'countries.id', '=', 'country_students.country_id')
                                    ->where('country_students.student_id', $user_id)
                                    ->select('countries.id')
                                    ->get();
    
            // DD($destinations);
    
            foreach($destinations as $destination){
    
                $events[] = Event::with('bookings')
                                ->join('insts', 'events.inst_id', '=', 'insts.id')
                                ->join('countries', 'insts.country_id', '=', 'countries.id')
                                ->join('event_levels', 'events.id', '=', 'event_levels.event_id')
                                ->join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                                ->where('countries.id', $destination->id)
                                ->where('event_subjects.subject_id', 1)
                                ->where('events.status_id', 1)
                                ->where(function($query){
                                    $query->where('event_levels.level_id', 1)
                                          ->orWhere('event_levels.level_id', 5)
                                          ->orWhere('event_levels.level_id', 9);
                                })
                                ->whereDoesntHave('bookings', function(Builder $query){
                                    $query->where('student_id', '=', Auth::guard('student')->user()->id);
                                })
                                ->orderBy('events.date', 'desc')
                                ->select('events.id', 'events.title', 'insts.name', 'events.date', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image', 'countries.icon')
                                ->get();
            }
    
            // DD($events);
    
            $array = $events;
            $flattened_events = Arr::flatten($array);
            // $unique = array_unique($flattened_events);
            // $renumbered = array_values($unique);
    
            $tmp = [];
            $uniqueEvents = [];
            foreach($flattened_events as $event){
                if(!in_array($event['id'], $tmp)){
                    $tmp[] = $event['id'];
                    $uniqueEvents[] = $event;
                }
            }
    
            // DD($unique);
    
            // DD($unique);
    
            return response()->json(['events'=>$uniqueEvents],200);
    


        }
        
        // return view('student.test',['events'=>$unique]);

    }

    public function recommendRegionEvents(Request $request)
    {
        $user = Auth::guard('student')->user();

        if($user){
            
            $user_id = $user->id;

            $region = Student::join('countries', 'students.country_id', '=', 'countries.id')
                            ->join('regions', 'countries.region_id', '=', 'regions.id')
                            ->where('students.id', $user_id)
                            ->select('regions.id')
                            ->first();
    
            // DD($region);
    
            $events = Event::with('bookings')
                        ->join('event_regions', 'events.id', '=', 'event_regions.event_id')
                        ->join('insts', 'events.inst_id', '=', 'insts.id')
                        ->join('countries', 'insts.country_id', '=', 'countries.id')
                        ->join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                        ->join('event_levels', 'events.id', '=', 'event_levels.event_id')
                        ->where('event_regions.region_id', $region->id)
                        ->where('event_subjects.subject_id', 1)
                        ->where('events.status_id', 1)
                        ->where(function($query){
                            $query->where('event_levels.level_id', 1)
                                  ->orWhere('event_levels.level_id', 5)
                                  ->orWhere('event_levels.level_id', 9);
                        })
                        ->whereDoesntHave('bookings', function(Builder $query){
                            $query->where('student_id', '=', Auth::guard('student')->user()->id);
                        })
                        ->orderBy('events.date', 'desc')
                        ->select('events.id', 'insts.name', 'events.title','events.date', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image', 'countries.icon')
                        ->get();
    
            // DD($events);
    
            // $array = $events;
            // $flattened_events = Arr::flatten($array);
    
            $array = $events;
            $flattened_events = Arr::flatten($array);
    
            $tmp = [];
            $uniqueEvents = [];
            foreach($flattened_events as $event){
                if(!in_array($event['id'], $tmp)){
                    $tmp[] = $event['id'];
                    $uniqueEvents[] = $event;
                }
            }
    
            // DD($uniqueEvents);
    
            //  return view('student.test',['events'=>$unique]);
    
            return response()->json(['events'=>$uniqueEvents],200);
    
        }
       
        // if($events->isEmpty()){
        //     return 'There was no record';
        // }else{
        //     $unique = array_unique($events);
        //     $renumbered = array_vaues($unique);
        //     return response()->json(['events'=>$renumbered],200);
        // }
    }

    public function fetchEventsList(Request $request, $id)
    {
        $events = Event::with('bookings')
                        ->join('insts', 'events.inst_id', '=', 'insts.id')
                        ->where('insts.id', $id)
                        ->where('events.status_id', 1)
                        // ->whereDoesntHave('bookings', function(Builder $query){
                        //     $query->where('student_id', '=', Auth::guard('student')->user()->id);
                        // })
                        ->select('events.id', 'events.title', 'events.date', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image')
                        ->get();

        $inst = Inst::find($id);

        return response()->json(['events'=>$events, 'inst'=>$inst],200);
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
        $inst = User::join('insts', 'users.inst_id', '=', 'insts.id')
                ->where('users.id', $user_id)
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
        $event->status_id = 5;
        $event->user_id = $user_id;

        $event->save();
    }

    public function storeSelects(Request $request)
    {
        $user_id = Auth::user()->id;
        $event = Event::latest('created_at')
                ->where('events.user_id', $user_id)
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
                ->where('events.user_id', $user_id)
                ->first();
        $event_id = $event->id;

        $request->validate([
                'description' => 'required | max:600',
                'image' => 'required | image | max:5000'
        ]);

        $description = request('description');

        $image = $request->file('image');
        // $disk = Storage::disk('local');
        // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる
        $disk = Storage::disk('s3');

        $path = $disk->putFile('event', $image, 'public');
        // $filename = ltrim($path, 'public/');

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
                    // 'image' => $filename 
                    'image' => $path
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
        // $disk = Storage::disk('local');
        // [Tips]設定をすれば下記に書き換えるだけでS3に保存できる
        $disk = Storage::disk('s3');

        $path = $disk->putFile('event', $image, 'public');
        // $filename = ltrim($path, 'public/');

        $event_id = request('id');

        Event::where('events.id', $event_id)
                ->update([ 
                    // 'image' => $filename, 
                    'image' => $path
                ]);
    }

    public function publishEvent(Request $request, $id)
    {
        $status_id = 1;

        Event::where('events.id', $id)
        ->update([ 
            'status_id' => $status_id
        ]);

        $event = Event::find($id);

        $inst = Inst::join('events', 'events.inst_id', '=', 'insts.id')
                    ->where('events.id', $id)
                    ->first();

        $inst_name = $inst->name;
        $inst_id = $inst->inst_id;

        $students = Student::join('follows', 'students.id', '=', 'follows.student_id')
                            ->where('follows.inst_id', $inst_id)
                            ->get();

        foreach($students as $student){

            Notification::send($student, new EventPublishedNotification($student, $event, $inst_name));

        }

    }

    public function test ()
    {
        $inst = Inst::join('events', 'events.inst_id', '=', 'insts.id')
                    ->where('events.id', 2)
                    ->first();

        // DD($inst);

        $inst_id = $inst->inst_id;

        // DD($inst_id);

        $students = Student::join('follows', 'students.id', '=', 'follows.student_id')
                            ->where('follows.inst_id', $inst_id)
                            ->get();

        DD($students);
    }



    public function unpublishEvent(Request $request, $id)
    {
        $status_id = 5;

        Event::where('events.id', $id)
        ->update([ 
            'status_id' => $status_id
        ]);
    }

    public function fetchEventsForEmails()
    {
        $user_id = Auth::user()->id;

        $events = Event::where('user_id', $user_id)
                    ->where('status_id', 1)
                    ->get();

        // foreach($events as $event){
        //     $title_date[] = $event->title.', '.$event->date;
        // }

        // DD($events);

        return response()->json(['events' => $events],200);
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
