<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user(); // Mendapatkan objek User yang sedang login
        $studentData = $user->student; // MENGISI VARIABEL PENTING INI: Memeriksa relasi 'student'
        // Jika ada data Student terkait User ini, $studentData berisi objek Student.
        // Jika tidak ada (belum mengisi data), $studentData akan berisi NULL.
        return view('student.dashboard', compact('studentData')); // Mengirimkan $studentData ke view
    }

    public function createRegistrationForm()
    {
        $jurusan = ['Kuliner', 'Pengelasan', 'Logistik'];

        return view('student.register_data', compact('jurusan'));
    }

    public function storeRegistrationData(Request $request)
    {
        $validated = $request->validate([
            'smp' => 'required|string|max:255',
            'pilihan_jurusan_1' => 'required|string',
            'pilihan_jurusan_2' => 'required|string|different:pilihan_jurusan_1',
        ]);

        Student::create([
            'user_id' => Auth::id(), // Jika ingin menyambungkan ke user login
            'smp' => $validated['smp'],
            'pilihan_jurusan_1' => $validated['pilihan_jurusan_1'],
            'pilihan_jurusan_2' => $validated['pilihan_jurusan_2'],
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Data berhasil disimpan.');
    }

    public function editRegistrationForm()
    {
        $jurusan = ['Kuliner', 'Teknik Pengelasan', 'Teknik Logistik'];

        $studentData = Student::where('user_id', Auth::id())->firstOrFail();

        return view('student.edit_data', compact('jurusan', 'studentData'));
    }

    public function updateRegistrationData(Request $request)
    {
        $validated = $request->validate([
            'smp' => 'required|string|max:255',
            'pilihan_jurusan_1' => 'required|string',
            'pilihan_jurusan_2' => 'required|string|different:pilihan_jurusan_1',
        ]);

        $student = Student::where('user_id', Auth::id())->firstOrFail();

        $student->update($validated);

        return redirect()->route('student.dashboard')->with('success', 'Data berhasil diupdate.');
    }

    public function result()
    {
        $user = Auth::user();
        $student = $user->student;

        // Ambil data ujian dari student_exams
        $tkd = $student->studentExams()->where('exam_id', 1)->first();
        $tpa = $student->studentExams()->where('exam_id', 2)->first();
        $minat = $student->studentExams()->where('exam_id', 3)->first();

        // Nilai skor (jika ada)
        $skorTKD = $tkd?->score ?? null;
        $skorTPA = $tpa?->score ?? null;
        $rekomendasi = $minat?->recommended_major ?? 'Belum tersedia'; // Asumsi: hasil minat bakat simpan rekomendasi jurusan

        return view('student.hasil', compact('skorTKD', 'skorTPA', 'rekomendasi'));
    }
}
