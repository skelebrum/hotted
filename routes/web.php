<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CoachController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\FrontendCarController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\FrontendBookingController;
use App\Http\Controllers\WelcomeController;

Route::get('/', function () {
    return view('welcome');
});

//Show all cars
Route::get('/cars', [FrontendCarController::class, 'index'])->name('cars.index');
//Show selected car
Route::get('/cars/{car}', [FrontendCarController::class, 'show'])->name('cars.show');

//Show booking page
Route::post('/booking/car', [FrontendBookingController::class, 'storeCar'])->name('booking.store.car');
Route::get('/booking', [FrontendBookingController::class, 'show'])->name('booking.show');
Route::post('/booking', [FrontendBookingController::class, 'store'])->name('booking.store');


//Thank you 
Route::get('/thankyou', [WelcomeController::class, 'thankyou' ])->name('thankyou');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/cars', CarController::class);
    Route::resource('/coaches', CoachController::class);
    Route::resource('/events', EventController::class);
    Route::resource('/bookings', BookingController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
