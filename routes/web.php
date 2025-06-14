<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController; // Pastikan ini diimpor dengan benar
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Student\ExamController;
use App\Http\Controllers\UjianTKDController; // Pastikan ini diimpor dengan benar
use App\Http\Controllers\UjianTPAController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Rute Umum
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard'); // Mengarahkan kembali ke dashboard admin umum
    }
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); // <-- Kembali ke AdminController
    Route::get('/students', [AdminController::class, 'indexStudents'])->name('students.index'); // <-- Rute terpisah untuk daftar siswa
    Route::get('/students/{student}', [AdminController::class, 'showStudent'])->name('students.show');
    // Tambahkan rute untuk edit/delete siswa jika diperlukan
});

// Rute Siswa
Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/register-data', [StudentController::class, 'createRegistrationForm'])->name('register_data.create');
    Route::post('/register-data', [StudentController::class, 'storeRegistrationData'])->name('register_data.store');
    Route::get('/edit-data', [StudentController::class, 'editRegistrationForm'])->name('register_data.edit');
    Route::put('/edit-data', [StudentController::class, 'updateRegistrationData'])->name('register_data.update');

    // Rute Ujian
    Route::prefix('exam')->name('exam.')->group(function () {
        Route::get('/', [ExamController::class, 'index'])->name('index'); // Daftar ujian
        Route::get('/{exam}/start', [ExamController::class, 'start'])->name('start'); // Memulai ujian
        Route::post('/{exam}/submit', [ExamController::class, 'submit'])->name('submit'); // Submit jawaban
        Route::get('/{studentExam}/result', [ExamController::class, 'result'])->name('result'); // Lihat hasil
    });
    Route::post('/logout', function (Request $request) {
        Auth::logout(); // Logs out the current user

        $request->session()->invalidate(); // Invalidates the current session
        $request->session()->regenerateToken(); // Regenerates the CSRF token

        return redirect('/login'); // Redirect to your desired page after logout
    })->name('logout'); // Assign a name to the route for easier referencing
});


Route::get('/ujian/tkd', [UjianTKDController::class, 'index'])->name('student.exam.tkd');
Route::post('/ujian/tkd', [UjianTKDController::class, 'submit'])->name('student.exam.tkd.submit');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/ujian/tpa', [UjianTPAController::class, 'index'])->name('student.exam.tpa');
    Route::post('/ujian/tpa/submit', [UjianTPAController::class, 'submit'])->name('ujian.tpa.submit');
});



require __DIR__ . '/auth.php';
