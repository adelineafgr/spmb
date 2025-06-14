<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        // Mata pelajaran untuk TKD
        Subject::create(['name' => 'Bahasa Indonesia']);
        Subject::create(['name' => 'Bahasa Inggris']);
        Subject::create(['name' => 'Matematika']);
        Subject::create(['name' => 'PPKn']);
        Subject::create(['name' => 'PAI']);

        // Jurusan (juga sebagai Subject untuk TPA)
        Subject::firstOrCreate(['name' => 'Kuliner', 'description' => 'Jurusan Kuliner']);
        Subject::firstOrCreate(['name' => 'Logistik', 'description' => 'Jurusan Logistik']);
        Subject::firstOrCreate(['name' => 'Pengelasan', 'description' => 'Jurusan Pengelasan']);
    }
}
