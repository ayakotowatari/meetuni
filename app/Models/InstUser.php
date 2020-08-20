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
}
