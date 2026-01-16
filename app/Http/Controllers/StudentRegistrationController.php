<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'admission_number' => 'required|string|max:255|unique:students,admission_number',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'student_class' => 'required|string',
            'blood_group' => 'nullable|string|max:5',
            'student_email' => 'required|email|max:255|unique:students,student_email',
            'password' => 'required|string|min:8|confirmed',

            'parent1_name' => 'required|string|max:255',
            'parent1_phone' => 'required|string|max:20',
            'parent1_email' => 'required|email|max:255',

            'parent2_name' => 'nullable|string|max:255',
            'parent2_phone' => 'nullable|string|max:20',

            'address' => 'required|string',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'medical_notes' => 'nullable|string',

            'terms_agreed' => 'accepted',
        ]);

        DB::beginTransaction();
        try {
            $validated['password'] = Hash::make($validated['password']);
            $validated['academic_status'] = 'active';

            Student::create($validated);
            DB::commit();

            return redirect()
                ->route('student.login')
                ->with('success', 'Registration successful! You can now log in.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}
