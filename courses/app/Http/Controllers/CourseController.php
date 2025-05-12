<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    public function index()
    {
        // Cache all courses for 60 minutes
        $courses = Cache::remember('all_courses', 60 * 60, function () {
            return Course::all();
        });
        
        return response()->json($courses);
    }

    public function show($id)
    {
        // Cache individual course for 30 minutes
        $course = Cache::remember('course_' . $id, 30 * 60, function () use ($id) {
            return Course::find($id);
        });
        
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
        
        // Clear cache after creating new course
        Cache::forget('all_courses');
        
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
        
        // Clear cache after updating course
        Cache::forget('all_courses');
        Cache::forget('course_' . $id);
        
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
        
        // Clear cache after deleting course
        Cache::forget('all_courses');
        Cache::forget('course_' . $id);
        
        return response()->json([
            'message' => 'Course deleted successfully'
        ]);
    }
}