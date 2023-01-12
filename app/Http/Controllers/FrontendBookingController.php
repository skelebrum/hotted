<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Car;
use App\Models\Coach;
use App\Models\Booking;
use Spatie\Period\Period;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendBookingController extends Controller
{
    public function storeCar(Request $request)
    {
        $booking = $request->session()->get('booking');
        $data= $request->validate([
            'car_id'=> 'required'
        ]);
        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->fill($data);
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->fill($data);
            $request->session()->put('booking', $booking);
        }
        $car = Car::findOrFail($request->input('car_id'));
        return to_route('booking.show', compact('car'));

    }


    public function show(Request $request)
    {  
        $bookings = Booking::all();
        $coaches = Coach::all();
        $booking = $request->session()->get('booking');
        $car = Car::findOrFail($request['car']);

        $period = Period::make(Carbon::make(now()), Carbon::make(now())->addMonth(1));
        
        
        return view('bookings.show', compact('car', 'coaches', 'booking', 'bookings', 'period'));
    }


    public function store(Request $request, Car $car)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'start_date' =>'required',
            'coach_id' => ['required']
        ]);
        $endDate = Carbon::parse($request['start_date'])->addHours($request['time'])->format("Y-m-d H:i:s");
        $data['end_date'] = $endDate;

        if (empty($request->session()->get('booking'))) {
            $booking = new Booking();
            $booking->fill($data);
            $request->session()->put('booking', $booking);
        } else {
            $booking = $request->session()->get('booking');
            $booking->fill($data);
            $request->session()->put('booking', $booking);
        }
        $booking->save();
        $request->session()->forget('booking');
        return to_route('thankyou');
    }
}
