<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegion extends Model
{
    protected $fillable = [
        'event_id', 'region_id'
    ];
}
