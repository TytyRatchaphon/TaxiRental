<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Enums\ApplicantStatus;
use App\Models\Insurance;
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

class TaxiController extends Controller
{
    public function myTaxi(){
        $userId = Auth::id(); // Get the ID of the authenticated user
        $userTaxis = Booking::where('user_id', $userId)->get(); // Assuming 'user_id' is the foreign key in the 'taxis' table
        
        return view('mytaxi', ['taxis' => $userTaxis]);
    }
    
    public function index(Request $request) {
    
        if (!Auth::check() || Auth::user()->isRole('ADMIN') ) {
            
            $taxis = Taxi::get();
        }else{
            $taxis = Taxi::whereNotIn('id', function ($query) {
                $query->select('taxi_id')
                    ->from('bookings')
                    ->whereIn('B_status', ['PENDING', 'ON TRIP']);
            })

            
            ->get();
        }

        return view('home', ['taxis' => $taxis]);
    }

    public function show(Taxi $taxi) {
        return view('events.show', ['taxi' => $taxi]);
    }
    public function edit(Taxi $taxi) {
        return view('events.edit',['taxi' => $taxi]);
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
            'taxis' => $taxis
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

        $taxis = Taxi::get();
        return redirect()->route('events.manage', ['taxis' => $taxis]);
    }
    public function store(Request $request)
    {
        //remove validation for now
        $request->validate([
            'car_license' => 'required|string|max:16|unique:taxis',
            'registration_no' => 'required|string|min:13|max:13|unique:taxis',
            'car_color' => 'required|string|max:32',
            'car_model' => 'required|string|max:64',
            'car_image' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'insurance' => 'string|max:32',
        ]);

        $imagePath = null;

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
                'car_model' => $request->get('car_model'),
                'insurance' => $request->get('insurance'),
            ]);

            $taxi->save();
        }
        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(Taxi $taxi)
    {
            $taxi->delete();
            return redirect(RouteServiceProvider::HOME);
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
        return redirect()->route('events.index', ['taxi' => $taxi])->with('success', 'Event information updated successfully.');
    }

}