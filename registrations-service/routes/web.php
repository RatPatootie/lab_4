<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/registrations')->group(function () {
    Route::get('/', [RegistrationController::class, 'index']);
    Route::get('/student/{studentId}', [RegistrationController::class, 'getByStudent']);
    Route::get('/course/{courseId}', [RegistrationController::class, 'getByCourse']);
    Route::post('/', [RegistrationController::class, 'store']);
    Route::delete('/{id}', [RegistrationController::class, 'destroy']);
});
