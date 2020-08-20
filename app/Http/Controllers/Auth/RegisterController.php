<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\InstUser;
use App\Models\Student;
use App\Traits\OtherRegistersUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use OtherRegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'timezone' => ['required']
        ]);
    }

    protected function instUserValidator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'timezone' => ['required']
        ]);
    }

    protected function studentValidator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'timezone' => ['required']
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_type_id' => 1,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'timezone' => $data['timezone'],
            'life' => 1,
            'remember_token' => '1234567890abcdefg',
        ]);
    }

    protected function instUserCreate(array $data)
    {
        return User::create([
            'user_type_id' => 5,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'timezone' => $data['timezone'],
            'life' => 1,
            'remember_token' => '1234567890abcdefg',
        ]);
    }

    protected function studentCreate(array $data)
    {
        return User::create([
            'user_type_id' => 9,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'timezone' => $data['timezone'],
            'life' => 1,
            'remember_token' => '1234567890abcdefg',
        ]);
    }
    protected function instUserTableValidator(array $data)
    {
        return Validator::make($data, [
            'inst_id' => ['required', 'integer'],
            'job_title' => ['required', 'string'],
            'department' => ['required', 'string'],
        ]);
    }

    protected function studentTableValidator(array $data)
    {
        return Validator::make($data, [
            'country_id' => ['required', 'integer'],
            'year_id' => ['required', 'string'],
        ]);
    }

    protected function instUserTableCreate(Int $id, array $data, InstUser $inst_user)
    {
        $inst_user = new InstUser();
        $inst_user->fill(['id'=>$id,'inst_id'=>$data['inst_id'],'job_title'=>$data['job_title'],'department'=>$data['department']]);
        $inst_user->save();
        return;
    }

    protected function studentTableCreate(Int $id, array $data, Student $student)
    {
        $student = new Student();
        $student->fill(['id'=>$id,'country_id'=>$data['country_id'],'year_id'=>$data['year_id']]);
        $student->save();
        return;
    }

}
