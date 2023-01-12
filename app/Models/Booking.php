<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    public $timestamps = true;


    protected $fillable= [
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'start_date',
        'end_date',
        'time',
        'car_id',
        'coach_id'
    ];

    protected $date = [
        'start_date',
        'end_date'
      ];

    //Car Relationship
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
     //Coach Relationship
     public function coach()
     {
         return $this->belongsTo(Coach::class);
     }

     //Booking time interval

     public function timeInterval($time)
     {
        return CarbonInterval::hours($time);
     }
 }

