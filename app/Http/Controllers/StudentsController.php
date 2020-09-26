<?php

namespace App\Http\Controllers;

use Auth;

use App\User;
use App\Models\Student;
use App\Models\Country;
use App\Models\Level;
use App\Models\Year;
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
        // $user = Auth::user();
        return response()->json(['user'=>$user],200);
        // DD($user);
        // return view ('student.test');
    }

    public function fetchInitials()
    {
        $user = Auth::guard('student')->user();
        $first_name = $user->first_name;
        $last_name = $user->last_name;

        $initial_first = substr($first_name, 0, 1);
        $initial_last = substr($last_name, 0, 1);
        $initials = $initial_first.$initial_last;

        return response()->json(['initials'=>$initials],200);
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
