<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function events(){
        return $this->hasMany('App\Models\Event', 'event_levels');
    }
}
