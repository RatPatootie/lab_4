<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/grades')->group(function () {
    Route::get('/', [GradeController::class, 'index']);
    Route::get('/student/{studentId}', [GradeController::class, 'getByStudent']);
    Route::get('/course/{courseId}', [GradeController::class, 'getByCourse']);
    Route::post('/', [GradeController::class, 'store']);
    Route::put('/{id}', [GradeController::class, 'update']);
    Route::delete('/{id}', [GradeController::class, 'destroy']);
});
