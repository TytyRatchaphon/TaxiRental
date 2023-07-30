<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Fetch any data needed for the Home Page
        $events = Event::all(); // Example: Fetch all events

        $query = $request->input('search');
        
        // If a search query is provided, filter the events based on the query
        $events = $query ? Event::where('event_name', 'LIKE', "%{$query}%")->get() : Event::all();

        // Pass the data to the Home Page view and render it
        return view('home', compact('events'));
    }

    public function searchEvents(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $events = Event::where('event_name', 'LIKE', "%{$query}%")->limit(5)->get();
        } else {
            $events = [];
        }

        return $events;
    }

}
