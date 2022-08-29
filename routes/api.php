<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// complete usage of resource
Route::apiResource('users', UserController::class);

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
