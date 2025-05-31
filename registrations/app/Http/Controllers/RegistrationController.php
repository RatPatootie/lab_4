<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RegistrationController extends Controller
{
    public function index()
    {
        // Cache all registrations for 60 minutes
        $registrations = Cache::remember('all_registrations', 60 * 60, function () {
            return Registration::all();
        });
        
        return response()->json($registrations);
    }

    public function getByStudent($studentId)
    {
        // Cache registrations by student for 30 minutes
        $registrations = Cache::remember('student_registrations_' . $studentId, 30 * 60, function () use ($studentId) {
            return Registration::where('student_id', $studentId)->get();
        });
        
        return response()->json($registrations);
    }

    public function getByCourse($courseId)
    {
        // Cache registrations by course for 30 minutes
        $registrations = Cache::remember('course_registrations_' . $courseId, 30 * 60, function () use ($courseId) {
            return Registration::where('course_id', $courseId)->get();
        });
        
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
        $studentResponse = Http::get('http://students-service/api/students/' . $request->student_id);
        if ($studentResponse->status() === 404) {
            return response()->json([
                'error' => 'Student not found'
            ], 404);
        }

        // Check if course exists
        $courseResponse = Http::get('http://courses-service/api/courses/' . $request->course_id);
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

        // Clear relevant caches
        Cache::forget('all_registrations');
        Cache::forget('student_registrations_' . $request->student_id);
        Cache::forget('course_registrations_' . $request->course_id);

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
        
        // Store values before deletion for cache clearing
        $studentId = $registration->student_id;
        $courseId = $registration->course_id;
        
        $registration->delete();
        
        // Clear relevant caches
        Cache::forget('all_registrations');
        Cache::forget('student_registrations_' . $studentId);
        Cache::forget('course_registrations_' . $courseId);
        
        return response()->json([
            'message' => 'Registration deleted successfully'
        ]);
    }
}