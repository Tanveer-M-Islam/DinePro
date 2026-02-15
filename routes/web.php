<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [\App\Http\Controllers\Public\MenuController::class, 'index'])->name('menu.index');
Route::get('/contact', [\App\Http\Controllers\Public\ContactController::class, 'index'])->name('contact.index');
Route::get('/book-table', [\App\Http\Controllers\Public\BookTableController::class, 'index'])->name('book-table.index');
Route::post('/reservation', [\App\Http\Controllers\Public\ReservationController::class, 'store'])->name('reservation.store');
Route::post('/reviews', [\App\Http\Controllers\Public\ReviewController::class, 'store'])->name('reviews.store');

Route::get('/announcement', function () {
    $settings = \App\Models\WebsiteSetting::first();
    if (!$settings || empty($settings->announcement)) {
        return redirect()->route('home');
    }
    return view('public.announcement', compact('settings'));
})->name('announcement');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('menu-items', \App\Http\Controllers\Admin\MenuItemController::class);
        Route::get('orders/{order}/invoice', [\App\Http\Controllers\Admin\OrderController::class, 'downloadInvoice'])->name('orders.invoice');
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::resource('reservations', \App\Http\Controllers\Admin\ReservationController::class)->only(['index', 'update', 'destroy']);
        Route::resource('reviews', \App\Http\Controllers\Admin\CustomerReviewController::class);
        Route::get('themes', [\App\Http\Controllers\Admin\ThemeController::class, 'index'])->name('themes.index');
        Route::post('themes', [\App\Http\Controllers\Admin\ThemeController::class, 'update'])->name('themes.update');
        Route::get('settings', [\App\Http\Controllers\Admin\WebsiteSettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [\App\Http\Controllers\Admin\WebsiteSettingController::class, 'update'])->name('settings.update');
        Route::delete('settings/image/{type}', [\App\Http\Controllers\Admin\WebsiteSettingController::class, 'deleteImage'])->name('settings.delete-image');
    });
});
