<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable= [
        'name', 
        'photo', 
        'age', 
        'status',
        'description',    
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
