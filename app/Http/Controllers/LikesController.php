<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Auth;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DatePeriod;

class LikesController extends Controller
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

    // public function test(){
    //     $user_id = Auth::guard('student')->user()->id;
    //     DD($user_id);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required'
        ]);

        $event_id = request('event_id');
        $user_id = Auth::guard('student')->user()->id;
        // DD($user_id);
        

        $like = new Like();
        $like->student_id = $user_id;
        $like->event_id = $event_id;
        $like->save();     

        $currentLike = Like::latest('created_at')
                        ->where('likes.student_id', $user_id)
                        ->where('likes.event_id', $event_id)
                        ->first();
        $created_at = $currentLike->created_at;
        $updated_at = $currentLike->updated_at;

        Like::latest('created_at')
            ->where('likes.student_id', $user_id)
            ->where('likes.event_id', $event_id)
            ->update([ 
                'formatted_created' => $created_at, 
                'formatted_updated' => $updated_at 
            ]);

        return response()->json(['event_id' => $event_id],200);
    }

    public function unlike(Request $request)
    {
        $request->validate([
            // 'user_id' => 'required',
            'event_id' => 'required'
        ]);

        $user_id = Auth::guard('student')->user()->id;
        $event_id = request('event_id');

        Like::where('likes.student_id', $user_id)
             ->where('likes.event_id', $event_id)
             ->delete();

        return response()->json(['event_id' => $event_id],200);

        // $currentLike = Like::latest('updated_at')
        //                 ->where('likes.student_id', $user_id)
        //                 ->where('likes.event_id', $event_id)
        //                 ->first();
        // $updated_at = $currentLike->updated_at;

        // Like::latest('updated_at')
        //     ->where('likes.student_id', $user_id)
        //     ->where('likes.event_id', $event_id)
        //     ->update([ 
        //         'formatted_updated' => $updated_at 
        //     ]);
    }

    public function fillChartDataForLikes (Request $request, $id)
    {
        $today = Carbon::today();
        $likes = Like::where('likes.formatted_created', '>', $today->subDays(7))
            ->where('likes.event_id', $id)
            ->groupBy('likes.formatted_created')
            ->orderBy('likes.formatted_created')
            ->select('likes.formatted_created as date', DB::raw('count(likes.formatted_created) as total'))
            ->get();

        $likes = collect($likes)->keyBy('date')
                    ->map(function($item){
                        $item->date = \Carbon\Carbon::parse($item->date)->format('Y-m-d');
                        return $item;
                    });
        
        // return response() -> json(['chartData' => $bookings]);

        // $periods = new DatePeriod($bookings->min('date'), \Carbon\CarbonInterval::day(), $bookings->max('date')->addDay());   
        $periods = new DatePeriod(Carbon::today()->subDays(7), \Carbon\CarbonInterval::day(), Carbon::today()->addDay());

        $graph = array_map(function ($period) use ($likes){
            $date = $period->format('Y-m-d');

            return (object)[
                'date' => $period->format('D M j'),
                'total' => $likes->has($date) ? $likes->get($date)->total : 0,
            ];
        }, iterator_to_array($periods));

         return response() -> json(['chartDataForLikes' => $graph]);

    }

    public function countLikesNumber(Request $request, $id)
    {
        $likes = Like::where('event_id', $id)
                        ->count();

        return response() -> json(['likes' => $likes]);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
