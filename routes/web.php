<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', fn() => view('frontend.home'));
Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::get('/booking', fn() => view('frontend.booking'))->name('booking');


Route::post('/reservation/submit', [ReservationController::class, 'submit'])
     ->name('reservation.submit');