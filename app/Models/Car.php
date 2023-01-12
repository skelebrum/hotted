<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Car extends Model
{
    use HasFactory;


    protected $fillable= [
        'name', 
        'image', 
        'price', 
        'top_speed', 
        'power',
        'drivetrain',
        'status'
    ];


    public function scopeFilter($query)
    {
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . 
       
            '%');
        }
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    
}
