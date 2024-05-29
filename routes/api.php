<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/v1/auth/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/v1/auth/login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/v1/auth/logout', [AuthController::class, 'logout'])->name('user.logout');
});
