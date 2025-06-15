<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Ujian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                    @endif
                    @if(session('info'))
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('info') }}</span>
                    </div>
                    @endif

                    <h3 class="text-lg font-medium text-gray-900 mb-4">Pilih Ujian yang Akan Dikerjakan:</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($exams as $exam)
                        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold mb-2">{{ $exam->name }}</h4>
                            <p class="text-gray-700">{{ $exam->description }}</p>
                            <p class="text-sm text-gray-500 mt-2">Durasi: {{ $exam->duration_minutes ? $exam->duration_minutes . ' menit' : 'Tidak terbatas' }}</p>

                            @php
                            $currentStudentExam = $studentExamStatuses->get($exam->id);
                            $isDisabled = false;
                            $buttonText = 'Mulai Ujian';
                            $buttonClass = 'bg-indigo-600 hover:bg-indigo-700';

                            // 👉 Untuk TKD
                            if ($exam->name === 'TKD') {
                            if ($currentStudentExam) {
                            if ($currentStudentExam->status === 'completed') {
                            $buttonText = 'Sudah Dikerjakan ✔️';
                            $buttonClass = 'bg-gray-400 cursor-not-allowed';
                            $isDisabled = true;
                            } elseif ($currentStudentExam->status === 'in_progress') {
                            $buttonText = 'Lanjutkan Ujian';
                            $buttonClass = 'bg-orange-500 hover:bg-orange-600';
                            $actionRoute = route('student.exam.tkd');
                            }
                            } else {
                            $buttonText = 'Mulai Mengerjakan';
                            $actionRoute = route('student.exam.tkd');
                            }
                            }

                            // 👉 Untuk TPA
                            elseif ($exam->name === 'TPA') {
                            if (!$canTakeTPA) {
                            $isDisabled = true;
                            $buttonText = 'Isi KEDUA Jurusan Dulu';
                            $buttonClass = 'bg-gray-400 cursor-not-allowed';
                            } elseif ($currentStudentExam) {
                            if ($currentStudentExam->status === 'completed') {
                            $buttonText = 'Sudah Dikerjakan ✔️';
                            $buttonClass = 'bg-gray-400 cursor-not-allowed';
                            $isDisabled = true;
                            } elseif ($currentStudentExam->status === 'in_progress') {
                            $buttonText = 'Lanjutkan Ujian';
                            $buttonClass = 'bg-orange-500 hover:bg-orange-600';
                            $actionRoute = route('student.exam.tpa');
                            }
                            } else {
                            $buttonText = 'Mulai Mengerjakan';
                            $actionRoute = route('student.exam.tpa');
                            }
                            }

                            // 👉 Untuk ujian lainnya
                            else {
                            if ($currentStudentExam) {
                            if ($currentStudentExam->status === 'completed') {
                            $buttonText = 'Sudah Dikerjakan ✔️';
                            $buttonClass = 'bg-gray-400 cursor-not-allowed';
                            $isDisabled = true;
                            } elseif ($currentStudentExam->status === 'in_progress') {
                            $buttonText = 'Lanjutkan Ujian';
                            $buttonClass = 'bg-orange-500 hover:bg-orange-600';
                            $actionRoute = route('student.exam.minatbakat', $exam);
                            }
                            } else {
                            $buttonText = 'Mulai Mengerjakan';
                            $actionRoute = route('student.exam.minatbakat', $exam);
                            }
                            }
                            @endphp



                            <div class="mt-4">
                                @if($isDisabled)
                                <span class="inline-block px-4 py-2 text-white rounded {{ $buttonClass }}">
                                    {{ __($buttonText) }}
                                </span>
                                @else
                                <a href="{{ $actionRoute }}" class="inline-block px-4 py-2 text-white rounded {{ $buttonClass }}">
                                    {{ __($buttonText) }}
                                </a>
                                @endif
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>