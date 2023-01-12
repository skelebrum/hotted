<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Booking;
use Spatie\Period\Period;
use Illuminate\Http\Request;
use Spatie\Period\Precision;

class WelcomeController extends Controller
{
    public function thankyou(Car $car)
    {
        
       

      
        // $datePeriod = Period::make($booking['start_date'], $booking['end_date'], Precision::HOUR());
    
        return view('thankyou', compact('car'));
    }
}
