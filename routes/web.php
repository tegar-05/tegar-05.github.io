<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\Admin\OrderController;


// ==============================
// PUBLIC ROUTES (Customer)
// ==============================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [HomeController::class, 'menu'])->name('menu');
Route::get('/florist', [HomeController::class, 'florist'])->name('florist');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Reservation
Route::get('/reservation', [HomeController::class, 'reservation'])->name('reservation');
Route::post('/reservation/submit', [ReservationController::class, 'submit'])->middleware('throttle:5,1')->name('reservation.submit');

// Order
Route::get('/order', [HomeController::class, 'order'])->name('order');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

// Payment
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::post('/payment/notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');


// ==============================
// USER AUTH ROUTES (Breeze)
// ==============================

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ==============================
// ADMIN AUTH (Login / Logout)
// ==============================

Route::get('/admin/login', [AdminAuthController::class, 'loginPage'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->middleware('throttle:3,1')->name('admin.login.post');
Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ==============================
// ADMIN (Protected Routes)
// ==============================

Route::middleware(['admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/orders-export-csv', [OrderController::class, 'exportCsv'])->name('orders.exportCsv');
        Route::get('/orders-export-xlsx', [OrderController::class, 'exportXlsx'])->name('orders.exportXlsx');

        // MENU MANAGEMENT
        Route::resource('menus', App\Http\Controllers\Admin\AdminMenuController::class);
        Route::get('menus-export', [App\Http\Controllers\Admin\AdminMenuController::class, 'export'])->name('menus.export');

        // PRODUCT MANAGEMENT
        Route::resource('products', App\Http\Controllers\Admin\AdminProductController::class);
        Route::get('products-export', [App\Http\Controllers\Admin\AdminProductController::class, 'export'])->name('products.export');

        // FLORIST MANAGEMENT
        Route::resource('florists', App\Http\Controllers\Admin\AdminFloristController::class);
        Route::get('florists-export', [App\Http\Controllers\Admin\AdminFloristController::class, 'export'])->name('florists.export');

        // CATEGORY MANAGEMENT
        Route::resource('categories', App\Http\Controllers\Admin\AdminCategoryController::class);
        Route::get('categories-export', [App\Http\Controllers\Admin\AdminCategoryController::class, 'export'])->name('categories.export');

        // SLIDER MANAGEMENT
        Route::resource('sliders', App\Http\Controllers\Admin\AdminSliderController::class);
        Route::post('sliders-update-order', [App\Http\Controllers\Admin\AdminSliderController::class, 'updateOrder'])->name('sliders.updateOrder');
        Route::get('sliders-export', [App\Http\Controllers\Admin\AdminSliderController::class, 'export'])->name('sliders.export');

    });
