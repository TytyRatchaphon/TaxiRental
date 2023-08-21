<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $operators = User::byRole('OPERATOR')->get();
        return view('operators.index', ['operators' => $operators]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operators.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_firstname' => 'required|string|max:255',
            'user_lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|string|min:8|confirmed',
            'organization' => 'required|string|max:255',
            //'user_profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        //$imageName = null;
        //if ($request->hasFile('user_profile_img')) {
        //    $image = $request->file('user_profile_img');
        //    $imageName = time() . '.' . $image->getClientOriginalExtension(); // how profile img file will be name when store
        //    $image->storeAs('public/', $imageName);
        //    return $imageName;
        //}

        $user = User::create([
            //'user_profile_img' => $imageName,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $operator)
    {
        $operator->delete();
        $operator->forcedelete(); // JUST IN CASE, IT GONNA CALLED BY ADMIN ONLY ANYWAY SO....
        $operators = User::byRole('OPERATOR')->get();
        return view('operators.index', [
            'operators' => $operators
        ]);
    }

    public function search(Request $request) {
        $input = $request->get('input');
        $operators = User::byRole('OPERATOR')->forSearch($input)->get();
        return view('operators.index', [
            'operators' => $operators
        ]);
    }
}
