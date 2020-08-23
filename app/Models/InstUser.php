<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstUser extends Model
{
    protected $fillable = [
        'id',
        'inst_id',
        'job_title',
        'department'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function inst(){
        return $this->belongsTo('App\Models\Inst');
    }
}
