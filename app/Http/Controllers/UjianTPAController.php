<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\StudentExam;
use Carbon\Carbon;

class UjianTPAController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student; // ini dapetin data dari table students

        $exam = Exam::where('name', 'TPA')->firstOrFail();
        

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

        // Soal hardcoded per jurusan
        $soalKuliner = [
            [
                'pertanyaan' => 'Tata boga adalah ilmu yang mempelajari tentang...',
                'opsi' => ['Menjahit pakaian', 'Memasak dan menyajikan makanan', 'Membangun rumah', 'Merawat tanaman'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Salah satu alat utama yang digunakan dalam memasak adalah...',
                'opsi' => ['Gergaji', 'Panci', 'Palu', 'Bor'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Bahan makanan yang berasal dari tumbuhan disebut...',
                'opsi' => ['Hewani', 'Nabati', 'Kimia', 'Sintetis'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Untuk menjaga kebersihan makanan, hal yang perlu dilakukan adalah...',
                'opsi' => ['Menggunakan tangan kotor', 'Memakai peralatan bekas', 'Mencuci tangan sebelum memasak', 'Tidak mencuci bahan makanan'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Fungsi dari kompor dalam kegiatan memasak adalah...',
                'opsi' => ['Menghangatkan ruangan', 'Mendinginkan makanan', 'Memanaskan dan memasak makanan', 'Menyimpan makanan'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Jenis pisau yang digunakan untuk memotong daging adalah...',
                'opsi' => ['Pisau roti', 'Pisau ukir', 'Pisau daging', 'Cutter'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Alat pelindung yang digunakan saat memasak agar baju tidak kotor adalah...',
                'opsi' => ['Sarung tangan', 'Topi koki', 'Celemek', 'Rompi'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Contoh makanan yang termasuk kategori makanan pokok adalah...',
                'opsi' => ['Ayam goreng', 'Nasi', 'Telur dadar', 'Sambal'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Bahan makanan yang mudah rusak harus disimpan dalam...',
                'opsi' => ['Rak buku', 'Kulkas', 'Laci pakaian', 'Lemari kayu'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Menggoreng adalah teknik memasak dengan cara...',
                'opsi' => ['Merebus dalam air', 'Memanggang di oven', 'Memasak dalam minyak panas', 'Mengukus dengan uap'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Makanan sehat sebaiknya mengandung...',
                'opsi' => ['Lemak saja', 'Gula saja', 'Nutrisi seimbang', 'Garam berlebih'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Salah satu bumbu dapur yang sering digunakan adalah...',
                'opsi' => ['Lem kayu', 'Semen', 'Garam', 'Plastik'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Agar hasil masakan menarik, maka penyajian makanan harus...',
                'opsi' => ['Dibiarkan asal-asalan', 'Disajikan kotor', 'Dihias dan rapi', 'Disimpan terlalu lama'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Warna kuning pada kunyit sering digunakan untuk...',
                'opsi' => ['Menyetrika baju', 'Pewarna alami makanan', 'Menambal jalan', 'Membersihkan jendela'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Salah satu alasan memilih jurusan tata boga adalah...',
                'opsi' => ['Tidak suka makan', 'Ingin bekerja di bidang kuliner', 'Tidak mau belajar', 'Tidak suka dapur'],
                'jawaban' => 1, // B
            ],
        ];

        $soalLogistik = [
            [
                'pertanyaan' => 'Logistik adalah kegiatan yang berkaitan dengan...',
                'opsi' => ['Pemasangan listrik', 'Pengelolaan barang dari tempat asal ke tujuan', 'Pembangunan jalan', 'Penggunaan komputer'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Tempat menyimpan barang dalam kegiatan logistik disebut...',
                'opsi' => ['Laboratorium', 'Gudang', 'Kantor', 'Bengkel'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Yang termasuk alat angkut darat dalam logistik adalah...',
                'opsi' => ['Kapal laut', 'Truk', 'Pesawat terbang', 'Perahu motor'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Salah satu tujuan pengemasan barang dalam logistik adalah...',
                'opsi' => ['Menambah berat barang', 'Menyulitkan pengangkutan', 'Melindungi barang dari kerusakan', 'Mempercepat produksi'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Dokumen yang mencatat daftar barang kiriman disebut...',
                'opsi' => ['Nota belanja', 'Faktur', 'Daftar hadir', 'Surat jalan'],
                'jawaban' => 3, // D
            ],
            [
                'pertanyaan' => 'Petugas yang mengatur lalu lintas barang di gudang disebut...',
                'opsi' => ['Teknisi', 'Operator mesin', 'Admin logistik', 'Mekanik'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Kegiatan memuat dan membongkar barang disebut juga dengan...',
                'opsi' => ['Pengiriman', 'Pendistribusian', 'Bongkar muat', 'Produksi'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Alat berikut ini sering digunakan untuk memindahkan barang di gudang adalah...',
                'opsi' => ['Forklift', 'Sepeda', 'Obeng', 'Palu'],
                'jawaban' => 0, // A
            ],
            [
                'pertanyaan' => 'Barang yang mudah rusak seperti makanan harus dikirim dengan...',
                'opsi' => ['Truk terbuka', 'Wadah tertutup dan dingin', 'Plastik hitam', 'Kotak kardus biasa'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Pekerjaan di bidang logistik membutuhkan keterampilan dalam hal...',
                'opsi' => ['Menyanyi dan menari', 'Menghitung, mencatat, dan mengatur barang', 'Menggambar dan mewarnai', 'Memahat batu'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Alur logistik dimulai dari...',
                'opsi' => ['Gudang ke pelanggan', 'Produksi ke pengemasan', 'Sumber bahan ke pelanggan akhir', 'Pengiriman ke pengemasan'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Salah satu manfaat teknologi informasi dalam logistik adalah...',
                'opsi' => ['Membuat barang lebih murah', 'Membantu pelacakan barang', 'Menambah ukuran gudang', 'Mengurangi jumlah karyawan'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Waktu pengiriman barang harus...',
                'opsi' => ['Tidak menentu', 'Sesuai cuaca', 'Tepat waktu', 'Bergantung supir'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Istilah ekspedisi dalam dunia logistik berarti...',
                'opsi' => ['Perjalanan wisata', 'Perjalanan pengiriman barang', 'Pembuatan barang', 'Perjalanan kapal laut'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Salah satu alasan memilih jurusan teknik logistik adalah...',
                'opsi' => ['Tidak ada pilihan lain', 'Karena ingin mengatur alur distribusi barang', 'Karena tidak suka hitung-hitungan', 'Karena tidak suka bekerja'],
                'jawaban' => 1, // B
            ],
        ];

        $soalPengelasan = [
            [
                'pertanyaan' => 'Benda logam dapat menghantarkan listrik karena...',
                'opsi' => ['Terdiri dari bahan plastik', 'Mengandung udara', 'Memiliki elektron bebas', 'Dapat menyerap panas'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Alat pelindung diri yang digunakan untuk melindungi mata dari cahaya las adalah...',
                'opsi' => ['Kacamata hitam', 'Topi proyek', 'Helm las', 'Masker kain'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Alat ukur yang digunakan untuk mengukur panjang benda logam dengan ketelitian lebih tinggi dari mistar adalah...',
                'opsi' => ['Penggaris kayu', 'Jangka sorong', 'Penghapus', 'Timbangan'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Logam akan memuai jika...',
                'opsi' => ['Didiamkan di udara', 'Didukung oleh kayu', 'Dipanaskan', 'Didinginkan'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Salah satu sifat logam adalah...',
                'opsi' => ['Tidak dapat ditempa', 'Tidak menghantarkan panas', 'Tidak elastis', 'Dapat ditempa dan dibentuk'],
                'jawaban' => 3, // D
            ],
            [
                'pertanyaan' => 'Jika dua logam disambung dengan cara mencairkannya, maka proses itu dinamakan...',
                'opsi' => ['Pemotongan', 'Pengelasan', 'Pelapisan', 'Pengecatan'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Agar pekerjaan pengelasan aman, maka lingkungan kerja harus...',
                'opsi' => ['Lembap dan basah', 'Banyak kabel berserakan', 'Tertutup rapat tanpa ventilasi', 'Kering dan berventilasi cukup'],
                'jawaban' => 3, // D
            ],
            [
                'pertanyaan' => 'Alat berikut ini bukan termasuk peralatan tangan dalam pekerjaan logam adalah...',
                'opsi' => ['Palu', 'Tang', 'Bor listrik', 'Gergaji tangan'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Alat ukur yang digunakan untuk mengukur sudut adalah...',
                'opsi' => ['Penggaris', 'Jangka sorong', 'Busur derajat', 'Mistar baja'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Sebuah logam dipotong lurus. Potongan yang baik memiliki ciri-ciri...',
                'opsi' => ['Tidak rata dan kasar', 'Bergelombang dan retak', 'Lurus dan halus', 'Tidak terlihat tepinya'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Sumber energi utama dalam pengelasan SMAW adalah...',
                'opsi' => ['Panas dari sinar matahari', 'Energi listrik', 'Air bertekanan tinggi', 'Uap panas'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Zat yang dapat menyebabkan kebakaran saat proses las harus dijauhkan, contohnya...',
                'opsi' => ['Logam', 'Air', 'Kertas dan bensin', 'Udara'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Pekerjaan pengelasan berbahaya bagi kesehatan jika dilakukan tanpa...',
                'opsi' => ['Makan dulu', 'Pelindung dan ventilasi', 'Pencahayaan alami', 'Duduk'],
                'jawaban' => 1, // B
            ],
            [
                'pertanyaan' => 'Contoh benda hasil pengelasan yang digunakan sehari-hari adalah...',
                'opsi' => ['Kursi plastik', 'Panci aluminium', 'Rangka motor', 'Kipas angin'],
                'jawaban' => 2, // C
            ],
            [
                'pertanyaan' => 'Salah satu alasan memilih jurusan teknik pengelasan adalah...',
                'opsi' => ['Karena tidak ada pilihan lain', 'Karena ingin bekerja di bidang teknik', 'Karena ingin duduk di kantor', 'Karena mudah tanpa kerja keras'],
                'jawaban' => 1, // B
            ],
        ];


        $soalTPA = [];
        $kunciJawaban = [];

        $jurusan1 = $student->pilihan_jurusan_1; // misalnya 'Kuliner'
        $jurusan2 = $student->pilihan_jurusan_2; // misalnya 'Logistik'



        foreach ([$jurusan1, $jurusan2] as $jurusan) {
            if ($jurusan === 'Kuliner') {
                $soalTPA = array_merge($soalTPA, $soalKuliner);
                foreach ($soalKuliner as $soal) {
                    $kunciJawaban[] = $soal['jawaban'];
                }
            } elseif ($jurusan === 'Logistik') {
                $soalTPA = array_merge($soalTPA, $soalLogistik);
                foreach ($soalLogistik as $soal) {
                    $kunciJawaban[] = $soal['jawaban'];
                }
            } elseif ($jurusan === 'Pengelasan') {
                $soalTPA = array_merge($soalTPA, $soalPengelasan);
                foreach ($soalPengelasan as $soal) {
                    $kunciJawaban[] = $soal['jawaban'];
                }
            }
        }


        session(['tpa_kunci' => $kunciJawaban]);

        return view('student.exam.tpa', [
            'exam' => $exam,
            'studentExam' => $studentExam,
            'soalTPA' => $soalTPA
        ]);
    }

    public function submit(Request $request)
    {
        $user = Auth::user();
        $student = $user->student; // ini dapetin data dari table students
        $exam = Exam::where('name', 'TPA')->firstOrFail();

        $kunciJawaban = session('tpa_kunci');

        $score = 0;
        foreach ($kunciJawaban as $index => $kunci) {
            if ((int)($request->input('answers')[$index] ?? -1) === $kunci) {
                $score += 2; // bobot 2 per soal
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

        return redirect()
            ->route('student.exam.index');
    }
}
