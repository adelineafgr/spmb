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
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">No.</th>
                                    <th scope="col" class="py-3 px-6">Nama</th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th scope="col" class="py-3 px-6">SMP Asal</th>
                                    <th scope="col" class="py-3 px-6">Jurusan Pilihan 1</th>
                                    <th scope="col" class="py-3 px-6">Jurusan Pilihan 2</th>
                                    <th scope="col" class="py-3 px-6">Skor TKD</th>
                                    <th scope="col" class="py-3 px-6">Skor TPA</th>
                                    <th scope="col" class="py-3 px-6">Skor Minat Bakat</th>
                                    <th scope="col" class="py-3 px-6">Total Skor</th>
                                    <th scope="col" class="py-3 px-6">Rekomendasi Jurusan</th>
                                    {{-- <th scope="col" class="py-3 px-6">Aksi</th> --}}
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
                                        <td class="py-4 px-6">{{ $student['skor_tkd'] }}</td>
                                        <td class="py-4 px-6">{{ $student['skor_tpa'] }}</td>
                                        <td class="py-4 px-6">{{ $student['skor_minat_bakat'] }}</td>
                                        <td class="py-4 px-6 font-bold">{{ $student['total_skor'] }}</td>
                                        <td class="py-4 px-6">{{ $student['rekomendasi_jurusan'] }}</td>
                                        {{-- <td class="py-4 px-6">
                                            <a href="{{ route('admin.students.show', $student['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">Detail</a>
                                            <a href="{{ route('admin.students.edit', $student['id']) }}" class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Edit</a>
                                        </td> --}}
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