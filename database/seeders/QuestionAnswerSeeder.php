<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Answer;

class QuestionAnswerSeeder extends Seeder
{
    public function run(): void
    {
        $tkdExam = Exam::where('name', 'TKD')->first();
        if (!$tkdExam) {
            $this->call(ExamSeeder::class); // Pastikan ExamSeeder dijalankan duluan
            $tkdExam = Exam::where('name', 'TKD')->first();
        }

        $subjects = [
            'Bahasa Indonesia',
            'Bahasa Inggris',
            'Matematika',
            'PPKn',
            'PAI',
        ];

        foreach ($subjects as $subjectName) {
            $subject = Subject::where('name', $subjectName)->first();
            if (!$subject) {
                $this->call(SubjectSeeder::class); // Pastikan SubjectSeeder dijalankan duluan
                $subject = Subject::where('name', $subjectName)->first();
            }
        }

        $minatBakatExam = Exam::where('name', 'Minat Bakat')->first();
        if ($minatBakatExam) {
            $minatBakatQuestions = [
                "Saya lebih suka kegiatan yang melibatkan: (A) Memasak dan menciptakan resep baru, (B) Merancang dan membangun struktur metal, (C) Mengelola barang dan rantai pasok.",
                "Dalam tim, saya cenderung menjadi orang yang: (A) Bertanggung jawab atas makanan dan persiapan acara, (B) Memastikan kekuatan dan keamanan konstruksi, (C) Mengoptimalkan alur kerja dan distribusi.",
                "Hobi saya yang paling saya nikmati adalah: (A) Eksperimen di dapur, menonton acara memasak, (B) Membangun model, memperbaiki benda-benda logam, (C) Menyusun jadwal, mengatur penyimpanan barang.",
                "Ketika menghadapi masalah, saya cenderung mencari solusi dengan: (A) Mencoba berbagai bahan dan metode sampai rasa pas, (B) Menganalisis struktur dan kekuatan material, (C) Menata ulang proses untuk efisiensi.",
                "Saya tertarik untuk belajar lebih banyak tentang: (A) Teknik kuliner, gizi, dan sanitasi makanan, (B) Berbagai jenis logam, teknik pengelasan, dan standar keselamatan, (C) Sistem inventaris, transportasi, dan manajemen gudang.",
            ];

            foreach ($minatBakatQuestions as $qText) {
                $question = Question::firstOrCreate(
                    ['exam_id' => $minatBakatExam->id, 'question_text' => $qText],
                    ['subject_id' => null] // Tidak ada subject_id khusus untuk soal minat bakat
                );

                // Asumsi urutan A, B, C konsisten
                Answer::firstOrCreate(['question_id' => $question->id, 'answer_text' => 'Pilihan A', 'is_correct' => false, 'meta_data' => 'Kuliner']);
                Answer::firstOrCreate(['question_id' => $question->id, 'answer_text' => 'Pilihan B', 'is_correct' => false, 'meta_data' => 'Pengelasan']);
                Answer::firstOrCreate(['question_id' => $question->id, 'answer_text' => 'Pilihan C', 'is_correct' => false, 'meta_data' => 'Logistik']);
                // Tidak ada D
            }
        }
    }
}
