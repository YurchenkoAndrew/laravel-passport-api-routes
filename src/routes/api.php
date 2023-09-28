<?php

use Illuminate\Support\Facades\Route;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth\LoginController;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth\NewPasswordController;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth\PasswordResetLinkController;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth\RegisterController;
use YurchenkoAndrew\LaravelPassportAPIRoutes\Http\Controllers\Auth\RegisterVerificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('api')->group(function () {
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);

    Route::get('email/verify/{id}', [RegisterVerificationController::class, 'verify'])->name('verification.verify');
    Route::get('email/resend', [RegisterVerificationController::class, 'resend'])->name('verification.resend');

//Сброс пароля
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->middleware('guest')
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->middleware('guest')
        ->name('password.update');
});
