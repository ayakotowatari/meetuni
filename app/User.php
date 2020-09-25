<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// use App\Traits\HasLocalDates;

class User extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'users';
    protected $dates = ['deleted_at'];

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_type_id', 
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'timezone',
        'inst_id',
        'job_title',
        'department',
        'life', 
        'remember_token'
    ];

    protected $appends = [
        'full_name',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
        // return "{$this->first_name} {$this->last_name}";
    }


    // public function instUser(){
    //     return $this->hasOne('App\Models\InstUser');
    // }
    
}
