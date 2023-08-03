<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
            'Major' => ['required', 'string', 'max:255'],
            'Faculty' => ['required', 'string', 'max:255'],
            'Year' => ['required', 'integer', 'min:1', 'max:4'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Handle profile image upload
        if ($request->hasFile('user_profile_img')) {
            $user_profile_img = $request->file('user_profile_img')->store('profile_images', 'public');
        } else {
            $user_profile_img = null;
        }

        $user = User::create([
            'user_firstname' => $request->user_firstname,
            'user_lastname' => $request->user_lastname,
            'username' => $request->username,
            'user_profile_img' => $user_profile_img,
            'Major' => $request->Major,
            'Faculty' => $request->Faculty,
            'Year' => $request->Year,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
