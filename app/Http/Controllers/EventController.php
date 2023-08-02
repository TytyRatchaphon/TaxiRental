<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        return view('events.index');
    }
    public function show() {
        return view('events.show');
    }
    public function manageKanban() {
        return view('events.manage.kanban');
    }
    public function manageApplicants() {
        return view('events.manage.manage-applicants');
    }
    public function manageStaffs() {
        return view('events.manage.manage-staffs');
    }
    public function manageBudgets() {
        return view('events.manage.manage-budgets');
    }
    public function showCertificates() {
        return view('events.show-certificates');
    }
    public function create() {
        return view('events.create');
    }
}
