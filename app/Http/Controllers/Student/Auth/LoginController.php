<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/student/main';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function authenticated(Request $request, $user)
    // {
    //     return view('student.main', ['user'->$user]);
    //     // return response()->json(['user'=>$user]);
    // }

    //ログインフォームのviews
    public function showLoginForm()
    {
        return view ('student/auth/login_vue');
    }

    //持たせるガードの名前
    protected function guard()
    {
        return Auth::guard ('student');
    }

    protected function loggedOut(Request $reuqest)
    {
        return redirect ('/student/main');
    }

}
