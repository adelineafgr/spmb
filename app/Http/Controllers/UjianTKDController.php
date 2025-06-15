<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\StudentExam;
use Carbon\Carbon;

class UjianTKDController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student; // ini dapetin data dari table students
        $exam = Exam::where('name', 'TKD')->firstOrFail();



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

        $mapelSoal = [
            'Bahasa Indonesia' => [
                [
                    'pertanyaan' => 'Gagasan utama dari sebuah paragraf disebut...',
                    'opsi' => ['Judul', 'Kalimat tanya', 'Ide pokok', 'Kalimat penjelas'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => "Sinonim dari kata 'pandai' adalah...",
                    'opsi' => ['Bodoh', 'Pintar', 'Malas', 'Nakal'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => "Antonim dari kata 'besar' adalah...",
                    'opsi' => ['Tinggi', 'Kuat', 'Kecil', 'Panjang'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Teks prosedur berisi tentang...',
                    'opsi' => ['Cerita fiksi', 'Langkah-langkah melakukan sesuatu', 'Ulasan buku', 'Teks sejarah'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => 'Kalimat efektif adalah kalimat yang...',
                    'opsi' => ['Panjang', 'Sulit dipahami', 'Mudah dipahami', 'Tidak runtut'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => "Kata baku dari 'aktifitas' adalah...",
                    'opsi' => ['Aktivitas', 'Aktifitas', 'Aktifas', 'Aktifis'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => 'Tanda baca yang digunakan untuk mengakhiri kalimat perintah adalah...',
                    'opsi' => ['Titik', 'Koma', 'Tanda tanya', 'Tanda seru'],
                    'jawaban' => 3, // D
                ],
                [
                    'pertanyaan' => 'Kutipan dari seseorang disebut...',
                    'opsi' => ['Teks eksplanasi', 'Biografi', 'Wawancara', 'Kutipan langsung'],
                    'jawaban' => 3, // D
                ],
                [
                    'pertanyaan' => 'Kalimat yang menyatakan ajakan adalah...',
                    'opsi' => ['Ayo kita belajar bersama!', 'Hari ini saya tidak sekolah', 'Nama saya Budi', 'Apakah kamu sakit?'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => 'Cerpen termasuk jenis...',
                    'opsi' => ['Teks eksposisi', 'Teks prosedur', 'Teks narasi', 'Teks laporan'],
                    'jawaban' => 2, // C
                ],
            ],
            'Bahasa Inggris' => [
                [
                    'pertanyaan' => "The English word for 'sekolah' is...",
                    'opsi' => ['Market', 'House', 'School', 'Garden'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => "What is the opposite of 'big'?",
                    'opsi' => ['Small', 'Long', 'Tall', 'Wide'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => "'He ___ to school every day.' Choose the correct verb",
                    'opsi' => ['go', 'going', 'goes', 'gone'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => "'Thank you' is used to express...",
                    'opsi' => ['Asking', 'Refusing', 'Gratitude', 'Regret'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => "Choose the correct question: ___ is your name?",
                    'opsi' => ['What', 'Where', 'How', 'When'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => "I have two ___: a cat and a dog.",
                    'opsi' => ['pets', 'books', 'chairs', 'pencils'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => "The sun ___ in the east.",
                    'opsi' => ['rise', 'rises', 'rising', 'rose'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => "'Good night' is usually said when...",
                    'opsi' => ['Meeting someone', 'Going to bed', 'Having lunch', 'Studying'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => "'She is very kind'. The word 'kind' means...",
                    'opsi' => ['Rude', 'Angry', 'Nice', 'Loud'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => "'We are ___ a movie now.'",
                    'opsi' => ['watch', 'watching', 'watched', 'watches'],
                    'jawaban' => 1, // B
                ],
            ],
            'Matematika' => [
                [
                    'pertanyaan' => 'Hasil dari 25 × 4 adalah...',
                    'opsi' => ['50', '60', '100', '90'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Hasil dari 3² adalah...',
                    'opsi' => ['6', '9', '12', '8'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => 'Bilangan prima di bawah 10 adalah...',
                    'opsi' => ['1, 2, 3, 5, 7', '1, 2, 4, 6', '2, 3, 5, 9', '1, 3, 6, 9'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => 'Luas persegi dengan sisi 5 cm adalah...',
                    'opsi' => ['25 cm²', '10 cm²', '15 cm²', '20 cm²'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => 'Volume kubus dengan sisi 4 cm adalah...',
                    'opsi' => ['64 cm³', '16 cm³', '12 cm³', '48 cm³'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => 'Keliling segitiga dengan panjang sisi 6 cm adalah...',
                    'opsi' => ['12 cm', '18 cm', '20 cm', '22 cm'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => '1/2 + 1/4 = ...',
                    'opsi' => ['1/8', '1/2', '3/4', '2/4'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Sudut siku-siku besarnya adalah...',
                    'opsi' => ['45°', '60°', '90°', '180°'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Jika x = 2, maka nilai dari 3x + 1 adalah...',
                    'opsi' => ['5', '6', '7', '8'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Nilai dari √49 adalah...',
                    'opsi' => ['6', '7', '8', '9'],
                    'jawaban' => 1, // B
                ],
            ],
            'PPKN' => [
                [
                    'pertanyaan' => 'Lambang negara Indonesia adalah...',
                    'opsi' => ['Harimau', 'Elang', 'Garuda', 'Burung dara'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Sila pertama Pancasila adalah...',
                    'opsi' => ['Kemanusiaan yang Adil dan Beradab', 'Ketuhanan Yang Maha Esa', 'Persatuan Indonesia', 'Keadilan Sosial bagi Seluruh Rakyat Indonesia'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => 'Hari Kemerdekaan Indonesia diperingati setiap tanggal...',
                    'opsi' => ['17 Juli', '17 Agustus', '1 Juni', '10 November'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => 'Bentuk negara Indonesia adalah...',
                    'opsi' => ['Kerajaan', 'Federasi', 'Republik', 'Monarki'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Pemilu di Indonesia dilaksanakan setiap...',
                    'opsi' => ['10 tahun', '2 tahun', '5 tahun', '7 tahun'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Salah satu kewajiban sebagai warga negara adalah...',
                    'opsi' => ['Liburan', 'Belanja', 'Membayar pajak', 'Berwisata'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Bhinneka Tunggal Ika berarti...',
                    'opsi' => ['Berbeda-beda tetap satu', 'Satu untuk semua', 'Satu bangsa', 'Berbeda jauh'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => 'Presiden pertama Indonesia adalah...',
                    'opsi' => ['J. Habibie', 'Ir. Soekarno', 'Joko Widodo', 'Megawati'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => 'Contoh sikap toleransi adalah...',
                    'opsi' => ['Bertengkar dengan teman', 'Menyela saat orang lain bicara', 'Menghargai perbedaan', 'Menjelekkan agama lain'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'UUD 1945 merupakan...',
                    'opsi' => ['Buku pelajaran', 'Dasar negara', 'Undang-undang dasar', 'Lambang negara'],
                    'jawaban' => 2, // C
                ],
            ],
            'Pendidikan Agama Islam' => [
                [
                    'pertanyaan' => 'Rukun Islam yang pertama adalah...',
                    'opsi' => ['Puasa', 'Zakat', 'Shalat', 'Syahadat'],
                    'jawaban' => 3, // D
                ],
                [
                    'pertanyaan' => 'Kitab suci umat Islam adalah...',
                    'opsi' => ['Al-Qur\'an', 'Injil', 'Taurat', 'Weda'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => 'Nabi terakhir dalam Islam adalah...',
                    'opsi' => ['Nabi Isa', 'Nabi Musa', 'Nabi Muhammad SAW', 'Nabi Nuh'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Wudhu dilakukan sebelum...',
                    'opsi' => ['Tidur', 'Shalat', 'Bekerja', 'Makan'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => 'Jumlah rakaat shalat Subuh adalah...',
                    'opsi' => ['3', '2', '4', '1'],
                    'jawaban' => 1, // B
                ],
                [
                    'pertanyaan' => 'Bulan puasa dalam Islam disebut bulan...',
                    'opsi' => ['Dzulhijjah', 'Syawal', 'Ramadhan', 'Muharram'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Zakat fitrah dibayarkan pada saat...',
                    'opsi' => ['Idul Fitri', 'Idul Adha', 'Awal Ramadhan', 'Maulid'],
                    'jawaban' => 0, // A
                ],
                [
                    'pertanyaan' => 'Kalimat thayyibah yang artinya \'Dengan menyebut nama Allah\' adalah...',
                    'opsi' => ['Alhamdulillah', 'Astaghfirullah', 'Bismillah', 'Subhanallah'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Salah satu sifat terpuji Nabi Muhammad adalah...',
                    'opsi' => ['Malas', 'Bohong', 'Amanah', 'Dengki'],
                    'jawaban' => 2, // C
                ],
                [
                    'pertanyaan' => 'Tempat ibadah umat Islam adalah...',
                    'opsi' => ['Gereja', 'Wihara', 'Masjid', 'Pura'],
                    'jawaban' => 2, // C
                ],
            ],
        ];


        $soalTKD = [];
        $kunciJawaban = [];

        foreach ($mapelSoal as $mapel => $soals) {
            foreach ($soals as $soal) {
                $soal['mapel'] = $mapel;
                $soalTKD[] = $soal;
                $kunciJawaban[] = $soal['jawaban'];
            }
        }

        session(['tkd_kunci' => $kunciJawaban]);

        return view('student.exam.tkd', compact('exam', 'studentExam', 'soalTKD'));
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $student = $user->student;
        $exam = Exam::where('name', 'TKD')->firstOrFail();

        $kunciJawaban = session('tkd_kunci');
        $score = 0;
        $pointsPerCorrectAnswer = 1; // 1 soal TKD bernilai 1 point

        foreach ($kunciJawaban as $index => $kunci) {
            if ((int)($request->input('answers')[$index] ?? -1) === $kunci) {
                $score += $pointsPerCorrectAnswer;
            }
        }

        $studentExam = StudentExam::where('student_id', $student->id)
            ->where('exam_id', $exam->id)
            ->firstOrFail();

        $studentExam->update([
            'end_time' => Carbon::now(),
            'score' => $score,
            'status' => 'completed',
        ]);

        // Cek apakah semua ujian sudah selesai
        $isTPACompleted = $student->studentExams()->whereHas('exam', function ($query) {
            $query->where('name', 'TPA');
        })->where('status', 'completed')->exists();

        $isMinatBakatCompleted = $student->studentExams()->whereHas('exam', function ($query) {
            $query->where('name', 'Minat Bakat');
        })->where('status', 'completed')->exists();

        // Sudah pasti TKD completed karena baru saja disubmit
        $isTKDCompleted = true;

        if ($isTKDCompleted && $isTPACompleted && $isMinatBakatCompleted) {
            return redirect()->route('student.exam.results');
        } else {
            return redirect()->route('student.exam.index')->with('success', 'Ujian TKD selesai. Anda dapat melanjutkan ujian lainnya.');
        }
    }
}
