<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'event_id' => 'required'
        ]);

        $user_id = request('user_id');
        $event_id = request('event_id');

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
    }

    public function unlike(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'event_id' => 'required'
        ]);

        $user_id = request('user_id');
        $event_id = request('event_id');

        Like::where('likes.student_id', $user_id)
             ->where('likes.event_id', $event_id)
             ->delete();

        $currentLike = Like::latest('updated_at')
                        ->where('likes.student_id', $user_id)
                        ->where('likes.event_id', $event_id)
                        ->first();
        $updated_at = $currentLike->updated_at;

        Like::latest('updated_at')
            ->where('likes.student_id', $user_id)
            ->where('likes.event_id', $event_id)
            ->update([ 
                'formatted_updated' => $updated_at 
            ]);
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
