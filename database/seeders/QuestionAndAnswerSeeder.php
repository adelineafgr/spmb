<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class QuestionAndAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questionsData = [
            [
                'question_text' => 'Logistik adalah kegiatan yang berkaitan dengan...',
                'answers' => [
                    ['answer_text' => 'Pemasangan listrik', 'is_correct' => false],
                    ['answer_text' => 'Pengelolaan barang dari tempat asal ke tujuan', 'is_correct' => true],
                    ['answer_text' => 'Pembangunan jalan', 'is_correct' => false],
                    ['answer_text' => 'Penggunaan komputer', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Tempat menyimpan barang dalam kegiatan logistik disebut...',
                'answers' => [
                    ['answer_text' => 'Laboratorium', 'is_correct' => false],
                    ['answer_text' => 'Gudang', 'is_correct' => true],
                    ['answer_text' => 'Kantor', 'is_correct' => false],
                    ['answer_text' => 'Bengkel', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Yang termasuk alat angkut darat dalam logistik adalah...',
                'answers' => [
                    ['answer_text' => 'Kapal laut', 'is_correct' => false],
                    ['answer_text' => 'Truk', 'is_correct' => true],
                    ['answer_text' => 'Pesawat terbang', 'is_correct' => false],
                    ['answer_text' => 'Perahu motor', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Salah satu tujuan pengemasan barang dalam logistik adalah...',
                'answers' => [
                    ['answer_text' => 'Menambah berat barang', 'is_correct' => false],
                    ['answer_text' => 'Menyulitkan pengangkutan', 'is_correct' => false],
                    ['answer_text' => 'Melindungi barang dari kerusakan', 'is_correct' => true],
                    ['answer_text' => 'Mempercepat produksi', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Dokumen yang mencatat daftar barang kiriman disebut...',
                'answers' => [
                    ['answer_text' => 'Nota belanja', 'is_correct' => false],
                    ['answer_text' => 'Faktur', 'is_correct' => false],
                    ['answer_text' => 'Daftar hadir', 'is_correct' => false],
                    ['answer_text' => 'Surat jalan', 'is_correct' => true],
                ]
            ],
            [
                'question_text' => 'Petugas yang mengatur lalu lintas barang di gudang disebut...',
                'answers' => [
                    ['answer_text' => 'Teknisi', 'is_correct' => false],
                    ['answer_text' => 'Operator mesin', 'is_correct' => false],
                    ['answer_text' => 'Admin logistik', 'is_correct' => true],
                    ['answer_text' => 'Mekanik', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Kegiatan memuat dan membongkar barang disebut juga dengan...',
                'answers' => [
                    ['answer_text' => 'Pengiriman', 'is_correct' => false],
                    ['answer_text' => 'Pendistribusian', 'is_correct' => false],
                    ['answer_text' => 'Bongkar muat', 'is_correct' => true],
                    ['answer_text' => 'Produksi', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Alat berikut ini sering digunakan untuk memindahkan barang di gudang adalah...',
                'answers' => [
                    ['answer_text' => 'Forklift', 'is_correct' => true],
                    ['answer_text' => 'Sepeda', 'is_correct' => false],
                    ['answer_text' => 'Obeng', 'is_correct' => false],
                    ['answer_text' => 'Palu', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Barang yang mudah rusak seperti makanan harus dikirim dengan...',
                'answers' => [
                    ['answer_text' => 'Truk terbuka', 'is_correct' => false],
                    ['answer_text' => 'Wadah tertutup dan dingin', 'is_correct' => true],
                    ['answer_text' => 'Plastik hitam', 'is_correct' => false],
                    ['answer_text' => 'Kotak kardus biasa', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Pekerjaan di bidang logistik membutuhkan keterampilan dalam hal...',
                'answers' => [
                    ['answer_text' => 'Menyanyi dan menari', 'is_correct' => false],
                    ['answer_text' => 'Menghitung, mencatat, dan mengatur barang', 'is_correct' => true],
                    ['answer_text' => 'Menggambar dan mewarnai', 'is_correct' => false],
                    ['answer_text' => 'Memahat batu', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Alur logistik dimulai dari...',
                'answers' => [
                    ['answer_text' => 'Gudang ke pelanggan', 'is_correct' => false],
                    ['answer_text' => 'Produksi ke pengemasan', 'is_correct' => false],
                    ['answer_text' => 'Sumber bahan ke pelanggan akhir', 'is_correct' => true],
                    ['answer_text' => 'Pengiriman ke pengemasan', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Salah satu manfaat teknologi informasi dalam logistik adalah...',
                'answers' => [
                    ['answer_text' => 'Membuat barang lebih murah', 'is_correct' => false],
                    ['answer_text' => 'Membantu pelacakan barang', 'is_correct' => true],
                    ['answer_text' => 'Menambah ukuran gudang', 'is_correct' => false],
                    ['answer_text' => 'Mengurangi jumlah karyawan', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Waktu pengiriman barang harus...',
                'answers' => [
                    ['answer_text' => 'Tidak menentu', 'is_correct' => false],
                    ['answer_text' => 'Sesuai cuaca', 'is_correct' => false],
                    ['answer_text' => 'Tepat waktu', 'is_correct' => true],
                    ['answer_text' => 'Bergantung supir', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Istilah ekspedisi dalam dunia logistik berarti...',
                'answers' => [
                    ['answer_text' => 'Perjalanan wisata', 'is_correct' => false],
                    ['answer_text' => 'Perjalanan pengiriman barang', 'is_correct' => true],
                    ['answer_text' => 'Pembuatan barang', 'is_correct' => false],
                    ['answer_text' => 'Perjalanan kapal laut', 'is_correct' => false],
                ]
            ],
            [
                'question_text' => 'Salah satu alasan memilih jurusan teknik logistik adalah...',
                'answers' => [
                    ['answer_text' => 'Tidak ada pilihan lain', 'is_correct' => false],
                    ['answer_text' => 'Karena ingin mengatur alur distribusi barang', 'is_correct' => true],
                    ['answer_text' => 'Karena tidak suka hitung-hitungan', 'is_correct' => false],
                    ['answer_text' => 'Karena tidak suka bekerja', 'is_correct' => false],
                ]
            ],
        ];

        foreach ($questionsData as $data) {
            $question = Question::create([
                'exam_id' => 1, // **IMPORTANT: Adjust this exam_id as needed**
                'subject_id' => 1, // **IMPORTANT: Adjust this subject_id as needed, or set to null if not applicable**
                'question_text' => $data['question_text'],
            ]);

            foreach ($data['answers'] as $answerData) {
                $question->answers()->create([
                    'answer_text' => $answerData['answer_text'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }
        }
    }
}
