<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     // //時間のフォーマット
     public function getCreatedAtAttribute($date) {

        // return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

}
