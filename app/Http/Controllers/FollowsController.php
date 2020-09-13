<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;

class FollowsController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'inst_id' => 'required',
            'user_id' => 'required'
        ]);

        $inst_id = request('inst_id');
        $user_id = request('user_id');

        $follow = new Follow();
        $follow->student_id = $user_id;
        $follow->inst_id = $inst_id;
        $follow->save();     

        $currentFollow = Follow::latest('created_at')
                        ->where('student_id', $user_id)
                        ->where('inst_id', $inst_id)
                        ->first();
        $created_at = $currentFollow->created_at;
        $updated_at = $currentFollow->updated_at;

        Follow::latest('created_at')
            ->where('student_id', $user_id)
            ->where('inst_id', $inst_id)
            ->update([ 
                'formatted_created' => $created_at, 
                'formatted_updated' => $updated_at 
            ]);

        return response()->json(['instId' => $inst_id],200);
        
    }

    public function unfollow(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'inst_id' => 'required'
        ]);

        $user_id = request('user_id');
        $inst_id = request('inst_id');

        Follow::where('student_id', $user_id)
             ->where('inst_id', $inst_id)
             ->delete();

        return response()->json(['instId' => $inst_id],200);

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


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function show(Follow $follow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow $follow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follow $follow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follow  $follow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow $follow)
    {
        //
    }
}
