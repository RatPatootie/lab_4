<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create([
            'name' => 'Програмування на PHP',
            'description' => 'Вивчення основ PHP та Laravel фреймворку',
            'teacher_id' => 1, // Іван Петрович
        ]);

        Course::create([
            'name' => 'Вища математика',
            'description' => 'Курс з основ вищої математики для програмістів',
            'teacher_id' => 2, // Марія Сергіївна
        ]);

        Course::create([
            'name' => 'Бази даних та SQL',
            'description' => 'Проектування баз даних та робота з SQL',
            'teacher_id' => 3, // Олександр Михайлович
        ]);

        Course::create([
            'name' => 'Веб-розробка на JavaScript',
            'description' => 'Вивчення сучасних фреймворків JavaScript для веб-розробки',
            'teacher_id' => 4, // Наталія Вікторівна
        ]);

        Course::create([
            'name' => "Комп'ютерні мережі",
            'description' => "Основи побудови та адміністрування комп'ютерних мереж",
            'teacher_id' => 5, // Петро Андрійович
        ]);

        Course::create([
            'name' => 'Розробка мобільних додатків',
            'description' => 'Створення додатків для iOS та Android',
            'teacher_id' => 1, // Іван Петрович
        ]);
    }
}