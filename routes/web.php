<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PengaturanController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Login Restoran (custom page, redirect ke login biasa)
Route::get('/restoran/login', function () {
    if (auth()->check() && auth()->user()->role === 'restaurant') {
        return redirect()->route('dashboard');
    }
    return view('auth.login-restoran');
})->name('login.restoran');

Route::middleware('guest')->group(function () {
    Route::get('/restoran/register', [\App\Http\Controllers\Auth\RestaurantAuthController::class, 'create'])->name('register.restoran');
    Route::post('/restoran/register', [\App\Http\Controllers\Auth\RestaurantAuthController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    Route::resource(
        'foods',
        FoodController::class
    );
    Route::match(['get', 'patch'], '/foods/{food}/toggle-status', [FoodController::class, 'toggleStatus'])->name('foods.toggleStatus');

    // Routes sisi Restoran — Order Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Riwayat Transaksi Restoran
    Route::get('/transaksi', [OrderController::class, 'transaksi'])->name('transaksi.index');

    // Pengaturan Restoran
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::patch('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    // Route customer checkout — akan diimplementasi oleh partner
    // Route::post('/foods/{food}/order', [OrderController::class, 'store'])->name('orders.store');

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});

require __DIR__.'/auth.php';