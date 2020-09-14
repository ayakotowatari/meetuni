<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Inst extends Model
{

    protected $appends = [
        'followed_by_user'
    ];

    public function follows(){
        return $this->belongsToMany('App\Models\Student', 'follows', 'inst_id', 'student_id');
    }

    public function getFollowedByUserAttribute()
    {
        if (Auth::guard('student')->guest()){
            return false;
        }

        return $this->follows->contains(Auth::guard('student')->user()->id);
    }

    //InstUserモデルのデータを引っ張ってくる。
    public function instUsers(){
        return $this->hasMany('App\Models\InstUser');
    }
    
}
