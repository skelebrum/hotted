<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Coach;
use App\Models\Booking;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Rules\SameTime;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();

        return view('admin.bookings.index', compact('bookings'));
    }

    //Show Create Page
    public function create(Booking $booking)
    {
        $bookings = Booking::all();
        $cars = Car::all();
        $coaches = Coach::all();
        return view('admin.bookings.create', compact('cars', 'coaches', 'bookings'), [
            'booking' => $booking
        ]);
    }

    //Store booking
    public function store(Request $request)
    {
        $bookings = Booking::all();

        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'start_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'car_id' => 'required',
            'coach_id' => 'required',
        ]);



        $startDate = $request['start_date'];
        $endDate = Carbon::parse($request['start_date'])->addHours($request['time'])->format("Y-m-d H:i:s");
        $data['end_date'] = $endDate;
        $car = Car::findOrFail($data['car_id']);
        $coach = Coach::findOrFail($data['coach_id']);
        
        //Chech car if reserved
        $carConflict = DB::table('bookings')
            ->where('car_id', request('car_id'))
            
            ->where('start_date', '<=', $endDate)
            
            ->where('end_date', '>=', $startDate)

            ->exists();
        if ($carConflict) {
            return back()->with('message', 'This car is reserved in this date');
        }
        //Chech coach if reserved
        $coachConflict = DB::table('bookings')
            ->where('coach_id', request('coach_id'))
            
            ->where('start_date', '<=', $endDate)
            
            ->where('end_date', '>=', $startDate)

            ->exists();
        if ($coachConflict) {
            return back()->with('message', 'This coach is reserved in this date');
        }

        Booking::create($data);

        return to_route('admin.bookings.index')->with('message', 'Booking created successfully!');
    }

    //Show edit page
    public function edit(Booking $booking)
    {
        $cars= Car::all();
        $coaches = Coach::all();
        return view('admin.bookings.edit', compact('booking', 'cars', 'coaches'));
    }

    //Update booking
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'start_date' => ['required', 'date', new DateBetween, new TimeBetween],
            'car_id' => 'required',
            'coach_id' => 'required',
        ]);

        $startDate = $request['start_date'];
        $endDate = Carbon::parse($request['start_date'])->addHours($request['time'])->format("Y-m-d H:i:s");
        $data['end_date'] = $endDate;
        $car = Car::findOrFail($data['car_id']);
        $coach = Coach::findOrFail($data['coach_id']);

        //Chech car if reserved
        $carConflict = DB::table('bookings')
            ->where('id','!=', $booking->id)

            ->where('car_id', request('car_id'))
            
            ->where('start_date', '<=', $endDate)
            
            ->where('end_date', '>=', $startDate)

            ->exists();
        if ($carConflict) {
            return back()->with('message', 'This car is reserved in this date');
        }

        //Chech coach if reserved
        $coachConflict = DB::table('bookings')
            ->where('id','!=', $booking->id)

            ->where('coach_id', request('coach_id'))
            
            ->where('start_date', '<=', $endDate)
            
            ->where('end_date', '>=', $startDate)

            ->exists();
        if ($coachConflict) {
            return back()->with('message', 'This coach is reserved in this date');
        }

        $booking->update($data);

        return to_route('admin.bookings.index')->with('message', 'Booking updated successfully!');
    }


    //Delete Booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return  to_route('admin.bookings.index')->with('message', 'Booking deleted successfully!');
    }
}
