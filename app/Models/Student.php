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
        'email',
        'password',
        'country_id',
        'year_id'
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

}
