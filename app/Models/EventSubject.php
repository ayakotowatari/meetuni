<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventSubject extends Model
{
    protected $fillable = [
        'event_id', 'subject_id'
    ];
}
