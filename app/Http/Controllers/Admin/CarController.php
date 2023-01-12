<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    //Show Index Pages
    public function index()
    {
        date_default_timezone_set("Etc/GMT-5");
        $cars = Car::all();
        $currentDate = date('Y-m-d H:i:s');
        foreach ($cars as $car) {
            $currentStatus = DB::table('bookings')
                ->where('car_id', $car->id)
                ->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate)
                ->exists();
                // dd($currentStatus);
            if ($currentStatus) {
                $car->status = 'reserved';
            } else {
                $car->status = 'available';
            }
        }

        return view('admin.cars.index', compact('cars'));
    }


    //Show Create Page
    public function create()
    {
        return view('admin.cars.create');
    }

    //Create Car
    public function store(CarRequest $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'top_speed' => 'required',
            'power' => 'required',
            'drivetrain' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        // if(isset($request['status'])){

        // }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }
        Car::create($data);
        return to_route('admin.cars.index')->with('message', 'Car created successfully!');
    }

    //Show Edit Page
    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    //Update Car
    public function update(Request $request, Car $car)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'top_speed' => 'required',
            'power' => 'required',
            'drivetrain' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($data);

        return  to_route('admin.cars.index')->with('message', 'Car updated successfully!');
    }

    //Destroy coach
    public function destroy(Car $car)
    {
        $car->delete();
        return  to_route('admin.cars.index')->with('message', 'Car deleted successfully!');
    }
}
