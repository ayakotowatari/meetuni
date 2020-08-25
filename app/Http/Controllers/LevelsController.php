<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Event;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    public function fetchLevels()
    {
        $levels = Level::whereNotNull('level')
                ->get();

        return response()->json(['levels'=>$levels],200);
    }

    public function fetchProjectLevels(Request $request, $id)
    {
        $levels = Event::join('event_levels', 'events.id', '=', 'event_levels.event_id')
                    ->join('levels', 'event_levels.level_id', '=', 'levels.id')
                    ->where('events.id', $id)
                    ->select('levels.level')
                    ->get();

        // $regions = Event::with('regions', 'event_regions')
        //             ->where('events.id', $id)
        //             ->get();

        return response()->json(['levels'=>$levels],200);
    }
}
