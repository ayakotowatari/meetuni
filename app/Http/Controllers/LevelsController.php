<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelsController extends Controller
{
    public function fetchLevels()
    {
        $levels = Level::whereNotNull('level')
                ->get();

        return response()->json(['levels'=>$levels],200);
    }

    public function fetchEventLevels(Request $request, $id)
    {
        $eventLevels = Event::join('event_levels', 'events.id', '=', 'event_levels.event_id')
                    ->join('levels', 'event_levels.level_id', '=', 'levels.id')
                    ->where('events.id', $id)
                    ->select('levels.level')
                    ->get();

        // $regions = Event::with('regions', 'event_regions')
        //             ->where('events.id', $id)
        //             ->get();

        return response()->json(['eventLevels'=>$eventLevels],200);
    }

    public function fetchStudentLevels(Request $request, $id)
    {
        $event_id = $id;

        $levels = Level::join('level_students', 'levels.id', '=', 'level_students.level_id')
            ->join('students', 'level_students.student_id', '=', 'students.id')
            ->join('bookings', 'students.id', '=', 'bookings.student_id')
            ->where('bookings.event_id', '=', $event_id)
            ->where('bookings.cancelled', '=', 0)
            ->groupBy('levels.level')
            ->select('levels.level', DB::raw('count(levels.level) as total'))
            ->get();
        
            $json5 = [];
            $json6 = [];
    
            foreach($levels as $level){
                    // jsonに変換
                    // extract($lvls);
                    $json5[] = $level->level;
                    $json6[] = $level->total;
            }

            return response() -> json(['level' => $json5, 'total' => $json6]);
    }
}