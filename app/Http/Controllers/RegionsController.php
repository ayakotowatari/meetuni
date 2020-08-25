<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Event;
//テスト
use App\Models\EventRegion;
use Auth;
//テスト終わる
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function fetchRegions()
    {
        $regions = Region::all();

        return response()->json(['regions'=>$regions],200);
    }

    public function fetchEventRegions(Request $request, $id)
    {
        $regions = Event::join('event_regions', 'events.id', '=', 'event_regions.event_id')
                    ->join('regions', 'event_regions.region_id', '=', 'regions.id')
                    ->where('events.id', $id)
                    ->select('regions.region')
                    ->get();

        // $regions = Event::with('regions', 'event_regions')
        //             ->where('events.id', $id)
        //             ->get();

        return response()->json(['regions'=>$regions],200);
    }
    
    //テスト
    public function test(Request $request)
    {
        $regions = $request->regions;

        foreach($regions as $region){
            $event_region = new EventRegion();
            $event_region->event_id= 24;
            $event_region->region_id=$region;
            $event_region->save();
        }
    }
    //テスト終わり
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
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }
}
