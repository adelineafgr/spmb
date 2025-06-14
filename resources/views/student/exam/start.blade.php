<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Halaman Ujian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Selamat Mengerjakan Ujian!</h3>
                    <p>Di sini akan ada logika dan pertanyaan-pertanyaan ujian.</p>
                    <p class="mt-4 text-sm text-gray-600">Fitur ujian akan dikembangkan lebih lanjut.</p>
                    <div class="mt-6">
                        <a href="{{ route('student.dashboard') }}" class="text-blue-500 hover:underline">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>