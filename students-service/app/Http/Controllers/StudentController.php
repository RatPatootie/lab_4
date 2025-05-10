<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function show($id)
    {
        $student = Student::find($id);
        
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
        return response()->json([
            'message' => 'Student deleted successfully'
        ]);
    }
}
