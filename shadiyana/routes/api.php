<?php

// use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Route::prefix('auth')->group(function () {

//     /*
//     |--------------------------------------------------------------------------
//     | Public Authentication Routes
//     |--------------------------------------------------------------------------
//     */

//     Route::post('/register', [AuthController::class, 'register'])
//         ->name('auth.register');

//     Route::post('/login', [AuthController::class, 'login'])
//         ->name('auth.login');


//     /*
//     |--------------------------------------------------------------------------
//     | Protected Authentication Routes
//     |--------------------------------------------------------------------------
//     */

//    Route::middleware('auth:sanctum')->group(function () {

//     Route::post('/logout', [AuthController::class, 'logout'])
//         ->name('auth.logout');

//     Route::get('/profile', [AuthController::class, 'profile'])
//         ->name('auth.profile');

//     Route::post('/change-password', [AuthController::class, 'changePassword'])
//         ->name('auth.change-password');
// });
// });