<?php

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


Route::get('/',function () {
    return response()->json([
        'message' => 'Welcome to the Teachers Service API'
    ]);
});
