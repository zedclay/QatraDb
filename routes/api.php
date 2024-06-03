<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
use App\Http\Controllers\Auth\DonorAuthController;
use App\Http\Controllers\Auth\HospitalAuthController;
use App\Http\Controllers\Auth\RegisterController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::post('donor/register', [DonorAuthController::class, 'register']);
Route::post('donor/login', [DonorAuthController::class, 'login']);
Route::post('donor/logout', [DonorAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('hospital/register', [HospitalAuthController::class, 'register']);
Route::post('hospital/login', [HospitalAuthController::class, 'login']);
Route::post('hospital/logout', [HospitalAuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/donor-profile', function (Request $request) {
        return $request->user();
    });

    Route::get('/hospital-profile', function (Request $request) {
        return $request->user();
    });
});
