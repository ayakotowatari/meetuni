<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable= [
        'user_id',
        'inst_id',
        'first_name',
        'last_name',
        'email',
        'job_title',
        'department',
        'token'
    ];
}
