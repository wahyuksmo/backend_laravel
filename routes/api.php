<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
  
    Route::middleware('checkApiToken')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});


Route::prefix('todo')->middleware('checkApiToken')->group(function () {
    Route::get('/search', [TodoController::class, 'index']);
    Route::post('/add', [TodoController::class, 'store']);
});


