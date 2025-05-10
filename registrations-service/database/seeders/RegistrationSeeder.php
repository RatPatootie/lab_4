<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // Студент 1 (Марія) зареєстрована на курси 1, 2, 4
        Registration::create([
            'student_id' => 1,
            'course_id' => 1,
            'registration_date' => Carbon::now()->subDays(30),
        ]);

        Registration::create([
            'student_id' => 1,
            'course_id' => 2,
            'registration_date' => Carbon::now()->subDays(25),
        ]);

        Registration::create([
            'student_id' => 1,
            'course_id' => 4,
            'registration_date' => Carbon::now()->subDays(20),
        ]);

        // Студент 2 (Петро) зареєстрований на курси 1, 3
        Registration::create([
            'student_id' => 2,
            'course_id' => 1,
            'registration_date' => Carbon::now()->subDays(28),
        ]);

        Registration::create([
            'student_id' => 2,
            'course_id' => 3,
            'registration_date' => Carbon::now()->subDays(22),
        ]);

        // Студент 3 (Олена) зареєстрована на курси 2, 4, 5
        Registration::create([
            'student_id' => 3,
            'course_id' => 2,
            'registration_date' => Carbon::now()->subDays(27),
        ]);

        Registration::create([
            'student_id' => 3,
            'course_id' => 4,
            'registration_date' => Carbon::now()->subDays(21),
        ]);

        Registration::create([
            'student_id' => 3,
            'course_id' => 5,
            'registration_date' => Carbon::now()->subDays(15),
        ]);

        // Студент 4 (Віктор) зареєстрований на курси 3, 5
        Registration::create([
            'student_id' => 4,
            'course_id' => 3,
            'registration_date' => Carbon::now()->subDays(26),
        ]);

        Registration::create([
            'student_id' => 4,
            'course_id' => 5,
            'registration_date' => Carbon::now()->subDays(19),
        ]);

        // Студент 5 (Анна) зареєстрована на курси 1, 2, 3, 4
        Registration::create([
            'student_id' => 5,
            'course_id' => 1,
            'registration_date' => Carbon::now()->subDays(29),
        ]);

        Registration::create([
            'student_id' => 5,
            'course_id' => 2,
            'registration_date' => Carbon::now()->subDays(24),
        ]);

        Registration::create([
            'student_id' => 5,
            'course_id' => 3,
            'registration_date' => Carbon::now()->subDays(18),
        ]);

        Registration::create([
            'student_id' => 5,
            'course_id' => 4,
            'registration_date' => Carbon::now()->subDays(12),
        ]);

        // Студент 6 (Максим) зареєстрований на курси 1, 6
        Registration::create([
            'student_id' => 6,
            'course_id' => 1,
            'registration_date' => Carbon::now()->subDays(23),
        ]);

        Registration::create([
            'student_id' => 6,
            'course_id' => 6,
            'registration_date' => Carbon::now()->subDays(17),
        ]);

        // Студент 7 (Юлія) зареєстрована на курси 2, 4, 6
        Registration::create([
            'student_id' => 7,
            'course_id' => 2,
            'registration_date' => Carbon::now()->subDays(22),
        ]);

        Registration::create([
            'student_id' => 7,
            'course_id' => 4,
            'registration_date' => Carbon::now()->subDays(16),
        ]);

        Registration::create([
            'student_id' => 7,
            'course_id' => 6,
            'registration_date' => Carbon::now()->subDays(10),
        ]);

        // Студент 8 (Денис) зареєстрований на курси 3, 5, 6
        Registration::create([
            'student_id' => 8,
            'course_id' => 3,
            'registration_date' => Carbon::now()->subDays(21),
        ]);

        Registration::create([
            'student_id' => 8,
            'course_id' => 5,
            'registration_date' => Carbon::now()->subDays(14),
        ]);

        Registration::create([
            'student_id' => 8,
            'course_id' => 6,
            'registration_date' => Carbon::now()->subDays(8),
        ]);
    }
}