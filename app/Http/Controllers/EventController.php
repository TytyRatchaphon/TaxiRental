<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index() {
        // return view('events.index');
        $event = Event::get();
        return view('home', [
            'events' => $event
        ]);
    }
    public function show(Event $event)
    {
        // $event = Event::all();

        // Retrieve the event details using the $eventId and $eventName
        // You can use Eloquent or query builder to fetch the event details from the database
        
        // For demonstration purposes, I'm just returning the eventId, eventName, and the event details
        return view('events.show', ['event'=> $event]);
    }
    public function manageKanban() {
        return view('events.manage.kanban');
    }
    public function manageApplicants() {
        return view('events.manage.manage-applicants');
    }
    public function manageStaffs() {
        return view('events.manage.manage-staffs');
    }
    public function manageBudgets() {
        return view('events.manage.manage-budgets');
    }
    public function showCertificates() {
        return view('events.show-certificates');
    }
    public function create() {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to create an event.');
        }

        return view('events.create');
    }

    // public function show($eventId)
    // {
    //     // Retrieve the data from the request
    //     // You can pass the data to the view or perform any other operations

    //     return view('events', ['eventId' => $eventId]);
    // }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'event_location' => 'required|string|max:255',
            'event_description' => 'nullable|string',
            'event_expense_amount' => 'required|numeric|min:0',
            'event_applicants_limit' => 'required|integer|min:1',
            'event_staffs_limit' => 'required|integer|min:1',
            'event_application_deadline' => 'required|date',
        ]);

        $thumbnailPath = null;
        $imagePath = null;

        if ($request->hasFile('event_thumbnail')) {
            $thumbnailPath = $request->file('event_thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('images', 'public');
        }

        $event = new Event([
            'event_name' => $validatedData['event_name'],
            'event_date' => $validatedData['event_date'],
            'event_thumbnail' => $thumbnailPath,
            'event_image' => $imagePath,
            'event_location' => $validatedData['event_location'],
            'event_description' => $validatedData['event_description'],
            'event_expense_amount' => $validatedData['event_expense_amount'],
            'event_applicants_limit' => $validatedData['event_applicants_limit'],
            'event_staffs_limit' => $validatedData['event_staffs_limit'],
            'event_application_deadline' => $validatedData['event_application_deadline'],
        ]);

        $event->save();
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

}
