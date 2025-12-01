<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Bagian Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <!-- Card 1: Total Unit -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm uppercase font-bold tracking-wider">Total Unit</div>
                    <div class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUnits }}</div>
                </div>

                <!-- Card 2: Unit Terisi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm uppercase font-bold tracking-wider">Unit Terisi</div>
                    <div class="text-3xl font-bold text-green-600 mt-2">{{ $occupiedUnits }}</div>
                </div>

                <!-- Card 3: Total Penghuni -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                    <div class="text-gray-500 text-sm uppercase font-bold tracking-wider">Total Penghuni</div>
                    <div class="text-3xl font-bold text-indigo-600 mt-2">{{ $totalResidents }}</div>
                </div>

                <!-- Card 4: Komplain Pending -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500">
                    <div class="text-gray-500 text-sm uppercase font-bold tracking-wider">Komplain Baru</div>
                    <div class="text-3xl font-bold text-red-600 mt-2">{{ $pendingComplaints }}</div>
                </div>
            </div>

            <!-- Bagian Menu Cepat (Quick Actions) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 text-gray-700">🔧 Kelola Apartemen</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        <!-- Tombol 1: Kelola Unit -->
                        <a href="{{ route('admin.units.index') }}" class="flex items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group cursor-pointer">
                            <div class="text-center">
                                <span class="text-3xl mb-2 block">🏢</span>
                                <span class="font-bold text-gray-600 group-hover:text-blue-600">Kelola Data Unit</span>
                            </div>
                        </a>

                        <!-- Tombol 2: Kelola Penghuni -->
                        <a href="{{ route('admin.residents.index') }}" class="flex items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition group cursor-pointer">
                            <div class="text-center">
                                <span class="text-3xl mb-2 block">👥</span>
                                <span class="font-bold text-gray-600 group-hover:text-green-600">Kelola Penghuni</span>
                            </div>
                        </a>

                        <!-- Tombol 3: Kelola Tagihan (SUDAH DIAKTIFKAN ✅) -->
                        <a href="{{ route('admin.bills.index') }}" class="flex items-center justify-center p-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-indigo-500 hover:bg-indigo-50 transition group cursor-pointer">
                            <div class="text-center">
                                <span class="text-3xl mb-2 block">📄</span>
                                <span class="font-bold text-gray-600 group-hover:text-indigo-600">Kelola Tagihan</span>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>