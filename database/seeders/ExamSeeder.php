<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        Exam::create([
            'name' => 'TKD',
            'description' => '50 soal',
            'duration_minutes' => 90, // 90 menit untuk TKD
        ]);

        Exam::create([
            'name' => 'TPA',
            'description' => '30 Soal',
            'duration_minutes' => 45,
        ]);

        Exam::create([
            'name' => 'Minat Bakat',
            'description' => '5 soal',
            'duration_minutes' => 20,
        ]);
    }
}
