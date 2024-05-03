<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('pages.auth.auth-login');
});Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard',['type_menu' => 'dashboard']);
    })->name('home');

    Route::resource('users', UserController::class);
    //doctors
    // Route::resource('doctors', DoctorController::class);
});