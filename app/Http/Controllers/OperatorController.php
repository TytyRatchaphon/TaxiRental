<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    public function create()
    {
        return view('operator.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_firstname' => 'required|string|max:255',
            'user_lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|string|min:8|confirmed',
            'organization' => 'required|string|max:255',
        ]);

        $user = User::create([
            'user_firstname' => $request->user_firstname,
            'user_lastname' => $request->user_lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'organization' => $request->organization,
        ]);

        $user->role = "OPERATOR";
        $user->save();

        // Any other logic you want to perform after creating an operator user

        return redirect()->route('home')->with('success', 'Operator user created successfully.');
    }
}
