<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
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
            'F_name' => ['required', 'string', 'max:127'],
            'L_name' => ['required', 'string', 'max:127'],
            'email' => ['required', 'string', 'max:127', 'unique:users'],
            'user_profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_number' => ['required', 'string', 'min:10', 'max:10', 'unique:users'],
            'id_card_number' => ['required', 'string', 'min:13', 'max:13', 'unique:users'],
            'license_id' => ['required', 'string', 'min:8', 'max:8', 'unique:users'],
            'pb_license' => ['required', 'string', 'min:8', 'max:8', 'unique:users'],
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
            'F_name' => $request->F_name,
            'L_name' => $request->L_name,
            'email' => $request->email,
            'id_card_number' => $request->id_card_number,
            'user_profile_img' => $imageName,
            'phone_number' => $request->phone_number,
            'license_id' => $request->license_id,
            'pb_license' => $request->pb_license,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
