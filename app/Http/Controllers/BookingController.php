<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Taxi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class BookingController extends Controller
{
    public function index(){
        $bookings = Booking::where('B_status', 'PENDING');
        return view('events.transaction',['bookings' => $bookings]);
    }

    public function myBooking(){
        $userId = Auth::id();
        $bookings = Booking::where('user_id', $userId)->get();

        return view('mybooking', ['bookings' => $bookings]);
    }
    public function manageTaxi(){
        $bookings = Booking::where('B_status', 'ON TRIP')->get();
        return view('managetaxi', ['bookings' => $bookings]);
    }
    public function returnCar(Booking $booking){
        $booking->B_status = 'END TRIP';
        $booking->save();
        return redirect(RouteServiceProvider::HOME);
        
    }
    public function deleteCar(Booking $booking){
        $booking->delete();
        return redirect(RouteServiceProvider::HOME);
    }
    public function show(Booking $booking){
        return view('payment', ['booking' => $booking]);
    }
    public function applyBooking(Booking $booking){
        $booking->B_status = 'ON TRIP';
        $booking->save();
        return redirect(RouteServiceProvider::HOME);
    }

    public function rejectBooking(Booking $booking){
        $booking->B_status = 'CANCLE';
        $booking->save();
        return redirect(RouteServiceProvider::HOME);
    }
    public function store(Request $request, Taxi $taxi){
        if (Auth::check()) {

            $booking = new Booking();
            $booking->taxi_id = $taxi->id;
            $booking->user_id = auth()->id();
            $booking->B_status = "PENDING";
            $booking->B_date = $request->get('B_date');
            

            $booking->save();
            return redirect(RouteServiceProvider::HOME);
        }
    }
}
