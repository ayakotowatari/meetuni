<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Like extends Model
{
    // use SoftDeletes;
    
    public function setFormattedCreatedAttribute($date) {
        $this->attributes['formatted_created'] = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function setFormattedUpdatedAttribute($date) {
        $this->attributes['formatted_updated'] = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
    
    // //時間のフォーマット
    public function getCreatedAtAttribute($date) {

        // return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUpdatedAtAttribute($date) {

        // return Carbon::parse($this->attributes['created_at'])->format('Y-m-d');
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
