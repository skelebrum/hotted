<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coach;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::all();
        return view('admin.coaches.index', compact('coaches'));
    }

    //Show Create Page
    public function create()
    {
        return view('admin.coaches.create');
    }

    //Create Coach
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'age' => ['required'],
            'status' => 'required',
            'description'=>'required',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('coaches', 'public');
        }
        Coach::create($data);
        return  to_route('admin.coaches.index')->with('message', 'Coach created successfully!');
    }

    //Show Edit Page
    public function edit(Coach $coach)
    {
        return view('admin.coaches.edit', compact('coach'));
    }

    //Update Coach
    public function update(Request $request, Coach $coach)
    {   
        $data = $request->validate([
            'name'=>'required',
            'age'=>'required',
            'status' => 'required',
            'description'=>'required',
        ]);
        if($request->hasFile('photo')){
            $data['photo'] = $request->file('photo')->store('coaches', 'public');
        }

        $coach->update($data);
        
        return  to_route('admin.coaches.index')->with('message', 'Coach updated succesfsully!');
    }
        

    //Destroy coach
    public function destroy(Coach $coach)
    {
        $coach->delete();
        return  to_route('admin.coaches.index')->with('message', 'Coach deleted successfully!');

    }

}
