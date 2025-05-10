<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return response()->json($grades);
    }

    public function getByStudent($studentId)
    {
        $grades = Grade::where('student_id', $studentId)->get();
        return response()->json($grades);
    }

    public function getByCourse($courseId)
    {
        $grades = Grade::where('course_id', $courseId)->get();
        return response()->json($grades);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
            'teacher_id' => 'required|integer',
            'grade' => 'required|integer|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        // Check if student exists
        $studentResponse = Http::get('http://localhost:8003/api/students/' . $request->student_id);
        if ($studentResponse->status() === 404) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }

        // Check if course exists and get teacher info
        $courseResponse = Http::get('http://localhost:8001/api/courses/' . $request->course_id);
        if ($courseResponse->status() === 404) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }

        // Check if teacher exists
        $teacherResponse = Http::get('http://localhost:8002/api/teachers/' . $request->teacher_id);
        if ($teacherResponse->status() === 404) {
            return response()->json([
                'error' => 'Teacher not found'
            ], 404);
        }

        // Check if teacher is assigned to the course
        $courseData = $courseResponse->json();
        if ($courseData['teacher_id'] != $request->teacher_id) {
            return response()->json([
                'error' => 'This teacher is not assigned to the course'
            ], 400);
        }

        // Check if student is registered for the course
        $registrationResponse = Http::get('http://localhost:8004/api/registrations/student/' . $request->student_id);
        $registrations = $registrationResponse->json();
        
        $isRegistered = false;
        foreach ($registrations as $registration) {
            if ($registration['course_id'] == $request->course_id) {
                $isRegistered = true;
                break;
            }
        }
        
        if (!$isRegistered) {
            return response()->json([
                'error' => 'Student is not registered for this course'
            ], 400);
        }

        // Check if grade already exists
        $existingGrade = Grade::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->first();
            
        if ($existingGrade) {
            return response()->json([
                'error' => 'Grade already exists for this student and course'
            ], 400);
        }

        // Create grade
        $grade = Grade::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'teacher_id' => $request->teacher_id,
            'grade' => $request->grade,
            'graded_date' => now(),
        ]);

        return response()->json($grade, 201);
    }

    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);
        
        if (!$grade) {
            return response()->json([
                'error' => 'Grade not found'
            ], 404);
        }
        
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'integer',
            'grade' => 'integer|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        // If teacher_id is being updated, check if teacher is assigned to the course
        if ($request->has('teacher_id') && $request->teacher_id != $grade->teacher_id) {
            $courseResponse = Http::get('http://localhost:8001/api/courses/' . $grade->course_id);
            $courseData = $courseResponse->json();
            
            if ($courseData['teacher_id'] != $request->teacher_id) {
                return response()->json([
                    'error' => 'This teacher is not assigned to the course'
                ], 400);
            }
        }

        // Update grade
        $grade->fill($request->only(['teacher_id', 'grade']));
        $grade->updated_date = now();
        $grade->save();

        return response()->json($grade);
    }

    public function destroy($id)
    {
        $grade = Grade::find($id);
        
        if (!$grade) {
            return response()->json([
                'error' => 'Grade not found'
            ], 404);
        }
        
        $grade->delete();
        return response()->json([
            'message' => 'Grade deleted successfully'
        ]);
    }
}
