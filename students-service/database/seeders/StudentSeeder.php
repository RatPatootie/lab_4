<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'name' => 'Марія Іванова',
            'email' => 'maria@example.com',
            'year_of_study' => 2,
        ]);

        Student::create([
            'name' => 'Петро Сидоренко',
            'email' => 'petro@example.com',
            'year_of_study' => 1,
        ]);

        Student::create([
            'name' => 'Олена Ковальчук',
            'email' => 'olena@example.com',
            'year_of_study' => 3,
        ]);

        Student::create([
            'name' => 'Віктор Мельник',
            'email' => 'viktor@example.com',
            'year_of_study' => 2,
        ]);

        Student::create([
            'name' => 'Анна Шевченко',
            'email' => 'anna@example.com',
            'year_of_study' => 4,
        ]);

        Student::create([
            'name' => 'Максим Бондаренко',
            'email' => 'maksym@example.com',
            'year_of_study' => 1,
        ]);

        Student::create([
            'name' => 'Юлія Коваленко',
            'email' => 'yulia@example.com',
            'year_of_study' => 3,
        ]);

        Student::create([
            'name' => 'Денис Ткаченко',
            'email' => 'denys@example.com',
            'year_of_study' => 2,
        ]);
    }
}