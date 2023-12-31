<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index() {
        $notifications = Auth::user()->unreadNotifications()->paginate(10);
        return view('notification', ['notifications' => $notifications]);
    }
}
