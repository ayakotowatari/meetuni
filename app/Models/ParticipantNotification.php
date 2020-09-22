<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ParticipantNotification extends Model
{
     // //開始時間のミューテータ
     public function setTimeUtcAttribute($value) {

        $user_id = Auth::user()->id;
        
        $timezone = $this->timezone;

        //DBに保存するtimezoneはUTC
        $datetime = new Carbon($value, $timezone);
        $datetime->setTimezone('UTC');
        $this->attributes['time_utc'] = $datetime;
    }

    // public function setTimeUtcAttribute($value) {

    //     $user_id = Auth::user()->id;

    //     //DBに保存するtimezoneはUTC
    //     $datetime = new Carbon($value, Auth::user()->timezone);
    //     $datetime->setTimezone('UTC');
    //     $this->attributes['time_utc'] = $datetime;
    // }

}
