<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\NotificationController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAccess;

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

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::resource('/events', EventController::class);

//==========================GROUP OF ROTES THAT REQUIRED AUTH==================================== 

Route::get('/event/{event}/kanban', [KanbanController::class, 'kanban'])
    ->name('events.manage.kanban');

//Delete ROUTE FOR ADMIN ONLY!!!
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

// Route Admin use only!!
Route::get('/create-operators', [OperatorController::class, 'create'])->name('operators.create')->middleware(AdminAccess::class);
Route::post('/create-operators', [OperatorController::class, 'store'])->name('operators.store');

// Route Event
Route::resource('/events', EventController::class);
Route::get('/events/event/manage/kanban', [EventController::class, 'manageKanban'])->name('events.manage.kanban');
Route::get('/events/{event}/manage/applicants', [EventController::class, 'showManageApplicants'])->name('events.manage.applicants');
Route::get('/events/{event}/manage/staffs', [EventController::class, 'manageStaffs'])->name('events.manage.staffs');
Route::get('/events/{event}/manage/budgets', [EventController::class, 'manageBudgets'])->name('events.manage.budgets');
Route::get('/certificates', [EventController::class, 'showCertificates'])->name('events.show-certificates');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::put('/events/{event}/manage/applicants/{student}', [EventController::class, 'updateApproveApplicant'])->name('applicant.update');

//Delete ROUTE FOR ADMIN ONLY!!!
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

// Route kanban
Route::get('/events/{event}/kanbans', [KanbanController::class, 'showKanbans'])->name('events.kanbans.show');
Route::post('/events/{event}/kanbans', [KanbanController::class, 'storeKanban'])->name('events.kanbans.store');
Route::put('/events/{event}/kanbans/{kanban}', [KanbanController::class, 'updateStatusKanban'])->name('events.kanbans.update-status');
Route::delete('/events/{event}/kanbans/{kanban}', [KanbanController::class, 'destroyKanban'])->name('events.kanbans.destroy');

// Route Operator
Route::get('/operators', [OperatorController::class, 'index'])->name('operators.index');
Route::delete('/operators/{operator}', [OperatorController::class, 'destroy'])->name('operators.destroy');
Route::get('/operators', [OperatorController::class, 'search'])->name('operators.search');


// Route Manage Event
Route::get('/manage/events', [EventController::class, 'showPendingEvents'])->name('events.manage');
Route::put('/manage/events/{event}', [EventController::class, 'changeStatus'])->name('events.change-status');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
});

require __DIR__.'/auth.php';
