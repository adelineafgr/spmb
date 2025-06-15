{{-- resources/views/admin/students/index.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Daftar Lengkap Siswa</h3>
                    {{-- Tabel Data Siswa --}}
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-300 border-collapse">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th rowspan="2" class="py-3 px-6">No.</th>
                                    <th rowspan="2" class="py-3 px-6">Nama</th>
                                    <th rowspan="2" class="py-3 px-6">Email</th>
                                    <th rowspan="2" class="py-3 px-6">SMP Asal</th>
                                    <th rowspan="2" class="py-3 px-6">Jurusan 1</th>
                                    <th rowspan="2" class="py-3 px-6">Jurusan 2</th>
                                    <th rowspan="2" class="py-3 px-6">Skor TKD</th>
                                    <th colspan="2" class="py-3 px-6 text-center">TPA</th>
                                    <th colspan="2" class="py-3 px-6 text-center">Minat Bakat</th>
                                    <th rowspan="2" class="py-3 px-6">Total Skor</th>
                                    <th rowspan="2" class="py-3 px-6">Rekomendasi Jurusan</th>
                                </tr>
                                <tr>
                                    <th class="py-3 px-6">Skor</th>
                                    <th class="py-3 px-6">Jurusan</th>
                                    <th class="py-3 px-6">Skor</th>
                                    <th class="py-3 px-6">Jurusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($studentsData as $student)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="py-4 px-6">{{ $loop->iteration }}</td>
                                        <td class="py-4 px-6">{{ $student['name'] }}</td>
                                        <td class="py-4 px-6">{{ $student['email'] }}</td>
                                        <td class="py-4 px-6">{{ $student['smp'] ?? '-' }}</td>
                                        <td class="py-4 px-6">{{ $student['pilihan_jurusan_1'] ?? '-' }}</td>
                                        <td class="py-4 px-6">{{ $student['pilihan_jurusan_2'] ?? '-' }}</td>
                                        <td class="py-4 px-6">{{ $student['skor_tkd'] ?? 0 }}</td>
                                        <td class="py-4 px-6">{{ $student['skor_tpa'] ?? 0 }}</td>
                                        <td class="py-4 px-6">{{ $student['recommended_major'] ?? '-' }}</td>
                                        <td class="py-4 px-6">{{ $student['skor_minat_bakat'] ?? 0 }}</td>
                                        <td class="py-4 px-6">{{ $student['recommended_major'] ?? '-' }}</td>
                                        <td class="py-4 px-6 font-bold">{{ $student['total_skor'] ?? 0 }}</td>
                                        <td class="py-4 px-6">{{ $student['recommended_major'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="py-4 px-6 text-center text-gray-500">
                                            Tidak ada data siswa yang tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>