<?php

namespace App\Http\Controllers;

use App\Models\Enums\ApplicantStatus;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Student;
use App\Models\User;
use App\Notifications\EventApprovedNotification;
use App\Notifications\ApplicantApprovedNotification;
use App\Notifications\StaffEventNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request) {
    
        if (!Auth::check() || Auth::user()->isRole('STUDENT')) {
            $events = Event::byStatusEvent('approved')->byDeadline()->get();
        } else {
            $events = Event::byDeadline()->get();
        }
        
        /**
         * search with input
         */
        $query = $request->input('search');
        $events = $query ? Event::where('event_name', 'LIKE', "%{$query}%")->get() : $events;

        return view('home', ['events' => $events]);
    }

    public function showMyEvent(Request $request) {
        $user = Auth::user();
        
        // Assuming the user has a student relationship defined
        $student = $user->student;
    
        // Assuming there's a relationship between students and events
        $events = $student->events()->endEvent()->get();
    
        return view('home', ['events' => $events]);
    }
    
    public function show(Event $event) {
        return view('events.show', ['event' => $event]);
    }
    public function showManageApplicants(Event $event) {
        return view('events.manage.manage-applicants',['event' => $event]);
    }
    public function edit(Event $event) {
        return view('events.manage.manage-edit',['event' => $event]);
    }
    public function manageStaffs(Event $event) {
        $students = $event->students;
        return view('events.manage.manage-staffs',['students' => $students,'event'=> $event]);
    }
    public function showCertificates() {
        $student = Auth::user()->student;
        $events = $student->events()->byStatusEvent(ApplicantStatus::APPROVED)->byEndEvent()->get();
        return view('events.show-certificates', ['events' => $events]);
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
        $user = $event->headEvent()->user;
        $user->notify(new EventApprovedNotification($event));

        $events = Event::get();
        return redirect()->route('events.manage', ['events' => $events]);
    }
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
            'event_certificate_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = null;
        $imagePath = null;
        $certificateImagePath = null;

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

        if ($request->hasFile('event_certificate_image')) {
            $certificateImageFile = $request->file('event_certificate_image');
            if ($certificateImageFile->isValid()) {
                $certificateImagePath = $certificateImageFile->store('certificates', 'public');
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
                'event_certificate_image' => $certificateImagePath,
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

    public function apply(Event $event) {
        Gate::authorize('requestJoin', $event);
        $user = Auth::user();
        $event->students()->attach($user->student->id, ['role' => 'APPLICANT', 'status' => 'pending']);
        return redirect()->back()->with('success', 'Applied for the event successfully!');
    }

    public function approveStudent(Event $event, Student $student)
    {
        // You might want to add additional logic here
        $event->students()->updateExistingPivot($student, ['status' => ApplicantStatus::APPROVED]);
        /**
         * notify
         */
        $user = $event->students()->find($student->id)->user;
        $user->notify(new ApplicantApprovedNotification($event, $user->student));
        return redirect()->back()->with('success', 'Student has been approved.');
    }

    public function rejectStudent(Event $event, Student $student)
    {
        // You might want to add additional logic here
        $event->students()->updateExistingPivot($student, ['status' => ApplicantStatus::UNAPPROVED]);
        /**
         * notify
         */
        $user = $event->students()->find($student->id)->user;
        $user->notify(new ApplicantApprovedNotification($event, $user->student));
        return redirect()->back()->with('success', 'Student has been rejected.');
    }

    public function detachStudent(Event $event, Student $student)
    {
        // Detach the student from the event
        $event->students()->detach($student);

        return redirect()->back()->with('success', 'Participant detached successfully.');
    }
    
    public function addStaff(Request $request, Event $event)
    {
        $request->validate([
            'username' => ['string', 'min:3', 'max:20']
        ]);
        $username = $request->input('username');

        // Find the user by username
        $user = User::where('username', $username)->first();

        if (!$user || !$user->isRole('STUDENT')) {
            return redirect()->route('events.manage.staffs', ['event' => $event])->with('error', 'User not found.');
        }

        // Attach the user as staff to the event
        $event->students()->attach($user->student->id, ['role' => 'STAFF', 'status' => 'approved']);
        /**
         * notify
         */
        $user->notify(new StaffEventNotification($event, $user->student));
        return redirect()->back()->with('success', 'Staff added successfully.');
    }

        public function update(Request $request, Event $event)
    {
        // Validate the input data
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
            'event_certificate_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Update the event data
        $event->update([
            'event_name' => $request->input('event_name'),
            'event_date' => $request->input('event_date'),
            'event_location' => $request->input('event_location'),
            'event_description' => $request->input('event_description'),
            'event_expense_amount' => $request->input('event_expense_amount'),
            'event_applicants_limit' => $request->input('event_applicants_limit'),
            'event_staffs_limit' => $request->input('event_staffs_limit'),
            'event_application_deadline' => $request->input('event_application_deadline'),
        ]);
    
        // Handle file uploads if new files are provided
        if ($request->hasFile('event_thumbnail')) {
            // Handle thumbnail upload
        }
    
        if ($request->hasFile('event_image')) {
            // Handle image upload
        }
    
        if ($request->hasFile('event_certificate_image')) {
            // Handle certificate image upload
        }

        $event->event_approval_status = 'pending';
        $event->save();
    
        // Redirect back to the edit page with a success message
        return redirect()->route('events.index', ['event' => $event])->with('success', 'Event information updated successfully.');
    }

}