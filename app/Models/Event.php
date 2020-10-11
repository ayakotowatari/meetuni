<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Searchable;

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
        'booked_by_user',
        'title_date',
        'absolute_path',
    ];

    protected $touches = ['inst'];

    public function likes(){
        return $this->belongsToMany('App\Models\Student', 'likes', 'event_id', 'student_id');
    }

    public function getLikedByUserAttribute()
    {
        if (Auth::guard('student')->guest()){
            return false;
        }

        return $this->likes->contains(Auth::guard('student')->user()->id);
    }

    public function getAbsolutePathAttribute()
    {
        if(!$this->image) {
            return null;
        }

        // return env('AWS_URL').'/'.$this->image;
        return config('s3.aws_url').'/'.$this->image;
    }

    public function bookings(){
        return $this->hasMany('App\Models\Booking');
    }

    public function getBookedByUserAttribute()
    {
        if (Auth::guard('student')->guest()){
            return false;
        }

        return $this->bookings->contains('student_id', Auth::guard('student')->user()->id);
    }

    public function getTitleDateAttribute()
    {
        return $this->title.', '.$this->date;
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

    //Algoriaのサーチ
    public function inst()
    {
        return $this->belongsTo('App\Models\Inst');
    }

    public function searchableAs()
    {
        return 'event_index';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array = $this->transform($array);

        $array['inst_name'] =$this->inst->name;
        $array['country_name'] =$this->inst->country_name;
        $array['country_icon'] =$this->inst->country_icon;

        return $array;
    }

 


    // public function shouldBeSearchable()
    // {
        
    //     if($this->status_id == 1) return true;
    //     return false;

    // }   

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
