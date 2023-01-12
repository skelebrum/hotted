<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
      $events = Event::all();
      return view('admin.events.index', compact('events'));
    }

    //Show Create Page
    public function create()
    {
        return view('admin.events.create');
    }
}

