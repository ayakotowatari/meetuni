<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    public function fetchLevels()
    {
        $levels = Level::whereNotNull('level')
                ->get();

        return response()->json(['levels'=>$levels],200);
    }
}
