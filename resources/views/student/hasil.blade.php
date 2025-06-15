<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Ujian dan Rekomendasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-4">Skor Ujian:</h3>
                <ul class="list-disc list-inside text-gray-800">
                    <li><strong>TKD:</strong> {{ $skorTKD ?? 'Belum dikerjakan' }}</li>
                    <li><strong>TPA:</strong> {{ $skorTPA ?? 'Belum dikerjakan' }}</li>
                </ul>

                <h3 class="text-lg font-semibold mt-6 mb-2">Rekomendasi Jurusan:</h3>
                <p class="text-indigo-700 font-semibold text-xl">{{ $rekomendasi }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
