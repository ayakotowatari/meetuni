<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Inst;
use App\Models\Event;
use App\Models\Status;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
                    ->select('insts.name', 'countries.country')
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



}
