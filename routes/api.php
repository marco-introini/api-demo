<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\JWTAuthController;
use App\Http\Controllers\JWTController;

// FIRST: USE APICONTROLLER
// complete usage of resource
Route::apiResource('users', UserController::class);


// SECOND: ROUTE SINGLE METHODS
// it's possible to fine tune endpoints in this way:
Route::prefix('users2')
    ->name('users2')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/', [UserController::class, 'delete'])->name('delete');
    });

// THIRD: USE SANCTUM
Route::prefix('sanctum')->group(function () {
    // registration and login
    Route::controller(RegisterController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
    });

    // get current user info
    Route::get('user', function (Request $request) {
        // user is taken from the bearer token
        return $request->user();
    })->middleware('auth:sanctum')->name('sanctum-user');
    Route::get('users', [UserController::class, 'index'])->middleware('auth:sanctum');
});

// FORTH: USE JWTController
Route::prefix('jwt')->group(function () {
    Route::post('login', JWTAuthController::class)->name('jwt.login');

    Route::get('check', JWTController::class)->name('jwt.check');
});





