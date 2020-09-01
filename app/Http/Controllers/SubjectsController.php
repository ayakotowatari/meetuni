<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectsController extends Controller
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

    public function fetchSubjects()
    {
        $subjects = Subject::all();

        return response()->json(['subjects'=>$subjects],200);
    }

    public function fetchEventSubjects(Request $request, $id)
    {
        $eventSubjects = Event::join('event_subjects', 'events.id', '=', 'event_subjects.event_id')
                    ->join('subjects', 'event_subjects.subject_id', '=', 'subjects.id')
                    ->where('events.id', $id)
                    ->select('subjects.subject')
                    ->get();

        // $regions = Event::with('regions', 'event_regions')
        //             ->where('events.id', $id)
        //             ->get();

        return response()->json(['eventSubjects'=>$eventSubjects],200);
    }

    public function fetchStudentSubjects(Request $request, $id)
    {
        $event_id = $id;

        $subjects = Subject::join('student_subjects', 'subjects.id', '=', 'student_subjects.subject_id')
                    ->join('students', 'student_subjects.student_id', '=', 'students.id')
                    ->join('bookings', 'students.id', '=', 'bookings.student_id')
                    ->where('bookings.event_id', '=', $event_id)
                    ->where('bookings.cancelled', '=', 0)
                    ->groupBy('subjects.subject')
                    ->select('subjects.subject', DB::raw('count(subject) as total'))
                    ->get();
    
            $json7 = [];
            $json8 = [];

            foreach($subjects as $subject){
                // jsonに変換
                // extract($sbjs);
                $json7[] = $subject->subject;
                $json8[] = $subject->total;
            }

            return response() -> json(['subject' => $json7, 'total' => $json8]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
