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

        $notification = ParticipantNotification::where('user_id', $user_id)
                                        ->where('scheduled_time', $value)
                                        ->first();

        $timezone = $notification->timezone;

        //DBに保存するtimezoneはUTC
        $datetime = new Carbon($value, $timezone);
        $datetime->setTimezone('UTC');
        $this->attributes['time_utc'] = $datetime;
    }
}
