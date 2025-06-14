<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ujian TKD
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white p-6 rounded shadow">
                <form method="POST" action="{{ route('student.exam.tkd.submit') }}">
                    @csrf

                    @foreach ($soalTKD as $index => $soal)
                    <div class="mb-6 border-b pb-4">
                        <p class="text-sm text-gray-500 mb-1">Mapel: <strong>{{ $soal['mapel'] }}</strong></p>
                        <p class="font-semibold mb-2">{{ $index + 1 }}. {{ $soal['pertanyaan'] }}</p>
                        @foreach ($soal['opsi'] as $opsiIndex => $opsi)
                        <label class="block mb-1">
                            <input type="radio" name="answers[{{ $index }}]" value="{{ $opsiIndex }}" required>
                            {{ chr(65 + $opsiIndex) }}. {{ $opsi }}
                        </label>
                        @endforeach
                    </div>
                    @endforeach

                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Kumpulkan Jawaban
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>