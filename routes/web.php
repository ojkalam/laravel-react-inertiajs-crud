<?php

use App\Http\Controllers\AmenityController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes using sanctum auth
Route::group(['middleware' => ['auth']], function () {
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Hotel routes
    Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
    Route::get('hotels/create', [HotelController::class, 'create'])->name('hotels.create');
    Route::post('hotels', [HotelController::class, 'store'])->name('hotels.store');
    Route::get('hotels/{id}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
    Route::put('hotels/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('hotels/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');

    // Amenity routes with route model binding
    Route::get('amenities', [AmenityController::class, 'index'])->name('amenities.index');
    Route::get('amenities/{amenity}', [AmenityController::class, 'show'])->name('amenities.show');
    Route::get('amenities', [AmenityController::class, 'create'])->name('amenities.create');
    Route::post('amenities', [AmenityController::class, 'store'])->name('amenities.store');
    Route::get('amenities/{amenity}/edit', [AmenityController::class, 'edit'])->name('amenities.edit');
    Route::put('amenities/{amenity}', [AmenityController::class, 'update'])->name('amenities.update');
    Route::delete('amenities/{amenity}', [AmenityController::class, 'destroy'])->name('amenities.destroy');

// Room Type routes
    Route::resource('room-types', RoomTypeController::class);
// Review routes
    Route::resource('reviews', ReviewController::class);
});
