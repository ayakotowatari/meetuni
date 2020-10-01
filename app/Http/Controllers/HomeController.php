<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // テスト用にコメントアウト。あとで復帰。
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect('/student/main');
    }

    public function test()
    {
        return view('auth.passwords.confirm');

    }

    public function institution()
    {
        return view('inst.home');

    }
}
