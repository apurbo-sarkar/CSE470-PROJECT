<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student Registration Form</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                background: #eef1f5;
                margin: 0;
                padding: 10px; 
                display: flex; 
                justify-content: center;
                align-items: center;
                min-height: 100vh; 
            }

            .container {
                max-width: 650px; 
                background: #fff;
                padding: 20px; 
                margin: 10px auto; 
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
                width: 95%; 
                max-height: 90vh; 
                overflow-y: auto; 
            }

            h2 {
                text-align: center;
                margin-bottom: 15px; 
                font-size: 20px; 
                color: #333;
            }

            h3 {
                margin-top: 20px; 
                margin-bottom: 8px; 
                color: #4285f4;
                border-bottom: 1px solid #eef1f5;
                padding-bottom: 4px;
                font-size: 16px; 
            }

            .grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); 
                gap: 10px; 
                margin-bottom: 10px; 
            }

            .input-box {
                display: flex;
                flex-direction: column;
            }

            label {
                font-weight: 600;
                margin-bottom: 3px; 
                color: #555;
                font-size: 13px; 
            }

            .checkbox-label {
                display: flex;
                align-items: center;
                font-weight: normal; 
                color: #333;
                margin-bottom: 0;
                font-size: 13px; 
                margin-top: 15px; 
            }

            .checkbox-label input[type="checkbox"] {
                width: auto; 
                margin-right: 8px; 
            }

            input, select, textarea {
                width: 100%;
                padding: 7px; 
                border: 1px solid #bbb;
                border-radius: 4px; 
                box-sizing: border-box; 
                font-size: 13px; 
            }

            textarea {
                resize: none;
                height: 50px; 
            }

            input:focus, select:focus, textarea:focus {
                border-color: #4285f4;
                box-shadow: 0 0 3px rgba(66,133,244,0.4); 
                outline: none; 
            }

            button {
                width: 100%;
                padding: 10px; 
                background: #4285f4;
                color: white;
                border: none;
                border-radius: 4px; 
                font-size: 14px; 
                cursor: pointer;
                margin-top: 15px; 
                letter-spacing: 0.3px;
                transition: 0.2s ease-in-out;
            }

            button:hover {
                background: #3274d6;
            }

            .login-link {
                margin-top: 10px; 
                text-align: center;
                font-size: 13px; 
            }

            .login-link a {
                color: #4285f4;
                text-decoration: none;
                font-weight: 600;
            }

            .login-link a:hover {
                text-decoration: underline;
            }
            .error-message {
                color: #d9534f;
                font-size: 11px;
                margin-top: 3px;
                display: block;
            }
        </style>
    </head>
    
<body>

    <div class="container">
        <h2>Student Registration Form</h2>

        <form action="{{ route('student.register.store') }}" method="POST" id="registrationForm">
            @csrf

            <h3>Student Details</h3>

            <div class="grid">
                <div class="input-box">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required value="{{ old('full_name') }}">
                    @error('full_name')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="input-box">
                    <label for="admission_number">Admission Number</label>
                    <input type="text" id="admission_number" name="admission_number" value="{{ old('admission_number') }}">
                    @error('admission_number')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="grid">
                <div class="input-box">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" required value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="input-box">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">-- Select Gender --</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="grid">
                <div class="input-box">
                    <label for="student_class">Class/Grade</label>
                    <select id="student_class" name="student_class" required>
                        <option value="">Select Grade</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="Grade {{ $i }}" {{ old('student_class') == 'Grade '.$i ? 'selected' : '' }}>
                                Grade {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('student_class')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="input-box">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="grid">
                <div class="input-box" style="grid-column: 1 / 3;">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>

            <div class="grid">
                <div class="input-box">
                    <label for="blood_group">Blood Group (e.g. A+)</label>
                    <input type="text" id="blood_group" name="blood_group" value="{{ old('blood_group') }}">
                    @error('blood_group')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="input-box">
                    <label for="student_email">Student Email</label>
                    <input type="email" id="student_email" name="student_email" value="{{ old('student_email') }}">
                    @error('student_email')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <h3>Parent/Guardian 1 (Primary)</h3>

            <div class="grid">
                <div class="input-box">
                    <label for="parent1_name">Full Name</label>
                    <input type="text" id="parent1_name" name="parent1_name" required value="{{ old('parent1_name') }}">
                    @error('parent1_name')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="input-box">
                    <label for="parent1_phone">Phone Number</label>
                    <input type="tel" id="parent1_phone" name="parent1_phone" required value="{{ old('parent1_phone') }}">
                    @error('parent1_phone')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="input-box" style="grid-column: 1 / 3;">
                    <label for="parent1_email">Email</label>
                    <input type="email" id="parent1_email" name="parent1_email" required value="{{ old('parent1_email') }}">
                    @error('parent1_email')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <h3>Parent/Guardian 2 (Secondary)</h3>

            <div class="grid">
                <div class="input-box">
                    <label for="parent2_name">Full Name (Optional)</label>
                    <input type="text" id="parent2_name" name="parent2_name" value="{{ old('parent2_name') }}">
                    @error('parent2_name')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="input-box">
                    <label for="parent2_phone">Phone Number (Optional)</label>
                    <input type="tel" id="parent2_phone" name="parent2_phone" value="{{ old('parent2_phone') }}">
                    @error('parent2_phone')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <h3>Address & Medical Information</h3>

            <div class="grid">
                <div class="input-box" style="grid-column: 1 / 3;">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" required>{{ old('address') }}</textarea>
                    @error('address')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="grid">
                <div class="input-box">
                    <label for="emergency_contact_name">Emergency Contact Name</label>
                    <input type="text" id="emergency_contact_name" name="emergency_contact_name" required value="{{ old('emergency_contact_name') }}">
                    @error('emergency_contact_name')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div class="input-box">
                    <label for="emergency_contact_phone">Emergency Contact Phone</label>
                    <input type="tel" id="emergency_contact_phone" name="emergency_contact_phone" required value="{{ old('emergency_contact_phone') }}">
                    @error('emergency_contact_phone')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="grid">
                <div class="input-box" style="grid-column: 1 / 3;">
                    <label for="medical_notes">Medical Notes / Allergies (Optional)</label>
                    <textarea id="medical_notes" name="medical_notes">{{ old('medical_notes') }}</textarea>
                    @error('medical_notes')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="input-box">
                <label class="checkbox-label">
                    <input type="checkbox" name="terms_agreed" value="1" {{ old('terms_agreed') ? 'checked' : '' }} required>
                    I agree to the terms and conditions.
                </label>
                @error('terms_agreed')<span class="error-message">{{ $message }}</span>@enderror
            </div>

            <button type="submit">Register Student</button>

            <div class="login-link">
                Already registered? <a href="{{ route('student.login') }}">Log In here</a>
            </div>

        </form>
    </div>

</body>


</html>
