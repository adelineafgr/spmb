{{-- resources/views/student/exam/results.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Akhir Ujian & Rekomendasi Jurusan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-center">Rekap Hasil Ujian Anda</h3>

                    <div class="space-y-6">
                        {{-- Hasil Ujian TKD --}}
                        <div class="border rounded-lg p-4 bg-blue-50">
                            <h4 class="text-xl font-semibold mb-2 text-blue-800">Ujian TKD</h4>
                            @if($tkdResult)
                                <p>Skor Anda: <span class="font-bold text-lg">{{ $tkdResult->score ?? 'N/A' }}</span></p>
                                <p class="text-sm text-gray-600">Total soal TKD: {{ $tkdTotalQuestions ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600">Nilai per soal: 1 poin</p>
                            @else
                                <p class="text-red-600">Data Ujian TKD tidak ditemukan atau belum selesai.</p>
                            @endif
                        </div>

                        {{-- Hasil Ujian TPA --}}
                        <div class="border rounded-lg p-4 bg-green-50">
                            <h4 class="text-xl font-semibold mb-2 text-green-800">Ujian TPA</h4>
                            @if($tpaResult && $student)
                                <p>Skor {{ $student->pilihan_jurusan_1 ?? 'Jurusan 1' }}: <span class="font-bold text-lg">{{ $student->skor_jurusan_1 ?? 'N/A' }}</span></p>
                                <p>Skor {{ $student->pilihan_jurusan_2 ?? 'Jurusan 2' }}: <span class="font-bold text-lg">{{ $student->skor_jurusan_2 ?? 'N/A' }}</span></p>
                                <p>Rekomendasi TPA: <span class="font-bold text-lg text-green-700">{{ $tpaResult->notes ?? 'N/A' }}</span></p>
                                <p class="text-sm text-gray-600">Nilai per soal: 2 poin</p>
                            @else
                                <p class="text-red-600">Data Ujian TPA tidak ditemukan atau belum selesai.</p>
                            @endif
                        </div>

                        {{-- Hasil Ujian Minat Bakat --}}
                        <div class="border rounded-lg p-4 bg-yellow-50">
                            <h4 class="text-xl font-semibold mb-2 text-yellow-800">Tes Minat Bakat</h4>
                            @if($minatBakatResult)
                                <p>Rekomendasi Minat Bakat: <span class="font-bold text-lg text-yellow-700">{{ $minatBakatRecommendation ?? 'N/A' }}</span></p>
                                <p class="text-sm text-gray-600">Total poin Minat Bakat: {{ $minatBakatResult->score ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-600">Nilai per soal: 4 poin</p>
                            @else
                                <p class="text-red-600">Data Tes Minat Bakat tidak ditemukan atau belum selesai.</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8 pt-4 border-t border-gray-200">
                        <h3 class="text-2xl font-bold mb-4 text-center text-indigo-700">Rekomendasi Jurusan Akhir Anda</h3>
                        <p class="text-center text-xl font-semibold text-gray-800">
                            {{ $finalRecommendation }}
                        </p>
                        <p class="text-center text-sm text-gray-500 mt-2">
                            Rekomendasi ini didasarkan pada hasil Ujian TPA dan Tes Minat Bakat Anda.
                        </p>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="{{ route('student.dashboard') }}" class="px-6 py-3 bg-gray-600 text-white rounded hover:bg-gray-700 text-lg">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>