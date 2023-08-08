<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Models\Event;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search-events', [HomeController::class, 'searchEvents']);

Route::get('/login', function () {
    return view('login');
})->middleware(['auth','verified'])->name('login');

Route::resource('/events', EventController::class);
// Route::get('/events', [EventController::class, 'index'])->name('events.index');
// // Route::get('/events/show', 'EventController@show')->name('events.show');
// Route::get('/events/event/manage/kanban', [EventController::class, 'manageKanban'])->name('events.manage.kanban');
// Route::get('/events/event/manage/applicants', [EventController::class, 'manageApplicants'])->name('events.manage.applicants');
// Route::get('/events/event/manage/staffs', [EventController::class, 'manageStaffs'])->name('events.manage.staffs');
// Route::get('/events/event/manage/budgets', [EventController::class, 'manageBudgets'])->name('events.manage.budgets');
// Route::get('/events/certificates', [EventController::class, 'showCertificates'])->name('events.show-certificates');
// Route::get('/events/create', [EventController::class, 'create'])->name('events.create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
