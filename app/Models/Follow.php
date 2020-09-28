<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Follow extends Model
{
    public function setFormattedCreatedAttribute($date) {
        $this->attributes['formatted_created'] = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function setFormattedUpdatedAttribute($date) {
        $this->attributes['formatted_updated'] = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
}
