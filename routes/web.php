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

Route::get('/instance', function () {
    $instanceName = file_get_contents(
        'http://metadata.google.internal/computeMetadata/v1/instance/name',
        false,
        stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => 'Metadata-Flavor: Google',
            ],
        ]),
    );

    echo 'Instance Name: ' . htmlspecialchars($instanceName);
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
    Route::get('/instance/name', [DashboardController::class, 'instanceName'])->name(name: 'instance.name');

    // Hotel routes
    Route::get('hotels', [HotelController::class, 'index'])->name('hotels.index');
    Route::get('hotels/create', [HotelController::class, 'create'])->name('hotels.create');
    Route::get('hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
    Route::post('hotels', [HotelController::class, 'store'])->name('hotels.store');
    Route::get('hotels/{id}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
    Route::put('hotels/{id}', [HotelController::class, 'update'])->name('hotels.update');
    Route::delete('hotels/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');

    // Amenity routes with route model binding
    Route::get('amenities', [AmenityController::class, 'index'])->name('amenities.index');
    Route::get('amenities/create', [AmenityController::class, 'create'])->name('amenities.create');
    Route::get('amenities/{amenity}', [AmenityController::class, 'show'])->name('amenities.show');
    Route::post('amenities', [AmenityController::class, 'store'])->name('amenities.store');
    Route::get('amenities/{amenity}/edit', [AmenityController::class, 'edit'])->name('amenities.edit');
    Route::put('amenities/{amenity}', [AmenityController::class, 'update'])->name('amenities.update');
    Route::delete('amenities/{amenity}', [AmenityController::class, 'destroy'])->name('amenities.destroy');

    // Room Type routes
    Route::resource('room-types', RoomTypeController::class);
    // Review routes
    Route::resource('reviews', ReviewController::class);

    // User Profile and Settings routes
    Route::get('profile', [App\Http\Controllers\UserController::class, 'profile'])->name('profile.index');
    Route::get('settings', [App\Http\Controllers\UserController::class, 'settings'])->name('settings.index');
    Route::put('profile', [App\Http\Controllers\UserController::class, 'update'])->name('profile.update');
    Route::post('settings', [App\Http\Controllers\UserController::class, 'updateSettings'])->name('settings.update');

    // Notification routes
    Route::get('notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/mark-as-read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('notifications/mark-all-as-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('notifications/{id}', [App\Http\Controllers\NotificationController::class, 'show'])->name('notifications.show');

    // Search route
    Route::get('search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
});
