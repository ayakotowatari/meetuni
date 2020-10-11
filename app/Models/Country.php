<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;

class Country extends Model
{
    // use Searchable;

    public function insts()
    {
        return $this->hasMany('App\Models\Inst');
    }

    // public function events()
    // {
    //     return $this->hasManyThrough(
    //         'App\Models\Event',
    //         'App\Models\Inst',
    //         'country_id',
    //         'inst_id',
    //         'id',
    //         'id'
    //     );
    // }
    // public function searchableAs()
    // {
    //     return 'country_index';
    // }

    // public function toSearchableArray()
    // {
    //     $array = $this->toArray();

    //     $array = $this->transform($array);

    //     $array['events'] = $this->events->map(function ($data) {
    //         return $data;
    //     });
        
    //     return $array;
    // }


}


