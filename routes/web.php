<?php

use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::get('stock', [StockController::class, 'index'])->name('stock');
    Route::get('products-stock', [StockController::class, 'productStock'])->name('products-stock');
    Route::get('create-stock', [StockController::class, 'create'])->name('create-stock');

    Route::get('create-sale', [SaleController::class, 'create'])->name('create-sale');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
