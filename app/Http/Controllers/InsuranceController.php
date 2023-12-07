<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function index(Request $request) {
        $insurances = Insurance::get();
        return view('insurance.index',['insurances' => $insurances]);
    }
}
