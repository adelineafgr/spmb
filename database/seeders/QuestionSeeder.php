<?php

// database/seeders/QuestionSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question; // Pastikan Anda memiliki model Question
use App\Models\Exam;     // Asumsi Anda punya model Exam dan ada data exam
use App\Models\Subject;  // Asumsi Anda punya model Subject dan ada data subject (jika diperlukan)

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada setidaknya satu data di tabel 'exams' dan 'subjects'
        // Jika belum ada, Anda bisa membuat seeder untuk Exam dan Subject terlebih dahulu,
        // atau membuat data dummy di sini.
        // Contoh:
        $examId = Exam::first()->id ?? Exam::create(['name' => 'Ujian Default'])->id;
        $subjectId = Subject::first()->id ?? null; // Atau Subject::create(['name' => 'Umum'])->id; jika diperlukan subject

        $questions = [
            [
                'exam_id' => $examId,
                'subject_id' => $subjectId, // Sesuaikan jika Anda ingin mengaitkan dengan subject tertentu
                'question_text' => 'Beberapa orang sedang bekerja dan bantuh bantuan anda, jenis pekerjaan apa yang akan anda bantu:
A. Memixer adonan
B. Mengamplas besi
C. Merapihkan/menata gudang',
            ],
            [
                'exam_id' => $examId,
                'subject_id' => $subjectId,
                'question_text' => 'Di beranda Tik-Tok atau IG ada lewat beberapa postingan berikut, postingan acara apakah yang menarik perhatian anda untuk ditonton :
A. Chef Yuna memarahi kontesta
B. Tutorial membuat teralis
C. Jejak pengalaman pegawai expedisi',
            ],
            [
                'exam_id' => $examId,
                'subject_id' => $subjectId,
                'question_text' => 'Jika anda diminta menyumbangkan benda yang menggambarkan cita-cita anda, barang apakah yang akan anda beli :
A. Resep masakan
B. Mesin las
C. Voucher kursus singkat usaha expedisi',
            ],
            [
                'exam_id' => $examId,
                'subject_id' => $subjectId,
                'question_text' => 'Pilih salah satu option dibawah ini yang menggambarkan diri anda dimasa depan:
A. Pemilik cake store
B. Welder
C. Pengusaha expedisi',
            ],
            [
                'exam_id' => $examId,
                'subject_id' => $subjectId,
                'question_text' => 'Pilih kondisi berikut yang menurut anda adalah sesuatu atau hal yang wajar jika suatu saat terjadi pada anda :
A. Berlumuran terigu, bau bawang, pengap asap atau kepanasan
B. Tangan kapalan, mata merah, terpapar panas sepanjang hari
C. Keringatan, bolak-balik gotong-gotong barang, sepanjang hari dalam gudang',
            ],
        ];

        foreach ($questions as $questionData) {
            Question::create($questionData);
        }
    }
}
