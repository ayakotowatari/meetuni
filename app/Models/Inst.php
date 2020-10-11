<?php

namespace App\Models;

use Auth;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Inst extends Model
{

    use Searchable;

    protected $appends = [
        'followed_by_user',
        'country_name',
        'country_icon'
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

    public function events()
    {
        return $this->hasMany('App\Models\Event');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function getCountryNameAttribute()
    {
        if(!$this->country_id){
            return null;
        }

        return $this->country->country;
    }

    public function getCountryIconAttribute()
    {
        if(!$this->country_id){
            return null;
        }

        return $this->country->icon;
    }
    
}
