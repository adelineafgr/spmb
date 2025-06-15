<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil seeder yang Anda buat
        $this->call([
            ExamSeeder::class,
            SubjectSeeder::class,
            StudentSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
