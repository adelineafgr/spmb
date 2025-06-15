<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student; // Mungkin masih perlu ini untuk menghitung total siswa
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalStudents = Student::count(); // Tetap bisa menghitung total siswa
        return view('admin.dashboard', compact('totalStudents')); // Mengirim totalStudents
    }

    public function indexStudents()
    {
        // Logika untuk menampilkan semua siswa secara terpisah
        $students = Student::with('user', 'studentExams.exam', 'studentExams.studentAnswers.chosenAnswer')->get();

        // Siapkan data untuk tabel index (sama seperti yang pernah di dashboard sebelumnya)
        $studentsData = $students->map(function ($student) {
            $tkdScore = $student->studentExams->where('exam.name', 'TKD')->first()->score ?? 0;

            // === TPA ===
            $tpaExamResult = $student->studentExams->where('exam_id', 2)->first();
            $tpaScore = $tpaExamResult->score ?? 0;
            $tpaRecommendation = $tpaExamResult->recommended_major ?? null;

            // === Minat Bakat ===
            $minatBakatExamResult = $student->studentExams->where('exam_id', 3)->first();
            $minatBakatRecommendation =  $minatBakatExamResult->recommended_major ?? null;

            $minatBakatScore = 20; // Kalau mau disesuaikan bisa aja nanti
            $totalScore = $tkdScore + $tpaScore + $minatBakatScore;

            // === Gabungan Rekomendasi ===
            $combinedRecommendation = collect([$tpaRecommendation, $minatBakatRecommendation])
                ->filter()
                ->unique()
                ->implode(', ');

            return [
                'name' => $student->user->name,
                'email' => $student->user->email,
                'smp' => $student->smp,
                'pilihan_jurusan_1' => $student->pilihan_jurusan_1,
                'pilihan_jurusan_2' => $student->pilihan_jurusan_2,
                'skor_tkd' => $tkdScore,
                'skor_tpa' => $tpaScore,
                'jurusan_tpa' => $tpaRecommendation ?? 'Tidak ada',
                'skor_minat_bakat' => $minatBakatScore,
                'jurusan_minat_bakat' => $minatBakatRecommendation ?? 'Tidak ada',
                'total_skor' => $totalScore,
                'recommended_major' => $combinedRecommendation ?: 'Tidak ada',
                'id' => $student->id,
            ];
        });

        // Tampilan untuk daftar siswa akan berada di admin.students.index
        return view('admin.students.index', compact('studentsData'));
    }

    public function showStudent(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }
}
