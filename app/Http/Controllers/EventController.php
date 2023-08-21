<?php

namespace App\Http\Controllers;

use App\Models\Enums\ApplicantStatus;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Student;
use App\Notifications\EventApprovedNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function index() {
        // return view('events.index');
        $event = Event::get();
        return view('home', ['events' => $event]);
    }

    public function show(Event $event)
    {
        // $event = Event::all();

        // Retrieve the event details using the $eventId and $eventName
        // You can use Eloquent or query builder to fetch the event details from the database
        
        // For demonstration purposes, I'm just returning the eventId, eventName, and the event details
        return view('events.show', ['event' => $event]);
    }
    public function manageKanban() {
        return view('events.manage.kanban');
    }
    public function showManageApplicants(Event $event) {
        $students = $event->students;
        return view('events.manage.manage-applicants',['students' => $students, 'event' => $event]);
    }
    public function manageStaffs(Event $event) {
        return view('events.manage.manage-staffs',['event'=> $event]);
    }
    public function manageBudgets(EVent $event) {
        return view('events.manage.manage-budgets', ['event'=> $event]);
    }
    public function showCertificates() {
        $student = Auth::user()->student;
        $events = $student->events()->byStatusEvent(ApplicantStatus::APPROVED)->byEndEvent()->get();
        return view('events.show-certificates', ['events' => $events]);
    }
    public function updateApproveApplicant(Request $request, Event $event, Student $student){
        $request->validate(['status' => ['required']]);
        $student = $student->where('student_id', $student->id)->exists();
        $student->status = $request->get('status');
        $student->save();

        return redirect()->route('events.manage.manage-applicants', ['event'=> $event]);
    }
    
    public function create() {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to create an event.');
        }

        return view('events.create');
    }
    public function showPendingEvents() {
        $events = Event::byStatusEvent('pending')->get();
        return view('events.manage', [
            'events' => $events
        ]);
    }
    public function changeStatus(Request $request, Event $event) {
        /**
         * validate
         */
        $request->validate([
            'status' => ['required']
        ]);

        $event->event_approval_status = $request->get('status');
        $event->save();

        /**
         * notify to head-event
         */
        $user = $event->students()->byRoleEvent('HEAD')->user;
        $user->notify(new EventApprovedNotification($event));

        $events = Event::get();
        return redirect()->route('events.manage', ['events' => $events]);
    }

    // public function show($eventId)
    // {
    //     // Retrieve the data from the request
    //     // You can pass the data to the view or perform any other operations

    //     return view('events', ['eventId' => $eventId]);
    // }

    public function store(Request $request)
    {
        //remove validation for now
        $request->validate([
            'event_name' => 'required|max:255',
            'event_date' => 'required|date',
            'event_location' => 'required|max:255',
            'event_description' => 'required',
            'event_expense_amount' => 'required|numeric|min:0',
            'event_applicants_limit' => 'required|integer|min:1',
            'event_staffs_limit' => 'required|integer|min:1',
            'event_application_deadline' => 'required|date|before_or_equal:event_date',
            'event_thumbnail' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_image' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = null;
        $imagePath = null;

        if ($request->hasFile('event_thumbnail')) {
            $thumbnailFile = $request->file('event_thumbnail');
            if ($thumbnailFile->isValid()) {
                $thumbnailPath = $thumbnailFile->store('thumbnails', 'public');
            }
        }
        
        if ($request->hasFile('event_image')) {
            $imageFile = $request->file('event_image');
            if ($imageFile->isValid()) {
                $imagePath = $imageFile->store('images', 'public');
            }
        }
        

        if (Auth::check() && Auth::user()->student) {
            $student = Auth::user()->student;
        

            $event = new Event([
                'event_name' => $request->get('event_name'), // for all later
                'event_date' => $request->get('event_date'),
                'event_thumbnail' => $thumbnailPath,
                'event_image' => $imagePath,
                'event_location' => $request->get('event_location'),
                'event_description' => $request->get('event_description'),
                'event_expense_amount' =>$request->get('event_expense_amount'),
                'event_applicants_limit' => $request->get('event_applicants_limit'),
                'event_staffs_limit' => $request->get('event_staffs_limit'),
                'event_application_deadline' => $request->get('event_application_deadline'),
            ]);

            $event->save();
            $event->students()->attach($student->id, ['role' => 'HEAD']);
        }
        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(Event $event)
    {
        if (Gate::allows('delete', $event)) {
            $event->delete();
            return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
        } else {
            return redirect()->route('events.index')->with('error', 'You are not authorized to delete this event.');
        }
    }
}
