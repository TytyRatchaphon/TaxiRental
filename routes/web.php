<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\OperatorController;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Constraint\Operator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [WelcomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home'); //guest
Route::get('/search-events', [HomeController::class, 'searchEvents']);

Route::get('/login', function () {
    return view('login');
})->middleware(['auth','verified'])->name('login');

Route::get('/event/{event}/kanban', [KanbanController::class, 'kanban'])
    ->name('events.manage.kanban');

// Route Event
Route::resource('/events', EventController::class);
Route::get('/events/event/manage/kanban', [EventController::class, 'manageKanban'])->name('events.manage.kanban');
Route::get('/events/event/manage/applicants', [EventController::class, 'manageApplicants'])->name('events.manage.applicants');
Route::get('/events/event/manage/staffs', [EventController::class, 'manageStaffs'])->name('events.manage.staffs');
Route::get('/events/certificates', [EventController::class, 'showCertificates'])->name('events.show-certificates');

// Route kanban
Route::get('/events/{event}/kanbans', [KanbanController::class, 'showKanbans'])->name('events.kanbans.show');
Route::post('/events/{event}/kanbans', [KanbanController::class, 'storeKanban'])->name('events.kanbans.store');
Route::put('/events/{event}/kanbans/{kanban}', [KanbanController::class, 'updateStatusKanban'])->name('events.kanbans.update-status');
Route::delete('/events/{event}/kanbans/{kanban}', [KanbanController::class, 'destroyKanban'])->name('events.kanbans.destroy');

// Route Operator
Route::get('/operators', [OperatorController::class, 'index'])->name('operators.index');
Route::post('/operators/register', [OperatorController::class, 'create'])->name('operators.create');
Route::delete('/operators/{operator}', [OperatorController::class, 'destroy'])->name('operators.destroy');
Route::get('/operators', [OperatorController::class, 'search'])->name('operators.search');


// Route Manage Event
Route::get('/manage/events', [EventController::class, 'showPendingEvents'])->name('events.manage');
Route::put('/manage/events/{event}', [EventController::class, 'changeStatus'])->name('events.change-status');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
