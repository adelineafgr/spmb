<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pendaftaran Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('student.register_data.update') }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="smp" :value="__('Asal SMP')" />
                            <x-text-input id="smp" class="block mt-1 w-full" type="text" name="smp" :value="old('smp', $studentData->smp)" required autofocus />
                            <x-input-error :messages="$errors->get('smp')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="pilihan_jurusan_1" :value="__('Pilihan Jurusan 1')" />
                            <select id="pilihan_jurusan_1" name="pilihan_jurusan_1" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $j)
                                    <option value="{{ $j }}" {{ old('pilihan_jurusan_1', $studentData->pilihan_jurusan_1) == $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('pilihan_jurusan_1')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="pilihan_jurusan_2" :value="__('Pilihan Jurusan 2')" />
                            <select id="pilihan_jurusan_2" name="pilihan_jurusan_2" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $j)
                                    <option value="{{ $j }}" {{ old('pilihan_jurusan_2', $studentData->pilihan_jurusan_2) == $j ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('pilihan_jurusan_2')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Update Data') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>