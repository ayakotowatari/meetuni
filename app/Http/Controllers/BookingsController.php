<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Booking;
use App\Models\Event;
use App\Models\ParticipantNotification;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\EmailToParticipants;

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
        $today = Carbon::today();
        $bookings = Booking::where('bookings.formatted_created', '>', $today->subDays(7))
            ->where('bookings.event_id', $id)
            ->where('bookings.cancelled', '=', 0)
            ->groupBy('bookings.formatted_created')
            ->orderBy('bookings.formatted_created')
            ->select('bookings.formatted_created as date', DB::raw('count(bookings.formatted_created) as total'))
            ->get();

        $bookings = collect($bookings)->keyBy('date')
                    ->map(function($item){
                        $item->date = \Carbon\Carbon::parse($item->date)->format('Y-m-d');
                        return $item;
                    });
        
        // return response() -> json(['chartData' => $bookings]);

        // $periods = new DatePeriod($bookings->min('date'), \Carbon\CarbonInterval::day(), $bookings->max('date')->addDay());   
        $periods = new DatePeriod(Carbon::today()->subDays(7), \Carbon\CarbonInterval::day(), Carbon::today()->addDay());

        $graph = array_map(function ($period) use ($bookings){
            $date = $period->format('Y-m-d');

            return (object)[
                'date' => $period->format('D M j'),
                'total' => $bookings->has($date) ? $bookings->get($date)->total : 0,
            ];
        }, iterator_to_array($periods));

         return response() -> json(['chartData' => $graph]);

    }
    public function fetchEventParticipants(Request $request, $id){

        $event_id = $id;

        $participants = Booking::join('students', 'bookings.student_id', '=', 'students.id')
                                // ->join('users', 'students.id', '=', 'users.id')
                                ->join('countries', 'students.country_id', '=', 'countries.id')
                                ->where('bookings.event_id', $event_id)
                                ->where('bookings.cancelled', '0')
                                ->select('students.first_name', 'students.last_name', 'students.email', 'bookings.created_at','countries.country')
                                ->get();

        // $ppts = Book::join('students', 'books.students_id', '=', 'students.id')
        // ->join('users', 'students.id', '=', 'users.id')
        // ->join('nations', 'students.nations_id', '=', 'nations.id')
        // ->join('s_l_maps', 's_l_maps.students_id', '=', 'books.students_id')
        // ->join('levels', 's_l_maps.levels_id', '=', 'levels.id')
        // ->where('books.events_id', $id)
        // ->where('books.CXL', '=', 0)
        // ->get();
        
        return response()->json(['participants'=>$participants],200);

    }

    public function sendEmailsToParticipants()
    {
        //Notificationを送る準備

        $user_id = Auth::user()->id;
        $event = ParticipantNotification::latest('updated_at')
                                        ->where('user_id', $user_id)
                                        ->select('event_id')
                                        ->first();

        $event_id = $event->event_id;

        $event_detail = Event::find($event_id);

        $bookings = Booking::where('event_id', $event_id)
                            ->where('cancelled', 0)
                            ->get();

        // $students = Student::all();

        // メッセージに含める変数
        $message = ParticipantNotification::where('event_id', $event_id)
                                            ->first();

        $subject = $message->subject;

        foreach($bookings as $booking){

            Notification::send($booking, new EmailToParticipants($booking, $message, $subject, $event_detail));

        }
    }

    public function test()
    {
        $user_id = Auth::user()->id;
        $event = ParticipantNotification::latest('updated_at')
                                        ->where('user_id', $user_id)
                                        ->select('event_id')
                                        ->first();

        $event_id = $event->event_id;

        $event = Event::find($event_id);

        DD($event);
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
        $user_id = Auth::guard('student')->user()->id;
        
        $request->validate([
            'id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            "email" => 'required',
        ]);

        $event_id = request('id');

        $booking = new Booking();
        $booking->event_id = request('id');
        $booking->student_id = $user_id;
        $booking->first_name = request('first_name');
        $booking->last_name = request('last_name');
        $booking->email = request('email');
        $booking->cancelled = 0;
        $booking->save();

        $currentBooking = Booking::latest('created_at')
                                ->where('bookings.student_id', $user_id)
                                ->first();
        $booking_id = $currentBooking->id;
        $created_at = $currentBooking->created_at;
        $updated_at = $currentBooking->updated_at;
        
        Booking::where('bookings.id', $booking_id)
        ->update([ 
            'formatted_created' => $created_at, 
            'formatted_updated' => $updated_at 
        ]);

        return response()->json(['eventId'=>$event_id], 200);
    }

    public function fetchBookedEvents (Request $request, $id)
    {
        $bookings = Booking::join('events', 'bookings.event_id', '=', 'events.id')
                    ->join('insts', 'events.inst_id', '=', 'insts.id')
                    ->where('bookings.student_id', $id)
                    ->where('bookings.cancelled', 0)
                    ->select('bookings.id', 'bookings.event_id', 'bookings.cancelled', 'events.title', 'insts.name', 'events.date', 'events.start_utc', 'events.end_utc', 'events.image')
                    ->get();

        return response()->json(['bookings'=>$bookings], 200);
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'id'=> 'required'
        ]);

        $id = request('id');
        
        Booking::where('bookings.id', $id)
        ->update([ 
            'cancelled' => 1
        ]);

        $currentBooking = Booking::where('bookings.id', $id)->first();

        $updated_at = $currentBooking->updated_at;

        Booking::where('bookings.id', $id)
        ->update([ 
            'formatted_updated' => $updated_at 
        ]);         
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
        
    }
}
