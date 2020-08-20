<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
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
}
