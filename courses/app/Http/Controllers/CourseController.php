<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function show($id)
    {
        $course = Course::find($id);
        
        if (!$course) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }
        
        return response()->json($course);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'teacher_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        
        if (!$course) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'description' => 'string',
            'teacher_id' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $course->update($request->all());
        return response()->json($course);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        
        if (!$course) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }
        
        $course->delete();
        return response()->json([
            'message' => 'Course deleted successfully'
        ]);
    }
}
