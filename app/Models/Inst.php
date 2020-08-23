<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inst extends Model
{
    //InstUserモデルのデータを引っ張ってくる。
    public function instUsers(){
        return $this->hasMany('App\Models\InstUser');
    }
    
}
