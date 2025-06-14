<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Selamat datang, {{ Auth::user()->name }}!

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('info') }}</span>
                        </div>
                    @endif

                    {{-- Kondisi jika studentData sudah ada --}}
                    @if($studentData)
                        <h3 class="text-lg font-medium text-gray-900 mt-4">Data Pendaftaran Anda:</h3>
                        <p><strong>Asal SMP:</strong> {{ $studentData->smp }}</p>
                        <p><strong>Pilihan Jurusan 1:</strong> {{ $studentData->pilihan_jurusan_1 }}</p>
                        <p><strong>Pilihan Jurusan 2:</strong> {{ $studentData->pilihan_jurusan_2 }}</p>

                        <div class="mt-4 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">

                            {{-- Tombol untuk melihat daftar ujian --}}
                            <a href="{{ route('student.exam.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Mulai Ujian') }}
                            </a>
                        </div>
                    @else
                        {{-- Kondisi jika studentData belum ada --}}
                        <p class="mt-4">Anda belum mengisi data pendaftaran. Silakan lengkapi data Anda untuk melanjutkan.</p>
                        <div class="mt-4">
                            <a href="{{ route('student.register_data.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Isi Data Pendaftaran') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>