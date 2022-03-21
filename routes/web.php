<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [IndexController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home/user', [IndexController::class, 'homeUser'])->name('home.user');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

    Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment');
    Route::post('/payment/user', [PaymentController::class, 'paymentUser'])->name('payment.user');



});

Route::middleware('guest')->group(function () {


    Route::get('/registration', [RegistrationController::class, 'showRegistrationForm'])->name('registration');
    Route::post('/reg/user', [RegistrationController::class, 'regUser'])->name('reg.user');

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login/user', [AuthController::class, 'loginUser'])->name('login.user');

    Route::get('/forgot', [AuthController::class, 'showForgotForm'])->name('forgot');
    Route::post('/forgot/password', [AuthController::class, 'forgotPass'])->name('forgot.password');
});







