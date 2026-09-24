<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AdminAppointmentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Register
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Book Now page
Route::get('/book-now', function () {
    return view('book-now');
})
    ->middleware('auth')
    ->name('book.now');

// Appointment booking
Route::post('/appointments', [AppointmentController::class, 'store'])
    ->middleware('auth')
    ->name('booking.store');

// Appointment list
Route::get('/appointments', [AppointmentController::class, 'index'])
    ->middleware('auth')
    ->name('appointments.index');

// Cancel appointment
Route::patch(
    '/appointments/{appointment}/status',
    [AppointmentController::class, 'updateStatus']
)
    ->middleware('auth')
    ->name('appointments.updateStatus');

// Doctors
Route::get('/doctors', [AppointmentController::class, 'doctors'])
    ->middleware('auth')
    ->name('appointments.doctors');

// Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

    Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get(
            '/appointments',
            [AdminAppointmentController::class, 'index']
        )->name('admin.appointments.index');

        Route::patch(
            '/appointments/{appointment}/status',
            [AdminAppointmentController::class, 'updateStatus']
        )->name('admin.appointments.updateStatus');
    });