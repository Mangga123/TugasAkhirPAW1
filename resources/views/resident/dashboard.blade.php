<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Penghuni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900">
                    Selamat datang, <strong>{{ Auth::user()->name }}</strong>!
                    <br>
                    <span class="text-sm text-gray-500">Status: Penghuni Apartemen</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-blue-50 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-blue-200">
                    <h3 class="font-bold text-blue-800 text-lg mb-2">Tagihan Saya</h3>
                    <p class="text-gray-600">Tidak ada tagihan aktif.</p>
                </div>
                
                <div class="bg-red-50 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-red-200">
                    <h3 class="font-bold text-red-800 text-lg mb-2">Lapor Kerusakan</h3>
                    <p class="text-gray-600">Ada fasilitas rusak? Lapor di sini.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>