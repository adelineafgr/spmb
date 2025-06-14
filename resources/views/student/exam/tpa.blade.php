<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ujian TPA</h2>
    </x-slot>

    <form method="POST" action="{{ route('ujian.tpa.submit') }}">
        @csrf
        <div class="py-12 max-w-4xl mx-auto space-y-8">
            @foreach($soalTPA as $index => $soal)
                <div class="bg-white p-6 rounded shadow">
                    <p class="mb-4 font-semibold">Soal {{ $index + 1 }}: {{ $soal['pertanyaan'] }}</p>
                    @foreach($soal['pilihan'] as $opsiIndex => $opsi)
                        <label class="block mb-2">
                            <input type="radio" name="answers[{{ $index }}]" value="{{ $opsiIndex }}" required>
                            {{ chr(65 + $opsiIndex) }}. {{ $opsi }}
                        </label>
                    @endforeach
                </div>
            @endforeach
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Kumpulkan Jawaban
            </button>
        </div>
    </form>
</x-app-layout>
