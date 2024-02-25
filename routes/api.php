<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\UserController;
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

Route::group(['prefix' => 'v1'], function () {
    # Auth
    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/me', [AuthController::class, 'userProfile']);
    });
    # End

    # User management
    Route::group([
        'prefix' => 'user',
        'middleware' => 'be.auth.role:admin'
    ], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('detail/{id}', [UserController::class, 'show']);
        Route::put('/edit/{id}', [UserController::class, 'update']);
        Route::delete('/delete/{id}', [UserController::class, 'destroy']);
    });
    # End user management

    # Room management
    Route::group([
        'prefix' => 'room',
        'middleware' => 'auth'
    ], function () {
        Route::get('/', [RoomController::class, 'index']);
        Route::post('/create', [RoomController::class, 'store'])->middleware('be.auth.role:admin');
        Route::get('detail/{id}', [RoomController::class, 'show']);
        Route::put('/edit/{id}', [RoomController::class, 'update'])->middleware('be.auth.role:admin');
        Route::delete('/delete/{id}', [RoomController::class, 'destroy'])->middleware('be.auth.role:admin');
    });
    # End room management

});
