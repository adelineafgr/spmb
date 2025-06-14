<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Question;
use App\Models\StudentExam;
use App\Models\StudentAnswer;
use App\Models\Subject;
use Carbon\Carbon;

class ExamController extends Controller
{
    // ... (metode index dan start tetap sama seperti sebelumnya, tanpa perubahan) ...
    public function index()
    {
        $exams = Exam::all();
        $student = Auth::user()->student;

        $studentExamStatuses = $student ? $student->studentExams->keyBy('exam_id') : collect();

        // Tambahkan kondisi untuk menampilkan tombol TPA jika siswa sudah mengisi data pendaftaran
        $canTakeTPA = $student && $student->pilihan_jurusan_1 && $student->pilihan_jurusan_2;

        return view('student.exam.index', compact('exams', 'studentExamStatuses', 'canTakeTPA'));
    }

    public function start(Exam $exam)
    {
        $student = Auth::user()->student;

        // Cek apakah siswa sudah punya sesi ujian ini
        $studentExam = StudentExam::firstOrCreate(
            ['student_id' => $student->id, 'exam_id' => $exam->id],
            ['status' => 'pending']
        );

        // Jika ujian sudah selesai, tidak bisa memulai lagi
        if ($studentExam->status === 'completed') {
            return redirect()->route('student.exam.index')->with('error', 'Anda sudah menyelesaikan ujian ' . $exam->name . '.');
        }

        $studentExam->update(['status' => 'in_progress']);

        $questions = collect();

        if ($exam->name === 'TKD') {
            $questions = $exam->questions()->with('answers', 'subject')->get()->groupBy('subject.name');
        } elseif ($exam->name === 'TPA') {
            $pilihanJurusan1 = $student->pilihan_jurusan_1;
            $pilihanJurusan2 = $student->pilihan_jurusan_2;

            if (!$pilihanJurusan1 || !$pilihanJurusan2) {
                return redirect()->route('student.exam.index')->with('error', 'Anda harus mengisi data pendaftaran dan memilih KEDUA jurusan untuk mengambil ujian TPA.');
            }

            $majorSubject1 = Subject::where('name', $pilihanJurusan1)->first();
            $majorSubject2 = Subject::where('name', $pilihanJurusan2)->first();

            if (!$majorSubject1 || !$majorSubject2) {
                return redirect()->route('student.exam.index')->with('error', 'Salah satu atau kedua jurusan Anda tidak ditemukan untuk ujian TPA.');
            }

            $questionsForMajor1 = $exam->questions()
                ->where('subject_id', $majorSubject1->id)
                ->with('answers', 'subject')
                ->get();

            $questionsForMajor2 = $exam->questions()
                ->where('subject_id', $majorSubject2->id)
                ->with('answers', 'subject')
                ->get();

            $questions = $questionsForMajor1->merge($questionsForMajor2)->groupBy('subject.name');
        } elseif ($exam->name === 'Minat Bakat') { // BARU: Logika untuk Minat Bakat
            // Ambil semua soal Minat Bakat, tidak perlu pengelompokan subjek karena hasilnya adalah rekomendasi
            $questions = $exam->questions()->with('answers')->get();
            $questions = collect(['Tes Minat Bakat' => $questions]); // Kelompokkan dalam satu kategori untuk tampilan
        } else {
            $questions = $exam->questions()->with('answers')->get();
            $questions = collect(['Umum' => $questions]);
        }

        $timeRemaining = null;

        $studentAnswers = $studentExam->studentAnswers->keyBy('question_id');

        return view('student.exam.show', compact('exam', 'studentExam', 'questions', 'timeRemaining', 'studentAnswers'));
    }


    // Submit Jawaban Ujian
    public function submit(Request $request, Exam $exam)
    {
        $student = Auth::user()->student;
        $studentExam = StudentExam::where('student_id', $student->id)
            ->where('exam_id', $exam->id)
            ->where('status', 'in_progress')
            ->firstOrFail();

        // Variabel untuk menyimpan rekomendasi jurusan (khusus Minat Bakat)
        $recommendedMajor = null;
        $majorScores = []; // Untuk Minat Bakat

        // Simpan jawaban siswa
        foreach ($request->input('answers', []) as $questionId => $answerId) {
            $question = Question::find($questionId);
            $answer = $question->answers()->find($answerId);

            if ($question && $answer) {
                StudentAnswer::updateOrCreate(
                    ['student_exam_id' => $studentExam->id, 'question_id' => $questionId],
                    ['answer_id' => $answerId]
                );

                // --- LOGIKA MINAT BAKAT (saat menyimpan jawaban) ---
                if ($exam->name === 'Minat Bakat' && $answer->meta_data) {
                    $major = $answer->meta_data; // Ambil jurusan dari meta_data jawaban
                    $majorScores[$major] = ($majorScores[$major] ?? 0) + 1; // Tambah skor untuk jurusan itu
                }
                // --- AKHIR LOGIKA MINAT BAKAT ---
            }
        }

        // Hitung Skor (untuk TKD/TPA) atau Rekomendasi (untuk Minat Bakat)
        $score = 0; // Default untuk ujian biasa
        if ($exam->name === 'TKD') {
            $pointPerQuestion = 1;
            foreach ($studentExam->studentAnswers()->whereIn('question_id', $request->input('answers', []))->get() as $studentAnswer) {
                if ($studentAnswer->chosenAnswer && $studentAnswer->chosenAnswer->is_correct) {
                    $score += $pointPerQuestion;
                }
            }
        } elseif ($exam->name === 'TPA') {
            $pointPerQuestion = 2;
            foreach ($studentExam->studentAnswers()->whereIn('question_id', $request->input('answers', []))->get() as $studentAnswer) {
                if ($studentAnswer->chosenAnswer && $studentAnswer->chosenAnswer->is_correct) {
                    $score += $pointPerQuestion;
                }
            }
        } elseif ($exam->name === 'Minat Bakat') {
            // Logika untuk menentukan rekomendasi jurusan
            if (!empty($majorScores)) {
                arsort($majorScores); // Urutkan dari skor tertinggi
                $recommendedMajor = key($majorScores); // Ambil jurusan dengan skor tertinggi
            } else {
                $recommendedMajor = 'Tidak ada rekomendasi (tidak ada jawaban)';
            }
            // Untuk Minat Bakat, 'score' di tabel student_exams bisa kita gunakan untuk menyimpan rekomendasi
            // atau tambahkan kolom baru jika Anda ingin menyimpan skor numerik juga.
            // Untuk kesederhanaan, kita akan simpan nama jurusan di kolom 'score' sebagai string.
            // Pastikan kolom 'score' di tabel student_exams bisa menampung string (misal: VARCHAR).
            // Jika score hanya INT, kita perlu kolom baru, atau kita kirim rekomendasi via session.
            // Untuk saat ini, kita akan kirim via session ke halaman result.
            $request->session()->put('minat_bakat_recommendation', $recommendedMajor);
            // score untuk minat bakat bisa 0 atau biarkan null, karena tidak relevan
            $score = 20; // Atur skor minat bakat ke 0
        }


        // Update status ujian siswa dan skor
        $studentExam->update([
            'score' => $score, // Ini akan menyimpan 0 untuk Minat Bakat
            'status' => 'completed',
        ]);

        return redirect()->route('student.exam.result', $studentExam)->with('success', 'Ujian berhasil diselesaikan!');
    }

    // Menampilkan hasil ujian
    public function result(StudentExam $studentExam)
    {
        // Pastikan siswa yang melihat hasilnya adalah pemilik ujian tersebut
        if (Auth::user()->student->id !== $studentExam->student_id) {
            abort(403, 'Unauthorized access.');
        }

        // Muat relasi yang dibutuhkan untuk menampilkan detail
        $studentExam->load('exam', 'studentAnswers.question.answers');

        $correctAnswers = []; // Default untuk TKD/TPA
        if ($studentExam->exam->name !== 'Minat Bakat') {
            foreach ($studentExam->exam->questions as $question) {
                $correctAnswers[$question->id] = $question->correct_answer->id ?? null;
            }
        }

        // Ambil rekomendasi minat bakat dari session jika ada
        $minatBakatRecommendation = session('minat_bakat_recommendation');

        return view('student.exam.result', compact('studentExam', 'correctAnswers', 'minatBakatRecommendation'));
    }

    public function showTkdBindo()
    {
        // Bisa juga simpan waktu mulai ujian di session (opsional)
        session(['tkd_bindo_start_time' => now()]);

        // Misalnya exam_id = 1 untuk TKD B. Indonesia
        $exam = (object)[
            'id' => 1,
            'name' => 'TKD - Bahasa Indonesia',
        ];

        return view('student.exam.tkd_bindo', compact('exam'));
    }



    public function submitTkdBindo(Request $request)
    {
        $questions = [
            ['question' => 'Gagasan utama dari sebuah paragraf disebut...', 'answer' => 'C'],
            ['question' => "Sinonim dari kata 'pandai' adalah...", 'answer' => 'B'],
            ['question' => "Antonim dari kata 'besar' adalah...", 'answer' => 'C'],
            ['question' => "Teks prosedur berisi tentang...", 'answer' => 'B'],
            ['question' => "Kalimat efektif adalah kalimat yang...", 'answer' => 'C'],
            ['question' => "Kata baku dari 'aktifitas' adalah...", 'answer' => 'A'],
            ['question' => 'Tanda baca yang digunakan untuk mengakhiri kalimat perintah adalah...', 'answer' => 'D'],
            ['question' => 'Kutipan dari seseorang disebut...', 'answer' => 'D'],
            ['question' => 'Kalimat yang menyatakan ajakan adalah...', 'answer' => 'A'],
            ['question' => 'Cerpen termasuk jenis...', 'answer' => 'C'],
        ];

        $answers = $request->input('answers', []);
        $score = 0;

        foreach ($questions as $index => $question) {
            $userAnswer = $answers[$index] ?? null;
            if ($userAnswer === $question['answer']) {
                $score += 1;
            }
        }

        // Simpan ke DB
        StudentExam::create([
            'student_id' => Auth::id(),
            'exam_id' => 1,
            'score' => $score,
            'start_time' => now()->subMinutes(10), // atau bisa pake session
            'end_time' => now()
        ]);

        return redirect()->route('dashboard')->with('success', 'Ujian berhasil dikumpulkan. Skor kamu: ' . $score);
    }
}
