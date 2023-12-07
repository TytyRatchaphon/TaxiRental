<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Taxi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{
    public function index(){
        if (Auth::check() || Auth::user()->isRole('ADMIN')) {
                $bookings = Booking::get();
        }
        return view('events.transaction',['bookings' => $bookings]);
    }


    public function store(Request $request, Booking $booking){
        $request->validate([
            'amount' => 'required|string',
            'payment_method' => 'required|string',
            'image_path' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imagePath = null;


        if ($request->hasFile('image_path')) {
            $imageFile = $request->file('image_path');
            if ($imageFile->isValid()) {
                $imagePath = $imageFile->store('images', 'public');
            }
        }

            $payment = new Payment([
                'P_date' =>$request->get('P_date'),
                'booking_id' => $booking->id,
                'payment_method' => $request->get('payment_method'),
                'amount' => $request->get('amount'),
                'image_path' => $imagePath,
            ]);
            
        $payment->save();
        return redirect(RouteServiceProvider::HOME);
    }

    public function applyPay(Payment $payment, Booking $booking, Taxi $taxi){
        $booking->B_status = 'ON TRIP';
        $taxi->car_status = 'occupied';
        $booking->save();
        $taxi->save();
    }
}
