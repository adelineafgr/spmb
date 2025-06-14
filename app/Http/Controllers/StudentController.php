<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
