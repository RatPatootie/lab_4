<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {   
        $start = microtime(true);
        // Cache all students for 60 minutes
        $students = Cache::remember('all_students', 60 * 60, function () {
            return Student::all();
        });
        $response=response()->json($students);

        $duration = round((microtime(true) - $start) * 1000, 2); // мс
        Log::info("Response time: {$duration} ms");
        
        return  $response;
    }

    public function show($id)
    {
        // Cache individual student for 30 minutes
        $student = Cache::remember('student_' . $id, 30 * 60, function () use ($id) {
            return Student::find($id);
        });
        
        if (!$student) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }
        
        return response()->json($student);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'year_of_study' => 'required|integer|min:1|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $student = Student::create($request->all());
        
        // Clear the all_students cache when a new student is created
        Cache::forget('all_students');
        
        return response()->json($student, 201);
    }

    public function update(Request $request, $id)
    {   
        $student = Student::find($id);
        
        if (!$student) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'email|unique:students,email,'.$id,
            'year_of_study' => 'integer|min:1|max:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $student->update($request->all());
        
        // Clear caches for this student and all students list
        Cache::forget('student_' . $id);
        Cache::forget('all_students');
        
        return response()->json($student);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        
        if (!$student) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }
        
        $student->delete();
        
        // Clear caches for this student and all students list
        Cache::forget('student_' . $id);
        Cache::forget('all_students');
        
        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }
}