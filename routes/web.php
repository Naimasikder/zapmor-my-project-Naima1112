<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AppointmentController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/book-now', function () {

    $services = \App\Models\Service::all();

    $parlors = \App\Models\Parlor::with('services')
        ->where('availability_status', true)
        ->get();

    return view('book-now', compact('services', 'parlors'));

})->name('book.now');

Route::post('/book-now', [BookingController::class, 'store'])
    ->name('booking.store');

// Customer search route
Route::get('/search-customer', [BookingController::class, 'searchCustomer'])
    ->name('customer.search');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');

Route::get('/appointments', [AppointmentController::class, 'index'])
    ->name('appointments.index');

Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])
    ->name('appointments.destroy');