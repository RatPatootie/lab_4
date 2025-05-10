<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api/teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index']);
    Route::get('/{id}', [TeacherController::class, 'show']);
    Route::post('/', [TeacherController::class, 'store']);
    Route::put('/{id}', [TeacherController::class, 'update']);
    Route::delete('/{id}', [TeacherController::class, 'destroy']);
});
Route::get('/api/',function () {
    return response()->json([
        'message' => 'Welcome to the Teachers Service API'
    ]);
});
