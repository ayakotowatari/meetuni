<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        'title', 
        'inst_id', 
        'date', 
        'timezone', 
        'start_time', 
        'end_time',
        'start_utc', 
        'end_utc', 
        'description', 
        'image', 
        'status_id', 
        'inst_user_id'
    ];

    protected $appends = [
        'liked_by_user',
        'booked_by_user'
    ];

    public function likes(){
        return $this->belongsToMany('App\Models\Student', 'likes', 'event_id', 'student_id');
    }

    public function getLikedByUserAttribute()
    {
        if (Auth::guest()){
            return false;
        }

        return $this->likes->contains(Auth::user()->id);
    }

    public function bookings(){
        return $this->hasMany('App\Models\Booking');
    }

    public function getBookedByUserAttribute()
    {
        if (Auth::guest()){
            return false;
        }

        return $this->bookings->contains(Auth::user()->id);
    }


    // //開始時間のミューテータ
    public function setStartUtcAttribute($value) {

        //DBに保存するtimezoneはUTC
        $datetime = new Carbon($value, Auth::user()->timezone);
        $datetime->setTimezone('UTC');
        $this->attributes['start_utc'] = $datetime;
    }

    //  //終了時間のミューテータ
    public function setEndUtcAttribute($value) {

        //DBに保存するtimezoneはUTC
        $datetime = new Carbon($value, Auth::user()->timezone);
        $datetime->setTimezone('UTC');
        $this->attributes['end_utc'] = $datetime;
    }

    public function status(){
        return $this->belongsTo('App\Models\Status');
    }

    // public function levels(){
    //     return $this->hasMany('App\Models\Level', 'event_levels');
    // }

    // public function regions(){
    //     return $this->hasMany('App\Models\Region', 'event_regions', 'event_id');
    // }


    // public function subjects(){
    //     return $this->hasMany('App\Models\Subject', 'event_subjects');
    // }
}
