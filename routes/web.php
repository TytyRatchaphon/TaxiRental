<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\NotificationController;
use App\Models\Insurance;
use App\Models\Payment;
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

//===========================Guest Accessible=============

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/home', [TaxiController::class, 'index'])->name('home'); //guest
Route::get('/login', function () {
return view('login');
})->middleware(['auth','verified'])->name('login');
Route::resource('/events', TaxiController::class);

//==========================GROUP OF ROTES THAT REQUIRED AUTH==================================== 

Route::get('/event/{taxi}/kanban', [KanbanController::class, 'kanban'])->name('events.manage.kanban');

//Delete ROUTE FOR ADMIN ONLY!!!
Route::delete('/events/{taxi}', [TaxiController::class, 'destroy'])->name('events.destroy');
Route::post('transaction/{payment}/{booking}/{taxi}', [PaymentController::class, 'applyPay'])->name('payments.apply');

// Route Admin use only!!
Route::get('/create-operators', [OperatorController::class, 'create'])->name('operators.create')->middleware(AdminAccess::class);
Route::post('/create-operators', [OperatorController::class, 'store'])->name('operators.store');

// Route Event
Route::resource('/taxis', TaxiController::class);
Route::get('/mytaxis', [TaxiController::class, 'myTaxi'])->name('taxis.myevent');
Route::get('/managetaxi', [BookingController::class, 'manageTaxi'])->name('bookings.manage');
Route::get('/mybooking', [BookingController::class, 'myBooking'])->name('bookings.mybooking');
Route::get('/events/{taxi}/edits', [TaxiController::class, 'edit'])->name('events.edit');
Route::put('/events/{taxi}/edits/update', [TaxiController::class, 'update'])->name('events.update');
Route::get('/events/{taxi}/manage/applicants', [TaxiController::class, 'showManageApplicants'])->name('events.manage.applicants');
Route::get('/events/{taxi}/manage/staffs', [TaxiController::class, 'manageStaffs'])->name('events.manage.staffs');
Route::get('/certificates', [TaxiController::class, 'showCertificates'])->name('events.show-certificates');
Route::get('/events/create', [TaxiController::class, 'create'])->name('events.create');
Route::post('/events/create', [TaxiController::class, 'store'])->name('taxis.store');
Route::get('/taxis/create',[BookingController::class, 'create'])->name('bookings.create');
Route::post('/taxis/{taxi}',[BookingController::class, 'store'])->name('bookings.store');
Route::get('/taxis/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payment/{booking}', [PaymentController::class, 'store'])->name('payments.store');
Route::post('/events/{taxi}/students/{student}/approve', [TaxiController::class, 'approveStudent'])->name('approve');
Route::post('/events/{taxi}/students/{student}/reject', [TaxiController::class, 'rejectStudent'])->name('reject');
Route::post('/events/{taxi}/detach/{student}', [TaxiController::class, 'detachStudent'])->name('detach');
Route::post('/events/{taxi}/add-staff', [TaxiController::class, 'addStaff'])->name('events.addStaff');
Route::get('mybooking/{booking}', [BookingController::class, 'show'])->name('bookings.show');
Route::get('/transaction', [PaymentController::class,'index'])->name('payment.show');
Route::get('/insurance',[InsuranceController::class,'index'])->name('insurance.show');
Route::post('transaction/{booking}/apply',[BookingController::class, 'applyBooking'])->name('bookings.apply');
Route::delete('transaction/{booking}/reject',[BookingController::class, 'rejectBooking'])->name('bookings.reject');
Route::put('/managetaxi/{booking}/return', [BookingController::class, 'returnCar'])->name('bookings.return');



// Route Manage Event
Route::get('/manage/events', [TaxiController::class, 'showPendingEvents'])->name('events.manage');
Route::put('/manage/events/{event}', [TaxiController::class, 'changeStatus'])->name('events.change-status');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{user}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/edit', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
});

require __DIR__.'/auth.php';
