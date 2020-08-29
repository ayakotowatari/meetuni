<?php

namespace App\Http\Controllers;

use Auth;

use App\User;
use App\Models\InstUser;
use App\Models\Inst;
use App\Models\Event;
use App\Models\Status;
use Illuminate\Http\Request;

class InstUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
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

        $inst = Inst::join('inst_users', 'insts.id', '=', 'inst_users.inst_id')
                    ->join('countries', 'insts.country_id', '=', 'countries.id')
                    ->where('inst_users.id', $id)
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

        // $events = Event::join('event_regions', 'events.id', '=', 'event_regions.event_id')
        //             ->join('regions', 'regions.id', '=', 'event_regions.region_id')
        //             ->join('statuses', 'events.status_id', '=', 'statuses.id')
        //             ->where('events.inst_user_id', $user_id)
        //             ->select('events.id', 'events.title', 'events.date', 'statuses.status', 'regions.region')
        //             ->get();

        $events = Event::join('statuses', 'events.status_id', '=', 'statuses.id')
                    ->where('events.inst_user_id', $user_id)
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
                    ->where([['events.id', $event_id], ['events.inst_user_id', $user_id]])
                    ->select('events.id', 'events.title', 'events.timezone', 'events.date', 'events.start_time', 'events.end_time', 'events.start_utc', 'events.end_utc', 'events.description', 'events.image', 'statuses.status', 'regions.region')
                    ->first();

        return response()->json(['event' => $event],200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstUser  $instUser
     * @return \Illuminate\Http\Response
     */
    public function show(InstUser $instUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstUser  $instUser
     * @return \Illuminate\Http\Response
     */
    public function edit(InstUser $instUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstUser  $instUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InstUser $instUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstUser  $instUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstUser $instUser)
    {
        //
    }
}
