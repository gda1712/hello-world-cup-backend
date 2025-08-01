<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\UserController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);




Route::middleware(['auth:sanctum'])->group(function () {
    // Users
    Route::get('/user', [AuthController::class, 'getUserInfo']);
    Route::get('/users', [UserController::class, 'index']);

    Route::post('/follow', [UserFollowController::class, 'addUserFollow']);
});
