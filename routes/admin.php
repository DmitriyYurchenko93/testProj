<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OperationController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\ImportController;

Route::middleware('guest:admin')->group(function() {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login/process', [AuthController::class, 'loginAdmin'])->name('login.process');
});

Route::middleware('auth:admin')->group(function() {
    Route::get('logout', [AuthController::class, 'logoutAdmin'])->name('logout');
    Route::resource('users', UserController::class);
    Route::resource('operations', OperationController::class);
    Route::get('payment', [AdminPaymentController::class, 'showPaymentForm'])->name('payment');
    Route::post('payment/process', [AdminPaymentController::class, 'paymentAdmin'])->name('payment.process');
    Route::post('import/excel', [ImportController::class, 'importExcel'])->name('import.excel');
});








