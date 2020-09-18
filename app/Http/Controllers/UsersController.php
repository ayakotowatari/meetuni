<?php

namespace App\Http\Controllers;

use Auth;
use Notification;
use App\Models\Inst;
use App\Models\Event;
use App\Models\Status;
use App\Models\Invite;
use App\Notifications\UserInviteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('registration_view');
    }

    public function fetchUser()
    {
        $user = Auth::user();
        return response()->json(['user'=>$user],200);
    }

    public function fetchInst()
    {
        $user = Auth::user();
        $id = $user->id;

        $inst = Inst::join('users', 'insts.id', '=', 'users.inst_id')
                    ->join('countries', 'insts.country_id', '=', 'countries.id')
                    ->where('users.id', $id)
                    ->select('insts.id', 'insts.name', 'countries.country')
                    ->first();

        return response()->json(['inst'=>$inst],200);
    }

    public function fetchInitials()
    {
        $user = Auth::user();
        $first_name = $user->first_name;
        $last_name = $user->last_name;

        $initial_first = substr($first_name, 0, 1);
        $initial_last = substr($last_name, 0, 1);
        $initials = $initial_first.$initial_last;

        return response()->json(['initials'=>$initials],200);
    }

    public function fetchEvents()
    {
        $user_id = Auth::user()->id;

        $events = Event::join('statuses', 'events.status_id', '=', 'statuses.id')
                    ->where('events.user_id', $user_id)
                    ->select('events.id', 'events.title', 'events.date', 'statuses.status')
                    ->get();

        return response()->json(['events' => $events],200);
    }

    public function fetchSingleEvent(Request $request, $id)
    {   
        $user_id = Auth::user()->id;

        $event_id = $id;
        $event = Event::join('event_regions', 'events.id', '=', 'event_regions.event_id')
                    ->join('regions', 'regions.id', '=', 'event_regions.region_id')
                    ->join('statuses', 'events.status_id', '=', 'statuses.id')
                    ->where([['events.id', $event_id], ['events.user_id', $user_id]])
                    ->select('events.id', 'events.title', 'events.timezone', 'events.date', 'events.start_time', 'events.end_time', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image', 'statuses.status', 'regions.region')
                    ->first();

        return response()->json(['event' => $event],200);
    }

    public function process_invites(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'inst_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'job_title' => 'required',
            'department' => 'required',
        ]);

        $email = request('email');
        $inst_id = request('inst_id');

        do {
            $token = Str::random(20);
        } while (Invite::where('token', $token)->first());

        Invite::create([
            'user_id' => request('user_id'),
            'inst_id' => request('inst_id'),
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'email' => $email,
            'job_title' => request('job_title'),
            'department' => request('department'),
            'token' => $token
        ]);

        $url = URL::temporarySignedRoute(
            'instUser.registration.form', now()->addMinutes(300), ['token' => $token, 'inst_id' => $inst_id ]
        );

        Notification::route('mail', $email)
                    ->notify(new UserInviteNotification($url));

    }

    public function registration_view(Request $request, $inst_id, $token)
    {
        // DD($token);
        
        $value = $inst_id;

        $inst_detail = Inst::where('id', $value)
                        ->select('id', 'name')
                        ->first();

        $invite = Invite::where('token', $token)
                        ->first();

        return view('inst/auth/register', ['invite' => $invite, 'inst' => $inst_detail]);
    }



}
