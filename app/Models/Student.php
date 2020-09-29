<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\EventBookingConfirmation;
use App\Notifications\EventCancellationConfirmation;
use App\Notifications\StudentResetPassword;

// テスト
use App\Notifications\TestMail;
// use App\Notifications\EventPublishedNotification;


//ここ書き換えた。

class Student extends Authenticatable
{
    use Notifiable;
   
    protected $fillable = [
        'first_name',
        'last_name',
        'user_type_id',
        'email',
        'password',
        'timezone',
        'country_id',
        'year_id',
        'life',
        'remember_token'
    ];

    public function likes(){
        return $this->belongsToMany('App\Models\Event', 'likes', 'student_id', 'event_id');
    }

    public function follows(){
        return $this->belongsToMany('App\Models\Inst', 'follows', 'student_id', 'inst_id');
    }

    public function student_subjects(){
        return $this->belongsToMany('App\Models\Subject', 'student_subjects', 'student_id', 'subject_id');
    }

    public function bookings(){
        return $this->hasMany('App\Models\Booking');
    }

    public function sendEventBookingConfirmation($student, $event)
    {
        $this->notify(new EventBookingConfirmation($student, $event));
    }

    public function sendEventCancellationConfirmation($student, $event)
    {
        $this->notify(new EventCancellationConfirmation($student, $event));
    }

    public function sendTestMail($student)
    {
        $this->notify(new TestMail($student));
    }

    // public function sendEventPublishedNotification($student, $event, $inst)
    // {
    //     $this->notify(new EventPublishedNotification($student, $event, $inst));
    // }

    // Override default reset password
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new StudentResetPassword($token));
    }

}
