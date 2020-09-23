<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

//ここ書き換えた。

class Student extends Authenticatable
{
   
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

    
    

}
