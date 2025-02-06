<?php

use App\Http\Controllers\StatisticsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('logout', [UserController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'role:seller|admin'])->group(function () {
    Route::get('/dashboard', [ProductController::class, 'dashboard']);

    Route::post('/products', [ProductController::class, 'store']);
    Route::post('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    Route::get('/statistics', [StatisticsController::class, 'filteredStatistics']);
    Route::get('/statistics/general', [StatisticsController::class, 'generalStatistics']);
    Route::get('/statistics/by-type', [StatisticsController::class, 'byTypeStatistics']);
    Route::get('/statistics/by-user', [StatisticsController::class, 'byUserStatistics']);
    Route::get('/statistics/top-users', [StatisticsController::class, 'topUsersStatistics']);
});

