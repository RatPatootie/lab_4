<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return response()->json([
        'message' => 'Welcome to the Grades API'
    ]);
});
