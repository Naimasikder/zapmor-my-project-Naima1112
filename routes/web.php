<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/register', [AuthController::class, 'register']);


Route::post('/logout', [AuthController::class, 'logout']);


Route::get('/book-now', function () {
    return view('book-now');
})->middleware('auth')->name('book.now');


Route::post('/appointments', [AppointmentController::class, 'store'])
    ->middleware('auth');

Route::patch(
    '/appointments/{appointment}/status',
    [AppointmentController::class, 'updateStatus']
)->middleware('auth');

Route::get('/doctors', [AppointmentController::class, 'doctors']);

