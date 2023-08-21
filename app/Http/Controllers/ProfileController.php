<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index() {
        $user = Auth::user();
        return view('profile.index', ['user' => $user]);
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'string', 'min:3', 'max:255'],
            'user_profile_img' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'user_firstname' => ['required', 'string', 'min:3', 'max:255'],
            'user_lastname' => ['required', 'string',  'min:3', 'max:255'],
            'major' => ['required', 'string', 'min:3', 'max:255'],
            'faculty' => ['required', 'string', 'min:3', 'max:255'],
            'year' => ['required', 'integer', 'min:1', 'max:4'],
            'facebook' => ['nullable', 'string', 'min:3', 'max:255'],
            'line' => ['nullable', 'string', 'min:3', 'max:255'],
            'instagram' => ['nullable', 'string', 'min:3', 'max:255'],
            'password' => ['nullable', 'confirmed'],
            
        ]);

        // Handle profile image upload
        $imageName = null;
        if ($request->hasFile('user_profile_img')) {
            $image = $request->file('user_profile_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // how profile img file will be name when store
            $image->storeAs('public/', $imageName);
        }else {
            // If no new image is uploaded, use the old image's name
            $imageName = Auth::user()->user_profile_img;
        }

        $user->username = $request->get('username');
        $user->user_firstname = $request->get('user_firstname');
        $user->user_lastname = $request->get('user_lastname');
        $user->user_profile_img = $imageName;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        } else {
            $user->email = $request->get('email');

        }

        if ($request->get('password') !== null) {
            $user->password = $request->get('password');
        }

        if ($user->role === "STUDENT") {
            $student = $user->student;
            $student->major = $request->get('major');
            $student->faculty = $request->get('faculty');
            $student->year = $request->get('year');
            $student->facebook = $request->get('facebook');
            $student->line = $request->get('line');
            $student->instagram = $request->get('instagram');
            $student->save();
        }

        $user->save();
        return redirect()->route('profile.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}