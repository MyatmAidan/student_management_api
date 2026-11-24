<?php

use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Classes Routes
|--------------------------------------------------------------------------
*/
Route::prefix('classes')->group(function () {
    Route::get('', [ClassController::class, 'index']);
    Route::post('', [ClassController::class, 'store']);
    Route::get('{id}', [ClassController::class, 'show']);
    Route::put('{id}', [ClassController::class, 'update']);
    Route::delete('{id}', [ClassController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Students Routes
|--------------------------------------------------------------------------
*/
Route::prefix('students')->group(function () {
    Route::get('', [StudentController::class, 'index']);
    Route::post('', [StudentController::class, 'store']);
    Route::get('{id}', [StudentController::class, 'show']);
    Route::put('{id}', [StudentController::class, 'update']);
    Route::delete('{id}', [StudentController::class, 'destroy']);
});
