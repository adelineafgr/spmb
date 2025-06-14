{{-- resources/views/admin/dashboard.blade.php --}}
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-4">Selamat datang di Dashboard Admin!</h3>
                    <p class="mb-6">Ini adalah area admin utama. Anda bisa menambahkan ringkasan atau widget di sini.</p>

                    {{-- Contoh: Tampilkan total siswa jika AdminController masih menyediakannya --}}
                    @isset($totalStudents)
                        <p>Total Siswa Terdaftar: <span class="font-bold">{{ $totalStudents }}</span></p>
                    @endisset

                    {{-- Mungkin tambahkan tombol "Lihat Data Siswa" di sini --}}
                    <div class="mt-4">
                        <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Lihat Data Siswa
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>