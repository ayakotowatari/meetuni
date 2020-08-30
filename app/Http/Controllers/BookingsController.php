<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DatePeriod;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fillChartData (Request $request, $id)
    {
        // $today = Carbon::today();
        // $bookings = Booking::where('bookings.event_id', $id)
        //                 ->where('bookings.created_at', '>', $today->subDays(7))
        //                 ->where("bookings.cancelled", '0')
        //                 ->groupBy('bookings.created_at')
        //                 ->orderBy('bookings.created_at')
        //                 ->select('bookings.created_at as date', DB::raw('count(bookings.created_at) as total'))
        //                 ->get();
        // $json = [];
        // $json2 = [];

        // foreach($bookings as $booking){
        //     // jsonに変換
        //     // extract($cntrys);
        //     $json[] = $booking->date;
        //     $json2[] = $booking->total;
        //     // dd($json);
        // }

        // return response()->json(['date'=>$json, 'total'=>$json2],200);

        // $today = Carbon::today();
        // $bookings = Booking::where('bookings.created_at', '>', $today->subDays(7))
        //                     ->get();
        // $response = '';
        // $i = 0;
        // while ($i < 7) {
        //     $dayOfWeek = $today->subDays($i);
        //     $bookingsForThisDay = $bookings->where('created_at', $dayOfWeek);
        //     $response = $bookingsForThisDay->count();
        //     $i++;
        // }
        // return response() -> json(['dataRecord' => $response]);

        $today = Carbon::today();
        $bookings = Booking::where('bookings.created_at', '>', $today->subDays(7))
            ->where('bookings.event_id', $id)
            ->groupBy('bookings.created_at')
            ->orderBy('bookings.created_at')
            ->select('bookings.created_at as date', DB::raw('count(bookings.created_at) as total'))
            ->get();

        $bookings = collect($bookings)->keyBy('date')
                    ->map(function($item){
                        $item->date = \Carbon\Carbon::parse($item->date);
                        return $item;
                    });
        
        // return response() -> json(['dataRecord' => $bookings]);

        $periods = new DatePeriod($bookings->min('date'), \Carbon\CarbonInterval::day(), $bookings->max('date')->addDay());

        $graph = array_map(function ($period) use ($bookings){
            $date = $period->format('Y-m-d H:i:s');

            return (object)[
                'date' => $period->format('D M j'),
                'total' => $bookings->has($date) ? $bookings->get($date)->total : 0,
            ];
        }, iterator_to_array($periods));

         return response() -> json(['chartData' => $graph]);


        // $period = new DatePeriod(Carbon::now()->subDays(7), CarbonInterval::day(), Carbon::now()->addDay());

        // $graph = array_map(function ($datePeriod) use ($bookings){
        //     $date = $datePeriod->format('Y-m-d');
        //     return $bookings->has($date) ? $bookings->get($date)->total: 0;
        // }, iterator_to_array($period));

        // return response() -> json(['dataRecord' => $graph]);

        
                        

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
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
