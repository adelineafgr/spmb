<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Siswa</h3>
                    <p><strong>Nama:</strong> {{ $student->user->name }}</p>
                    <p><strong>Email:</strong> {{ $student->user->email }}</p>
                    <p><strong>Asal SMP:</strong> {{ $student->smp }}</p>
                    <p><strong>Pilihan Jurusan 1:</strong> {{ $student->pilihan_jurusan_1 }}</p>
                    <p><strong>Pilihan Jurusan 2:</strong> {{ $student->pilihan_jurusan_2 }}</p>

                    <div class="mt-6">
                        <a href="{{ route('admin.students.index') }}" class="text-blue-500 hover:underline">Kembali ke Daftar Siswa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>