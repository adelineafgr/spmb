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
            'description' => 'Tes Kemampuan Dasar meliputi berbagai mata pelajaran.',
            'duration_minutes' => 90, // 90 menit untuk TKD
        ]);

        Exam::create([
            'name' => 'TPA',
            'description' => 'Tes Potensi Akademik.',
            'duration_minutes' => 60,
        ]);

        Exam::create([
            'name' => 'Minat Bakat',
            'description' => 'Tes Minat dan Bakat.',
            'duration_minutes' => 45,
        ]);
    }
}
