<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold text-blue-600">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-2 text-gray-600">Selamat datang di Sistem Akademik.</p>
                    
                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <p class="font-semibold">Status Akademik:</p>
                        <ul class="list-disc list-inside mt-2 text-sm text-gray-700">
                            <li>Angkatan: {{ Auth::user()->angkatan ?? '-' }}</li>
                            <li>Status: <span class="text-green-600 font-bold">Aktif</span></li>
                        </ul>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('messages.index') }}" class="block w-full text-left">
                            <div class="border p-4 rounded-lg shadow-sm hover:bg-gray-50 transition border-l-4 border-yellow-500 cursor-pointer flex justify-between items-center">
                                <div>
                                    <h4 class="font-bold text-lg text-gray-800">📩 Kotak Masuk Saya</h4>
                                    <p class="text-sm text-gray-500">Klik untuk melihat jarkoman atau pesan dari Dosen.</p>
                                </div>
                                <div class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                                    Cek Pesan
                                </div>
                            </div>
                        </a>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>