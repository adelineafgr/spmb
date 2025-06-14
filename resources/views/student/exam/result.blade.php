<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Ujian: ') . $studentExam->exam->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Hasil Ujian {{ $studentExam->exam->name }}</h3>

                    @if($studentExam->exam->name === 'Minat Bakat')
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-6">
                            <p class="font-bold text-lg">Rekomendasi Jurusan Berdasarkan Minat Bakat Anda:</p>
                            <p class="text-xl mt-2">{{ $minatBakatRecommendation ?? 'Tidak dapat menentukan rekomendasi. Mungkin Anda tidak menjawab semua soal.' }}</p>
                        </div>
                    @else
                        <div class="mb-4">
                            <p class="text-lg">Total Skor Anda: <span class="font-bold text-green-600">{{ $studentExam->score }}</span></p>
                            @php
                                $totalQuestions = $studentExam->exam->questions->count();
                                $answeredQuestionsCount = $studentExam->studentAnswers->count();
                            @endphp
                            <p class="text-md text-gray-600">Total Soal Dijawab: {{ $answeredQuestionsCount }} dari {{ $totalQuestions }}</p>
                        </div>
                    @endif

                    <h4 class="text-xl font-semibold mb-4 mt-8">Detail Jawaban Anda:</h4>
                    <div class="space-y-6">
                        @foreach($studentExam->exam->questions->sortBy('id') as $question)
                            @php
                                $studentAnswer = $studentExam->studentAnswers->where('question_id', $question->id)->first();
                                $chosenAnswerText = $studentAnswer->chosenAnswer->answer_text ?? 'Tidak dijawab';
                                $isCorrect = ($studentExam->exam->name !== 'Minat Bakat' && $studentAnswer && $studentAnswer->chosenAnswer->is_correct);
                                $answerClass = '';
                                if ($studentExam->exam->name !== 'Minat Bakat') {
                                    $answerClass = $studentAnswer ? ($isCorrect ? 'bg-green-100 border-green-400' : 'bg-red-100 border-red-400') : 'bg-gray-100 border-gray-300';
                                } else {
                                    $answerClass = 'bg-indigo-100 border-indigo-400'; // Warna netral untuk minat bakat
                                }
                            @endphp
                            <div class="p-4 rounded-lg border {{ $answerClass }}">
                                <p class="font-medium text-gray-800 mb-2">
                                    {{ $loop->index + 1 }}. {!! nl2br(e($question->question_text)) !!}
                                </p>
                                <p class="text-sm text-gray-700">
                                    Jawaban Anda: <span class="font-semibold">{{ $chosenAnswerText }}</span>
                                    @if ($studentExam->exam->name !== 'Minat Bakat')
                                        @if ($studentAnswer)
                                            <span class="ml-2 font-bold {{ $isCorrect ? 'text-green-600' : 'text-red-600' }}">
                                                ({{ $isCorrect ? 'Benar' : 'Salah' }})
                                            </span>
                                        @else
                                            <span class="ml-2 font-bold text-gray-500">(Tidak Dijawab)</span>
                                        @endif
                                        @unless($isCorrect)
                                            <br>Jawaban Benar: <span class="font-semibold text-green-600">
                                                {{ $question->correct_answer->answer_text ?? 'N/A' }}
                                            </span>
                                        @endunless
                                    @else
                                        {{-- Untuk minat bakat, bisa tambahkan informasi pilihan A/B/C mengarah ke mana --}}
                                        @if ($studentAnswer && $studentAnswer->chosenAnswer->meta_data)
                                            <span class="ml-2 text-indigo-700 font-semibold">(Mengarah ke: {{ $studentAnswer->chosenAnswer->meta_data }})</span>
                                        @endif
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('student.exam.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            {{ __('Kembali ke Daftar Ujian') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>