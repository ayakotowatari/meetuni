<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fetchStudentCountries(Request $request, $id)
    {
        // 学生の出身国

        $event_id = $id;
        
        $countries = Country::join('students', 'countries.id', '=', 'students.country_id')
            ->join('bookings', 'students.id', '=', 'bookings.student_id')
            ->where('bookings.event_id', '=', $id)
            ->where('bookings.cancelled', '=', 0)
            ->groupBy('countries.country')
            ->orderBy('countries.country')
            ->select('countries.country', DB::raw('count(countries.country) as total'))
            ->get();

        $json = [];
        $json2 = [];

        foreach($countries as $country){
            
            // jsonに変換
            // extract($cntrys);
            $json[] = $country->country;
            $json2[] = $country->total;
            // dd($json);
        }

        return response() -> json(['country' => $json, 'total' => $json2]);

    }

    public function fetchStudentDestinations(Request $request, $id)
    {
        $event_id = $id;
        
        $destinations = Country::join('country_students', 'countries.id', '=', 'country_students.country_id')
                            ->join('students', 'country_students.student_id', '=', 'students.id')
                            ->join('bookings', 'students.id', '=', 'bookings.student_id')
                            ->where('bookings.event_id', '=', $event_id)
                            ->where('bookings.cancelled', '=', 0)
                            ->groupBy('countries.country')
                            ->select('countries.country', DB::raw('count(countries.country) as total'))
                            ->get();
    
                    $json3 = [];
                    $json4 = [];
                    
                    foreach($destinations as $destination){
                        // jsonに変換
                        // extract($dtns);
                        $json3[] = $destination->country;
                        $json4[] = $destination->total;        
                    }

                    return response() -> json(['destination' => $json3, 'total' => $json4]);

    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
}
