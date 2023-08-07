<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

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
        return view('events.create');
    }

    // public function show($eventId)
    // {
    //     // Retrieve the data from the request
    //     // You can pass the data to the view or perform any other operations

    //     return view('events', ['eventId' => $eventId]);
    // }
}
