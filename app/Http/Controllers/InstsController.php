<?php

namespace App\Http\Controllers;

use App\Models\Inst;
use Illuminate\Http\Request;

class InstsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('inst.auth.search');
    }

    public function search(Request $request)
    {
        //値に合致する大学名があるかどうか検索
        $inst_name = $request -> input('inst_name');

        if(Inst::where('name', $inst_name)->exists()){

            $inst = Inst::where('name', $inst_name)
                         ->select('id', 'name')
                         ->first();
         
            // return view ('inst.auth.register', ['inst' => $inst]);
            return redirect() -> route('instUser.regiform', ['inst' => $inst]);
            // return redirect(route('instUser.regiform', ['inst' => $inst]));

        }else{
            return view('inst.info');
        }
    }

    public function fetchInst($id)
    {
       
        $event_id = $id;

        $inst = Inst::join('events', 'events.inst_id', '=', 'insts.id')
                    ->where('events.id', $id)
                    ->select('insts.id', 'insts.name')
                    ->first();

        return response()->json(['inst' => $inst],200);
    }

    public function fetchFollowedInsts($id)
    {
        $insts = Inst::join('follows', 'insts.id', '=', 'follows.inst_id')
                    ->join('countries', 'insts.country_id', '=', 'countries.id')
                    ->where('follows.student_id', $id)
                    ->select('insts.id', 'insts.name', 'countries.country')
                    ->get();

        return response()->json(['insts' => $insts],200);
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
     * @param  \App\Models\Inst  $inst
     * @return \Illuminate\Http\Response
     */
    public function show(Inst $inst)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inst  $inst
     * @return \Illuminate\Http\Response
     */
    public function edit(Inst $inst)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inst  $inst
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inst $inst)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inst  $inst
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inst $inst)
    {
        //
    }
}
