<?php

use App\Http\Controllers\User\HistoryDepositController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DepositTrashController;
use App\Http\Controllers\User\ProfileController;
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

Route::get('/v1/auth', [AuthController::class, 'redirectAuth'])->name('user.redirect.google');
Route::get("/v1/auth/callback", [AuthController::class, "handleAuthGoogle"])->name("user.auth.google");

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/v1/auth/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::post('/v1/deposit/trash', [DepositTrashController::class, 'depositTrash'])->name('deposit.trash');
    Route::get('/v1/waste-bank', [DepositTrashController::class, 'getWasteBank'])->name('get.waste.bank');
    Route::get('/v1/waste-bank/trash', [DepositTrashController::class, 'getWasteType'])->name('get.waste.type');
    Route::get('/v1/deposit/trash/history', [HistoryDepositController::class, 'getHistory'])->name('get.history.deposit');
    Route::get('/v1/deposit/trash/history/{transactionId}', [HistoryDepositController::class, 'getDetailHistory'])->name('get.history.deposit.detail');
    Route::post('/v1/exchange', [DepositTrashController::class, 'exchange'])->name('exchange');
    Route::get('/v1/waste-bank/exchange', [DepositTrashController::class, 'getExchangeType'])->name('get.exchange.type');
    Route::get('/v1/exchange/history', [HistoryDepositController::class, 'getExchangeHistory'])->name('get.history.exchange');
    Route::get('/v1/exchange/history/{transactionId}', [HistoryDepositController::class, 'getExchangeDetailHistory'])->name('get.history.exchange.detail');
    Route::get('/v1/profile', [ProfileController::class, 'getProfileUser'])->name('user.profile');
    Route::get('/v1/profile/wallet', [ProfileController::class, 'getBalanceUser'])->name('user.balance');
});
