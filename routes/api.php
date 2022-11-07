<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RegisterController;

// FIRST: USE APICONTROLLER
// complete usage of resource
Route::apiResource('users', UserController::class);


// SECOND: ROUTE SINGLE METHODS
// it's possible to fine tune endpoints in this way:
Route::prefix('users2')
    ->name('users2')
    ->group(function() {
        Route::get('/',[UserController::class,'index'])->name('index');
        Route::post('/',[UserController::class,'store'])->name('store');
        Route::get('/{user}',[UserController::class,'show'])->name('show');
        Route::put('/{user}',[UserController::class,'update'])->name('update');
        Route::delete('/',[UserController::class,'delete'])->name('delete');
    });

// THIRD: USE SANCTUM
// registration
Route::controller(RegisterController::class)->group(function(){
    Route::post('sanctum/register', 'register');
    Route::post('sanctum/login', 'login');
});

// usage
Route::middleware('auth:sanctum')->get('/sanctum/user', function (Request $request) {
    // user is taken from the bearer token
    return $request->user();
});

