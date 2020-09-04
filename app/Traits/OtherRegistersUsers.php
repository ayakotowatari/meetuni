<?php

namespace App\Traits;

use App\Models\Event;
use App\Models\Inst;
use App\Models\InstUser;
use App\Models\Student;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RedirectsUsers;

trait OtherRegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    // public function showInstUserRegistrationForm($inst)
    // {
    //     dd($inst);
    //     $inst_details = Inst::select('id', 'name')
    //                     ->where('id', $inst)
    //                     ->first();
        

    //     return view('inst.auth.register', ['inst' => $inst_detail]);
    // }
    public function showInstUserRegistrationForm(Request $request, Inst $inst)
    {
        $value = $request->inst;

        $inst_detail = Inst::where('id', $value)
                        ->select('id', 'name')
                        ->first();

        return view('inst.auth.register', ['inst' => $inst_detail]);
    }

    public function showStudentRegistrationForm()
    {
        return view('student.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function instUserRegister(Request $request, InstUser $inst_user)
    {
        $this->instUserValidator($request->all())->validate();

        event(new Registered($user = $this->instUserCreate($request->all())));

        $id = $user->id;
        $this->instUserTableValidator($request->all())->validate();
        $this->instUserTableCreate($id, $request->all(), $inst_user);

        $this->guard()->login($user);

        return $this->instUserRegistered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function studentUserRegister(Request $request, Student $student)
    {
        $this->studentValidator($request->all())->validate();

        event(new Registered($user = $this->studentCreate($request->all())));

        $id = $user->id;
        // $this->studentTableValidator($request->all())->validate();
        // $this->studentTableCreate($id, $request->all(), $student);

        $this->guard()->login($user);

        return $this->studentRegistered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function otherGuard()
    {
        return Auth::otherGuard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function instUserRegistered(Request $request, $user)
    {
         // set timezone
        //  $timezone = $this->getTimezone($request);
        //  $user->timezone = $timezone;
        //  $user->save(); 

        // if($timezone = $request->get('timezone')){
        //     $user->timezone = $request->get('timezone');
        //     $user->save();
        // }
        

        //
        $user = auth()->user();
        $id = $user->id;
        // $id = Auth::user()->id->get();
        // $inst_user = User::find($id)->get();

        //instテーブルのidと大学ユーザーテーブルの大学idと合致するレコードを探して、$instに代入する。
        $inst = Inst::join('inst_users', 'insts.id', '=', 'inst_users.inst_id')
            ->where('inst_users.id', $id)
            ->select('insts.id', 'insts.name')
            ->first();

        // view'dashboard'で、{{ $user->first_name }}で大学ユーザーの名前を,{{ $inst->inst_name }}で大学名を呼び出し
        // return redirect('inst/projects', ['user'=>$user, 'inst'=>$inst]);
        return redirect('inst/events');
    }

    protected function studentRegistered(Request $request, $user)
    {
        //
        // $user = auth()->user();
        //     $id = $user->id;
        //     $nations     =   Nation::all();
        //     $levels     =    Level::all();

        //     $events      =   Event::join('insts','events.inst_id','=','insts.id')
        //                     ->join('event_region','events.id','=','event_region.event_id')
        //                     ->join('countries','event_region.region_id', '=', 'countries.region_id')
        //                     ->join('regions','countries.region_id', '=', 'regions.id')
        //                     ->join('event_level','event.id','=','event_level.event_id')
        //                     ->join('levels','event_level.level_id','=','levels.id')
        //                     ->select('insts.name', 'regions.region', 'events.title', 'events.date', 'events.id', 'events.img', 'levels.level' )
        //                     ->get();

        //     return view('student.main',[
        //                 'user'      =>$user,
        //                 'events'     =>$events,
        //                 'nations'    =>$nations,
        //                 'levels'    =>$levels
        //                 ]);
        return redirect('student/main');
    }
}
