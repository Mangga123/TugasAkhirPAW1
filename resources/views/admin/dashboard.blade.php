<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard - Sistem Akademik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-medium">TOTAL PENGGUNA</div>
                    <div class="text-3xl font-bold text-gray-800">{{ \App\Models\User::count() }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm font-medium">MAHASISWA</div>
                    <div class="text-3xl font-bold text-gray-800">{{ \App\Models\User::where('role', 'mahasiswa')->count() }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-gray-500 text-sm font-medium">DOSEN</div>
                    <div class="text-3xl font-bold text-gray-800">{{ \App\Models\User::where('role', 'dosen')->count() }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Menu Kelola Akademik</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <a href="{{ route('mahasiswa.index') }}" class="block border p-4 rounded hover:bg-blue-50 cursor-pointer transition transform hover:-translate-y-1 hover:shadow-md">
                            <h4 class="font-bold text-blue-600 text-lg">📁 Data Mahasiswa</h4>
                            <p class="text-sm text-gray-500 mt-1">Kelola data mahasiswa aktif, angkatan, dan akun.</p>
                        </a>
                        
                        <a href="{{ route('dosen.index') }}" class="block border p-4 rounded hover:bg-blue-50 cursor-pointer transition transform hover:-translate-y-1 hover:shadow-md">
                            <h4 class="font-bold text-blue-600 text-lg">🎓 Data Dosen</h4>
                            <p class="text-sm text-gray-500 mt-1">Kelola data dosen, NIP, dan departemen pengajar.</p>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>