<?php

use Illuminate\Support\Facades\Route;

// Basic authentication routes (Fortify features disabled)
Route::middleware('web')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function () {
        // Basic login logic can be added here
    })->name('login.post');

    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
});
