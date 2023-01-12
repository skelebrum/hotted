<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class FrontendCarController extends Controller
{
    public function index()
    {
        return view('cars.index', [
            'cars'=>Car::latest()->filter(request('search'))
            ->paginate(4)
        ]);
    }

    public function show(Car $car)
    {
        return view('cars.show', [
            'car'=> $car
        ]);
    }
}