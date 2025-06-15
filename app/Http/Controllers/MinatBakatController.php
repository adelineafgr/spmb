<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\StudentExam;
use App\Models\Student; // Pastikan ini diimpor jika diperlukan
use Carbon\Carbon;

class MinatBakatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;
        $exam = Exam::firstOrCreate(
            ['name' => 'Minat Bakat'],
            ['description' => 'Tes untuk mengukur minat dan bakat mahasiswa.']
        );

        $studentExam = StudentExam::firstOrCreate(
            [
                'student_id' => $student->id,
                'exam_id' => $exam->id,
            ],
            [
                'start_time' => Carbon::now(),
                'status' => 'in_progress',
            ]
        );

        // Hanya tampilkan soal jika status belum completed
        if ($studentExam->status === 'completed') {
            return redirect()->route('student.exam.results')->with('info', 'Anda telah menyelesaikan Tes Minat Bakat.');
        }


        $soalMinatBakat = [
            [
                'pertanyaan' => 'Beberapa orang sedang bekerja dan butuh bantuan Anda, jenis pekerjaan apa yang akan Anda bantu:',
                'opsi' => [
                    'Memixer adonan',
                    'Mengamplas besi',
                    'Merapikan/menata gudang',
                ],
            ],
            [
                'pertanyaan' => 'Di beranda TikTok atau IG ada lewat beberapa postingan berikut, postingan acara apakah yang menarik perhatian Anda untuk ditonton:',
                'opsi' => [
                    'Chef Yuna memarahi kontestan',
                    'Tutorial membuat teralis',
                    'Jejak pengalaman pegawai ekspedisi',
                ],
            ],
            [
                'pertanyaan' => 'Jika Anda diminta menyumbangkan benda yang menggambarkan cita-cita Anda, barang apakah yang akan Anda beli:',
                'opsi' => [
                    'Resep masakan',
                    'Mesin las',
                    'Voucher kursus singkat usaha ekspedisi',
                ],
            ],
            [
                'pertanyaan' => 'Pilih salah satu opsi di bawah ini yang menggambarkan diri Anda di masa depan:',
                'opsi' => [
                    'Pemilik cake store',
                    'Welder',
                    'Pengusaha ekspedisi',
                ],
            ],
            [
                'pertanyaan' => 'Pilih kondisi berikut yang menurut Anda adalah sesuatu atau hal yang wajar jika suatu saat terjadi pada Anda:',
                'opsi' => [
                    'Berlumuran terigu, bau bawang, pengap asap atau kepanasan',
                    'Tangan kapalan, mata merah, terpapar panas sepanjang hari',
                    'Keringatan, bolak-balik gotong-gotong barang, sepanjang hari dalam gudang',
                ],
            ],
        ];

        return view('student.exam.minatbakat', compact('exam', 'studentExam', 'soalMinatBakat'));
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $student = $user->student;
        $exam = Exam::where('name', 'Minat Bakat')->firstOrFail();

        $answers = $request->input('answers');
        $scoreA = 0;
        $scoreB = 0;
        $scoreC = 0;
        $pointsPerAnswer = 4; // Setiap jawaban bernilai 4 point

        // Hitung skor untuk setiap kategori (A, B, C)
        foreach ($answers as $answer) {
            if ((int)$answer === 0) { // Index 0 = Opsi A
                $scoreA += $pointsPerAnswer;
            } elseif ((int)$answer === 1) { // Index 1 = Opsi B
                $scoreB += $pointsPerAnswer;
            } elseif ((int)$answer === 2) { // Index 2 = Opsi C
                $scoreC += $pointsPerAnswer;
            }
        }

        // Tentukan rekomendasi berdasarkan skor tertinggi
        $recommendation = '';
        $maxScore = max($scoreA, $scoreB, $scoreC);

        if ($maxScore === 0) { // Jika tidak ada jawaban sama sekali (seharusnya tidak terjadi karena required)
            $recommendation = 'Tidak dapat menentukan rekomendasi karena tidak ada jawaban yang dipilih.';
        } elseif ($maxScore === $scoreA && $maxScore === $scoreB && $maxScore === $scoreC) {
            $recommendation = 'Kuliner, Pengelasan, atau Logistik (Minat merata)';
        } elseif ($maxScore === $scoreA && $maxScore === $scoreB) {
            $recommendation = 'Kuliner atau Pengelasan';
        } elseif ($maxScore === $scoreA && $maxScore === $scoreC) {
            $recommendation = 'Kuliner atau Logistik';
        } elseif ($maxScore === $scoreB && $maxScore === $scoreC) {
            $recommendation = 'Pengelasan atau Logistik';
        } elseif ($maxScore === $scoreA) {
            $recommendation = 'Kuliner';
        } elseif ($maxScore === $scoreB) {
            $recommendation = 'Pengelasan';
        } elseif ($maxScore === $scoreC) {
            $recommendation = 'Logistik';
        } else {
            $recommendation = '-';
        }

        // Simpan total skor (misal: jumlah semua poin A, B, C)
        $totalScore = $scoreA + $scoreB + $scoreC;

        $studentExam = StudentExam::where('student_id', $student->id)
            ->where('exam_id', $exam->id)
            ->firstOrFail();

        $studentExam->update([
            'end_time' => Carbon::now(),
            'score' => $totalScore, // Simpan total score dari minat bakat
            'status' => 'completed',
            'recommended_major' => $recommendation,
        ]);

        // Setelah submit, arahkan ke halaman hasil jika semua ujian sudah selesai
        // Atau kembali ke dashboard jika ada ujian lain yang belum selesai
        $isTKDCompleted = $student->studentExams()->whereHas('exam', function ($query) {
            $query->where('name', 'TKD');
        })->where('status', 'completed')->exists();

        $isTPACompleted = $student->studentExams()->whereHas('exam', function ($query) {
            $query->where('name', 'TPA');
        })->where('status', 'completed')->exists();

        $isMinatBakatCompleted = $studentExam->status === 'completed'; // Sudah pasti completed

        if ($isTKDCompleted && $isTPACompleted && $isMinatBakatCompleted) {
            return redirect()->route('student.exam.results');
        } else {
            return redirect()->route('student.exam.index')->with('success', 'Tes Minat Bakat selesai. Anda dapat melanjutkan ujian lainnya.');
        }
    }
}
