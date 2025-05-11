<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::all();
        return response()->json($registrations);
    }

    public function getByStudent($studentId)
    {
        $registrations = Registration::where('student_id', $studentId)->get();
        return response()->json($registrations);
    }

    public function getByCourse($courseId)
    {
        $registrations = Registration::where('course_id', $courseId)->get();
        return response()->json($registrations);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
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

        // Check if course exists
        $courseResponse = Http::get('http://localhost:8001/api/courses/' . $request->course_id);
        if ($courseResponse->status() === 404) {
            return response()->json([
                'error' => 'Course not found'
            ], 404);
        }

        // Check if registration already exists
        $existingRegistration = Registration::where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->first();
            
        if ($existingRegistration) {
            return response()->json([
                'error' => 'Student is already registered for this course'
            ], 400);
        }

        // Create registration
        $registration = Registration::create([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
            'registration_date' => now(),
        ]);

        return response()->json($registration, 201);
    }

    public function destroy($id)
    {
        $registration = Registration::find($id);
        
        if (!$registration) {
            return response()->json([
                'error' => 'Registration not found'
            ], 404);
        }
        
        $registration->delete();
        return response()->json([
            'message' => 'Registration deleted successfully'
        ]);
    }
}
