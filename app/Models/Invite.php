<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    //ココ↓
    use SoftDeletes;

    protected $table = 'invites';
    protected $dates = ['deleted_at'];
    
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
