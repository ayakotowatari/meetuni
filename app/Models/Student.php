<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function likes(){
        return $this->belongsToMany('App\Models\Event', 'likes', 'student_id', 'event_id');
    }

}
