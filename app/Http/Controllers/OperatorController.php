<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $operator)
    {
        $operator->delete();
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
