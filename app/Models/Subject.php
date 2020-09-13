<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // public function events(){
    //     return $this->hasMany('App\Models\Event', 'event_subjects');
    // }

    public function student_subjects(){
        return $this->belongsToMany('App\Models\Student', 'student_subjects', 'subject_id', 'student_id');
    }
}
