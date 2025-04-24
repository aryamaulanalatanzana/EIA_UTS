<?php

use Illuminate\Support\Facades\Route;
// routes/web.php

use App\Http\Controllers\FrontendOrderController;
use App\Http\Controllers\FrontendPaymentController;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/', function () {
    return redirect('/dashboard');
});


Route::get('/orders', [FrontendOrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [FrontendOrderController::class, 'store'])->name('orders.store');
Route::put('/orders/{id}', [FrontendOrderController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [FrontendOrderController::class, 'destroy'])->name('orders.destroy');


Route::get('/orders/create', [FrontendOrderController::class, 'create']);
Route::post('/orders/store', [FrontendOrderController::class, 'store']); // store disesuaikan

Route::get('/orders', [FrontendOrderController::class, 'index'])->name('orders.index');


Route::get('/orders/{orderId}/user', [FrontendOrderController::class, 'getUser']);
Route::get('/orders/{orderId}/product', [FrontendOrderController::class, 'getProduct']);
Route::get('/users', [FrontendOrderController::class, 'getAllUsers']);   // Get all users
Route::get('/products', [FrontendOrderController::class, 'getAllProducts']); // Get all products

Route::get('/payments', [FrontendPaymentController::class, 'index'])->name('payments.index');
Route::post('/payments', [FrontendPaymentController::class, 'store'])->name('payments.store');
