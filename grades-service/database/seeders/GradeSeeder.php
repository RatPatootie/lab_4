<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        // Оцінки для студента 1 (Марія)
        Grade::create([
            'student_id' => 1,
            'course_id' => 1,
            'teacher_id' => 1, // Іван Петрович
            'grade' => 90,
            'graded_date' => Carbon::now()->subDays(10),
            'updated_date' => null,
        ]);

        Grade::create([
            'student_id' => 1,
            'course_id' => 2,
            'teacher_id' => 2, // Марія Сергіївна
            'grade' => 85,
            'graded_date' => Carbon::now()->subDays(8),
            'updated_date' => null,
        ]);

        // Оцінки для студента 2 (Петро)
        Grade::create([
            'student_id' => 2,
            'course_id' => 1,
            'teacher_id' => 1, // Іван Петрович
            'grade' => 78,
            'graded_date' => Carbon::now()->subDays(9),
            'updated_date' => null,
        ]);

        // Оцінки для студента 3 (Олена)
        Grade::create([
            'student_id' => 3,
            'course_id' => 2,
            'teacher_id' => 2, // Марія Сергіївна
            'grade' => 92,
            'graded_date' => Carbon::now()->subDays(7),
            'updated_date' => null,
        ]);

        Grade::create([
            'student_id' => 3,
            'course_id' => 4,
            'teacher_id' => 4, // Наталія Вікторівна
            'grade' => 88,
            'graded_date' => Carbon::now()->subDays(5),
            'updated_date' => null,
        ]);

        // Оцінки для студента 4 (Віктор)
        Grade::create([
            'student_id' => 4,
            'course_id' => 3,
            'teacher_id' => 3, // Олександр Михайлович
            'grade' => 79,
            'graded_date' => Carbon::now()->subDays(6),
            'updated_date' => null,
        ]);

        // Оцінки для студента 5 (Анна)
        Grade::create([
            'student_id' => 5,
            'course_id' => 1,
            'teacher_id' => 1, // Іван Петрович
            'grade' => 95,
            'graded_date' => Carbon::now()->subDays(9),
            'updated_date' => null,
        ]);

        Grade::create([
            'student_id' => 5,
            'course_id' => 2,
            'teacher_id' => 2, // Марія Сергіївна
            'grade' => 91,
            'graded_date' => Carbon::now()->subDays(7),
            'updated_date' => null,
        ]);

        Grade::create([
            'student_id' => 5,
            'course_id' => 3,
            'teacher_id' => 3, // Олександр Михайлович
            'grade' => 87,
            'graded_date' => Carbon::now()->subDays(4),
            'updated_date' => null,
        ]);

        // Оцінки для студента 6 (Максим)
        Grade::create([
            'student_id' => 6,
            'course_id' => 1,
            'teacher_id' => 1, // Іван Петрович
            'grade' => 77,
            'graded_date' => Carbon::now()->subDays(8),
            'updated_date' => Carbon::now()->subDays(2),
        ]);

        // Оцінки для студента 7 (Юлія)
        Grade::create([
            'student_id' => 7,
            'course_id' => 2,
            'teacher_id' => 2, // Марія Сергіївна
            'grade' => 89,
            'graded_date' => Carbon::now()->subDays(6),
            'updated_date' => null,
        ]);

        Grade::create([
            'student_id' => 7,
            'course_id' => 4,
            'teacher_id' => 4, // Наталія Вікторівна
            'grade' => 94,
            'graded_date' => Carbon::now()->subDays(3),
            'updated_date' => null,
        ]);

        // Оцінки для студента 8 (Денис)
        Grade::create([
            'student_id' => 8,
            'course_id' => 3,
            'teacher_id' => 3, // Олександр Михайлович
            'grade' => 82,
            'graded_date' => Carbon::now()->subDays(5),
            'updated_date' => null,
        ]);

        Grade::create([
            'student_id' => 8,
            'course_id' => 5,
            'teacher_id' => 5, // Петро Андрійович
            'grade' => 86,
            'graded_date' => Carbon::now()->subDays(2),
            'updated_date' => null,
        ]);
    }
}