<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar data siswa yang ingin Anda buat
        $studentsData = [
            [
                'name' => 'Siswa Kuliner',
                'email' => 'kuliner@example.com',
                'password' => 'password', // Gunakan password yang mudah diingat untuk development
                'smp' => 'SMP Maju Jaya',
                'pilihan_jurusan_1' => 'Kuliner',
                'pilihan_jurusan_2' => 'Logistik',
            ],
            [
                'name' => 'Siswa Logistik',
                'email' => 'logistik@example.com',
                'password' => 'password',
                'smp' => 'SMP Harapan Bangsa',
                'pilihan_jurusan_1' => 'Logistik',
                'pilihan_jurusan_2' => 'Kuliner',
            ],
            [
                'name' => 'Siswa Pengelasan',
                'email' => 'pengelasan@example.com',
                'password' => 'password',
                'smp' => 'SMP Inspirasi',
                'pilihan_jurusan_1' => 'Pengelasan',
                'pilihan_jurusan_2' => 'Kuliner',
            ],
            [
                'name' => 'Siswa Belum Daftar', // Siswa ini tidak akan memiliki data Student
                'email' => 'belumdaftar@example.com',
                'password' => 'password',
                'smp' => null, // Tidak ada data pendaftaran awal
                'pilihan_jurusan_1' => null,
                'pilihan_jurusan_2' => null,
            ],
        ];

        foreach ($studentsData as $data) {
            // Buat user baru dengan role 'siswa'
            $user = User::firstOrCreate(
                ['email' => $data['email']], // Cari berdasarkan email untuk menghindari duplikasi
                [
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'role' => 'siswa',
                    'email_verified_at' => now(), // Anggap sudah terverifikasi untuk kemudahan
                ]
            );

            // Jika user berhasil dibuat/ditemukan dan memiliki data pendaftaran
            if ($user && $data['smp']) {
                // Buat data Student yang berelasi dengan User ini
                Student::firstOrCreate(
                    ['user_id' => $user->id], // Pastikan hanya satu Student per User
                    [
                        'smp' => $data['smp'],
                        'pilihan_jurusan_1' => $data['pilihan_jurusan_1'],
                        'pilihan_jurusan_2' => $data['pilihan_jurusan_2'],
                    ]
                );
            }
        }
    }
}
