<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ujian TPA</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-lg p-6">
            <form method="POST" action="{{ route('ujian.tpa.submit') }}">
                @csrf

                @php
                $currentJurusan = '';
                @endphp

                @foreach ($soalTPA as $index => $soal)
                @if ($soal['jurusan'] !== $currentJurusan)
                <h3 class="text-lg font-bold text-indigo-700 mt-10 mb-4 border-t pt-6">
                    Soal Jurusan: {{ $soal['jurusan'] }}
                </h3>
                @php
                $currentJurusan = $soal['jurusan'];
                @endphp
                @endif

                <div class="mb-6">
                    <p class="font-medium text-gray-800">{{ $index + 1 }}. {{ $soal['pertanyaan'] }}</p>
                    <div class="mt-2 space-y-2">
                        @foreach ($soal['opsi'] as $i => $opsi)
                        <label class="flex items-center space-x-2 text-gray-700">
                            <input type="radio"
                                name="jawaban_{{ $soal['jurusan'] }}_{{ $index }}"
                                value="{{ $i }}"
                                class="text-indigo-600 focus:ring-indigo-500 border-gray-300">
                            <span>{{ $opsi }}</span>
                        </label>
                        @endforeach

                    </div>
                </div>
                @endforeach

                <div class="mt-8">
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-200">
                        Submit Jawaban
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>