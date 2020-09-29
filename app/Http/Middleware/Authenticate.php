<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $user_route = 'user.login.form';
    protected $student_route = 'student.login.form';
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::is('user.*')){
                return route($this->user_route);
            }elseif(Route::is('student.*')){
                return route($this->student_route);
            }
            // return route('login');
        }
    }
}
