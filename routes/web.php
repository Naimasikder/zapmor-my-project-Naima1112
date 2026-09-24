<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Login
Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Register
Route::post('/register', [AuthController::class, 'register']);

// Logout
Route::post('/logout', [AuthController::class, 'logout']);

// Book Now page
Route::get('/book-now', function () {
    return view('book-now');
})->name('book.now');

// Appointment booking
Route::post('/appointments', [AppointmentController::class, 'store'])
    ->middleware('auth')
    ->name('booking.store');

// Appointment list
Route::get('/appointments', [AppointmentController::class, 'index'])
    ->middleware('auth')
    ->name('appointments.index');

// Update appointment status
Route::patch(
    '/appointments/{appointment}/status',
    [AppointmentController::class, 'updateStatus']
)->middleware('auth')
  ->name('appointments.updateStatus');

// Delete appointment
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])
    ->middleware('auth')
    ->name('appointments.destroy');

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
