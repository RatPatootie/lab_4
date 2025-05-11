<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        Teacher::create([
            'name' => 'Іван Петрович',
            'email' => 'ivan@university.edu',
            'specialization' => 'Програмування',
        ]);

        Teacher::create([
            'name' => 'Марія Сергіївна',
            'email' => 'maria@university.edu',
            'specialization' => 'Математика',
        ]);

        Teacher::create([
            'name' => 'Олександр Михайлович',
            'email' => 'alex@university.edu',
            'specialization' => 'Бази даних',
        ]);

        Teacher::create([
            'name' => 'Наталія Вікторівна',
            'email' => 'natalia@university.edu',
            'specialization' => 'Веб-розробка',
        ]);

        Teacher::create([
            'name' => 'Петро Андрійович',
            'email' => 'petro@university.edu',
            'specialization' => 'Мережеві технології',
        ]);
    }
}