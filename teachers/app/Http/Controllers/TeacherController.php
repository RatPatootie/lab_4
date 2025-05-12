<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class TeacherController extends Controller
{
    public function index()
    {
        // Cache all teachers for 60 minutes
        $teachers = Cache::remember('all_teachers', 60 * 60, function () {
            return Teacher::all();
        });
        
        return response()->json($teachers);
    }

    public function show($id)
    {
        // Cache individual teacher for 30 minutes
        $teacher = Cache::remember('teacher_' . $id, 30 * 60, function () use ($id) {
            return Teacher::find($id);
        });
        
        if (!$teacher) {
            return response()->json([
                'error' => 'Teacher not found'
            ], 404);
        }
        
        return response()->json($teacher);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'specialization' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $teacher = Teacher::create($request->all());
        
        // Clear cache after creating new teacher
        Cache::forget('all_teachers');
        
        return response()->json($teacher, 201);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        
        if (!$teacher) {
            return response()->json([
                'error' => 'Teacher not found'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'email|unique:teachers,email,'.$id,
            'specialization' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $teacher->update($request->all());
        
        // Clear cache after updating teacher
        Cache::forget('all_teachers');
        Cache::forget('teacher_' . $id);
        
        return response()->json($teacher);
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        
        if (!$teacher) {
            return response()->json([
                'error' => 'Teacher not found'
            ], 404);
        }
        
        $teacher->delete();
        
        // Clear cache after deleting teacher
        Cache::forget('all_teachers');
        Cache::forget('teacher_' . $id);
        
        return response()->json([
            'message' => 'Teacher deleted successfully'
        ]);
    }
}