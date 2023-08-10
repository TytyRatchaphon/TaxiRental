<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserStudent;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */

    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_firstname' => ['required', 'string', 'max:255'],
            'user_lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'user_profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'major' => ['required', 'string', 'max:255'],
            'faculty' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1', 'max:4'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        // Handle profile image upload
        $imageName = null;
        if ($request->hasFile('user_profile_img')) {
            $image = $request->file('user_profile_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // how profile img file will be name when store
            $image->storeAs('public/', $imageName);
        }
    
        $user = User::create([
            'user_firstname' => $request->user_firstname,
            'user_lastname' => $request->user_lastname,
            'username' => $request->username,
            'user_profile_img' => $imageName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $userStudent = UserStudent::create([
            'user_id' => $user->id,
            'major' => $request['major'],
            'faculty' => $request['faculty'],
            'year' => $request['year'],
            'role' => $request['role'],
        ]);


        

        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(RouteServiceProvider::HOME);
    }
}
