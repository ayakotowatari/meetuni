<?php

namespace App\Http\Controllers;

use Auth;

use App\User;
use App\Models\Student;
use App\Models\Country;
use App\Models\Level;
use App\Models\Year;
use App\Models\Subject;
use App\Models\CountryStudent;
use App\Models\LevelStudent;
use App\Models\StudentSubject;
use App\Models\ParticipantNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateStudentPasswordRequest;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fetchStudentUser()
    {
        $user = Auth::guard('student')->user();
    
        return response()->json(['user'=>$user],200);
        // DD($user);
        // return view ('student.test');
    }

    public function fetchInitials()
    {
        $user = Auth::guard('student')->user();

        if($user){
            $first_name = $user->first_name;
            $last_name = $user->last_name;
    
            $initial_first = substr($first_name, 0, 1);
            $initial_last = substr($last_name, 0, 1);
            $initials = $initial_first.$initial_last;

            return response()->json(['initials'=>$initials],200);
        }

    }

    public function addStudentDetails(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'country' => 'required',
            'year' => 'required',
            "destinations" => 'required',
            "levels" => 'required',
            'subjects' => 'required',
        ]);

        $user_id = request('id');
        $country = request('country');
        $year = request('year');

        Student::where('id', $user_id)
        ->update([ 
            'country_id' => $country, 
            'year_id' => $year 
        ]);

        $destinations = request("destinations");

        //country_studentsテーブルへの挿入
        foreach($destinations as $destination){

            $country_student = new CountryStudent();
            $country_student->student_id = $user_id;
            $country_student->country_id = $destination;
            $country_student->save();
        }

        $levels = request('levels');

        //level_studentsテーブルへの挿入
        foreach($levels as $level){
          
            $level_students = new LevelStudent();
            $level_students->student_id = $user_id;
            $level_students->level_id = $level;
            $level_students->save();
        }

        $subjects = request('subjects');

        //stuent_subjectsテーブルへの挿入
        foreach($subjects as $subject){
           
            $student_subjects = new StudentSubject();
            $student_subjects->student_id = $user_id;
            $student_subjects->subject_id = $subject;
            $student_subjects->save();
        }
    }

    public function updateBasics(Request $request)
    {
        $request->validate([
            "first_name" => 'required',
            'last_name' => 'required',
        ]);

        $user_id = Auth::guard('student')->user()->id;

        $user = Student::find($user_id);
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->save();
        
    }

    public function updateEmail(Request $request)
    {
        $user_id = Auth::guard('student')->user()->id;
        
        $request->validate([
            'email' => 'required|unique:users|unique:students',
        ]);

        $user = Student::find($user_id);
        $user->email = request('email');
        $user->save();

        return response()->json(['user'=>$user],200);

    }

    public function updatePassword(UpdateStudentPasswordRequest $request)
    {   
        $user = Auth::guard('student')->user();
        $user->password = Hash::make($request->get('newPassword'));
        $user->save();

    }

    public function getTimezoneList()
    {
        $timezone = array();
        $timestamp = time();
        
        $timezoneList = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        // DD($timezoneList);

        foreach($timezoneList as $key => $value){
            date_default_timezone_set($value);
            $timezone[$key]['zone'] = $value;
            $timezone[$key]['GMT_difference'] = 'GMT'.date('P', $timestamp);
            // $value['offset'] = date('P', $timestamp);
            // $value['diff_from_gtm'] = 'UTC/GMT'.date('P', $timestamp);
        }
        $timezones = collect($timezone)->sortBy('GMT_difference');

        $tmp = [];
        $uniqueTimezone = [];
        foreach($timezones as $timezone){
            if(!in_array($timezone['zone'], $tmp)){
                $tmp[] = $timezone['zone'];
                $uniqueTimezone[] = $timezone;
            }
        }

        // DD($uniqueTimezone);

        return response()->json(['timezone'=>$uniqueTimezone],200);

    }

    public function updateTimezone(Request $request)
    {
        $request->validate([
            'timezone' => 'required',
        ]);
        
        $user_id = Auth::guard('student')->user()->id;

        $user = Student::find($user_id);
        $user->timezone = request('timezone');
        $user->save();

        return response()->json(['user'=>$user],200);

    }

    public function fetchStudentYear()
    {
        $user_id = Auth::guard('student')->user()->id;

        $year = Student::join('years', 'students.year_id', '=', 'years.id')
                    ->select('years.id', 'years.year')
                    ->first();

        return response()->json(['year'=>$year],200);
    }

    public function updateYear(Request $request)
    {
        $request->validate([
            'year_id' => 'required',
        ]);

        $year_id = request('year_id');
        
        $user_id = Auth::guard('student')->user()->id;
        $student = Student::find($user_id);
        $student->year_id = $year_id;
        $student->save();

        $year = Student::join('years', 'students.year_id', '=', 'years.id')
                        ->where('students.id', $user_id)
                        ->select('years.id', 'years.year')
                        ->first();

        return response()->json(['year'=>$year],200);
    }

    public function fetchPreference()
    {
        $user_id = Auth::guard('student')->user()->id;

        $destinations = Country::join('country_students', 'countries.id', '=', 'country_students.country_id')
                            ->join('students', 'country_students.student_id', '=', 'students.id')
                            ->where('students.id', $user_id)
                            ->select('countries.country')
                            ->get();

        // DD($destinations);

        $levels = Level::join('level_students', 'levels.id', '=', 'level_students.level_id')
                            ->join('students', 'level_students.student_id', '=', 'students.id')
                            ->where('students.id', $user_id)
                            ->select('levels.level')
                            ->get();

        // DD($levels);

        $subjects = Subject::join('student_subjects', 'subjects.id', '=', 'student_subjects.subject_id')
                            ->join('students', 'student_subjects.student_id', '=', 'students.id')
                            ->where('students.id', $user_id)
                            ->select('subjects.subject')
                            ->get();

        // DD($levels);

        return response()->json(['destinations'=>$destinations, 'levels'=>$levels, 'subjects'=>$subjects],200);
        
    }

    public function updateDestinations (Request $request)
    {
        $request->validate([
            'destinations' => 'required',
        ]);

        $destinations = request("destinations");

        $user_id = Auth::guard('student')->user()->id;

        CountryStudent::where('student_id', $user_id)
                        ->delete();

        //country_studentsテーブルへの挿入
        foreach($destinations as $destination){

            $country_student = new CountryStudent();
            $country_student->student_id = $user_id;
            $country_student->country_id = $destination;
            $country_student->save();
        }

        $updatedDestinations = Country::join('country_students', 'countries.id', '=', 'country_students.country_id')
                                    ->join('students', 'country_students.student_id', '=', 'students.id')
                                    ->where('students.id', $user_id)
                                    ->select('countries.country')
                                    ->get();

        return response()->json(['destinations'=>$updatedDestinations],200);

    }

    public function updateLevels (Request $request)
    {
        $request->validate([
            'levels' => 'required',
        ]);

        $levels = request("levels");

        $user_id = Auth::guard('student')->user()->id;

        LevelStudent::where('student_id', $user_id)
                        ->delete();

        //country_studentsテーブルへの挿入
        foreach($levels as $level){

            $level_student = new LevelStudent();
            $level_student->student_id = $user_id;
            $level_student->level_id = $level;
            $level_student->save();
        }

        $updatedLevels = Level::join('level_students', 'levels.id', '=', 'level_students.level_id')
                                    ->join('students', 'level_students.student_id', '=', 'students.id')
                                    ->where('students.id', $user_id)
                                    ->select('levels.level')
                                    ->get();

        return response()->json(['levels'=>$updatedLevels],200);

    }


    public function updateSubjects (Request $request)
    {
        $request->validate([
            'subjects' => 'required',
        ]);

        $subjects= request("subjects");

        $user_id = Auth::guard('student')->user()->id;

        StudentSubject::where('student_id', $user_id)
                        ->delete();

        //country_studentsテーブルへの挿入
        foreach($subjects as $subject){

            $student_subject = new StudentSubject();
            $student_subject->student_id = $user_id;
            $student_subject->subject_id = $subject;
            $student_subject->save();
        }

        $updatedSubjects = Subject::join('student_subjects', 'subjects.id', '=', 'student_subjects.subject_id')
                                    ->join('students', 'student_subjects.student_id', '=', 'students.id')
                                    ->where('students.id', $user_id)
                                    ->select('subjects.subject')
                                    ->get();

        return response()->json(['subjects'=>$updatedSubjects],200);

    }
    
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
