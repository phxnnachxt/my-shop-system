<?php

use App\Http\Controllers\CheckOrderController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DrinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;

// เส้นทางหลักให้ redirect ไป login
Route::get('/', function () {
    return redirect()->route('login');
});

// กลุ่ม route ที่ต้อง login ก่อนถึงจะเข้าได้
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('shops.index');
    })->name('dashboard');

    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('drinks', DrinkController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    // web.php
    Route::get('/orders/data', [OrderController::class, 'getOrdersData'])->name('orders.data');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/datatable', [OrderController::class, 'datatable'])->name('orders.datatable');
    Route::resource('orders', OrderController::class)->except(['index']);
    Route::get('/checkorders', function () {
        return view('checkorders.index');
    })->name('checkorders.index');
    Route::get('/checkorders', [CheckOrderController::class, 'index'])->name('checkorders.index');
    Route::get('/checkorders/data', [CheckOrderController::class, 'data'])->name('checkorders.data');
    
});
