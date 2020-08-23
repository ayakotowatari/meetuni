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

    public function levels(){
        return $this->hasMany('App\Models\Level', 'event_levels');
    }

    public function regions(){
        return $this->hasMany('App\Models\Region', 'event_regions', 'event_id');
    }


    public function subjects(){
        return $this->hasMany('App\Models\Subject', 'event_subjects');
    }
}
