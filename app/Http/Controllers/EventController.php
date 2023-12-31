<?php

namespace App\Http\Controllers;

use App\Models\Enums\ApplicantStatus;
use App\Models\Taxi;
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
    
        if (!Auth::check() || Auth::user()->isRole('USER') ) {
            $taxis = Taxi::byStatusEvent('available')->get();
        }else{
            $taxis = Taxi::get();
        }

        return view('home', ['events' => $taxis]);
    }

    public function show(Taxi $taxi) {
        return view('events.show', ['event' => $taxi]);
    }
    public function edit(Taxi $taxi) {
        return view('events.edit',['event' => $taxi]);
    }
    public function create() {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to be logged in to create an event.');
        }

        return view('events.create');
    }
    public function showPendingEvents() {
        $taxis = Taxi::byStatusEvent('pending')->get();
        return view('events.manage', [
            'events' => $taxis
        ]);
    }
    public function changeStatus(Request $request, Taxi $taxi) {
        /**
         * validate
         */
        $request->validate([
            'status' => ['required']
        ]);

        $taxi->car_status = $request->get('status');
        $taxi->save();

        /**
         * notify to head-event
         */
        $user = $taxi->headEvent()->user;
        $user->notify(new EventApprovedNotification($taxi));

        $taxis = Taxi::get();
        return redirect()->route('events.manage', ['events' => $taxis]);
    }
    public function store(Request $request)
    {
        //remove validation for now
        $request->validate([
            'car_license' => 'required|string|max:16',
            'registration_no' => 'required|string|min:13|max:13',
            'car_color' => 'required|string|max:32',
            'car_year' => 'required|string|max:64',
            'car_image' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'insurance' => 'string|max:32',
        ]);

        $thumbnailPath = null;
        $imagePath = null;
        $certificateImagePath = null;

        
        if ($request->hasFile('car_image')) {
            $imageFile = $request->file('car_image');
            if ($imageFile->isValid()) {
                $imagePath = $imageFile->store('images', 'public');
            }
        }
        
        if (Auth::check()) {

            $taxi = new Taxi([
                'car_license' => $request->get('car_license'), // for all later
                'registration_no' => $request->get('registration_no'),
                'car_image' => $imagePath,
                'car_color' => $request->get('car_color'),
                'car_year' => $request->get('car_year'),
                'insurance' => $request->get('insurance'),
            ]);

            $taxi->save();
        }
        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(Taxi $taxi)
    {
        if (Gate::allows('delete', $taxi)) {
            $taxi->delete();
            return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
        } else {
            return redirect()->route('events.index')->with('error', 'You are not authorized to delete this event.');
        }
    }

        public function update(Request $request, Taxi $taxi)
    {
        // Validate the input data
        $request->validate([
            'car_license' => 'required|string|max:16',
            'registration_no' => 'required|string|min:13|max:13',
            'car_color' => 'required|string|max:32',
            'car_year' => 'required|string|max:64',
            'car_image' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'insurance' => 'string|max:32',
        ]);
    
        // Update the event data
        $taxi->update([
            'car_license' => $request->input('car_license'),
            'registration_no' => $request->input('registration_no'),
            'car_color' => $request->input('car_color'),
            'car_year' => $request->input('car_year'),
            'car_image' => $request->input('car_image'),
            'insurance' => $request->input('insurance'),
        ]);
    

        $taxi->save();
    
        // Redirect back to the edit page with a success message
        return redirect()->route('events.index', ['event' => $taxi])->with('success', 'Event information updated successfully.');
    }

}