<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ujian: ') . $exam->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-semibold">{{ $exam->name }}</h3>
                    </div>

                    <form id="examForm" method="POST" action="{{ route('student.exam.submit', $exam) }}">
                        @csrf

                        @foreach($questions as $subjectName => $subjectQuestions)
                            <div class="mb-8 p-4 border rounded-lg bg-gray-50">
                                <h4 class="text-lg font-bold mb-4 text-indigo-700">Mata Pelajaran: {{ $subjectName }}</h4>

                                @foreach($subjectQuestions as $index => $question)
                                    <div class="mb-6 p-4 border border-gray-200 rounded-md bg-white shadow-sm">
                                        <p class="font-medium text-gray-800 mb-3">
                                            {{ ($index + 1) }}. {!! nl2br(e($question->question_text)) !!}
                                        </p>
                                        <div class="space-y-2">
                                            @foreach($question->answers as $answer)
                                                <label for="question_{{ $question->id }}_answer_{{ $answer->id }}" class="flex items-center text-gray-700 cursor-pointer p-2 rounded hover:bg-gray-100">
                                                    <input type="radio"
                                                           id="question_{{ $question->id }}_answer_{{ $answer->id }}"
                                                           name="answers[{{ $question->id }}]"
                                                           value="{{ $answer->id }}"
                                                           class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                                           {{-- Hapus atribut 'required' di sini --}}
                                                           {{ isset($studentAnswers[$question->id]) && $studentAnswers[$question->id]->answer_id == $answer->id ? 'checked' : '' }}>
                                                    <span class="ml-3">{{ $answer->answer_text }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="mt-8">
                            <x-primary-button type="submit">
                                {{ __('Selesai & Kumpulkan Ujian') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>