<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Layanan Laporan & Keluhan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- FORM LAPOR BARU (Kiri) -->
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">📝 Buat Laporan Baru</h3>
                        <form action="{{ route('resident.complaints.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Masalah</label>
                                <input type="text" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" placeholder="Contoh: AC Bocor" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Detail</label>
                                <textarea name="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" placeholder="Jelaskan masalahnya..." required></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Foto (Opsional)</label>
                                <input type="file" name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                            </div>
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Kirim Laporan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- RIWAYAT LAPORAN (Kanan) -->
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">📜 Riwayat Laporan Saya</h3>
                        
                        @if($complaints->isEmpty())
                            <p class="text-gray-500 italic">Belum ada laporan.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($complaints as $complaint)
                                    <div class="border rounded-lg p-4 flex justify-between items-start bg-gray-50">
                                        <div>
                                            <h4 class="font-bold text-gray-800">{{ $complaint->title }}</h4>
                                            <p class="text-sm text-gray-600 mt-1">{{ $complaint->description }}</p>
                                            <p class="text-xs text-gray-400 mt-2">{{ $complaint->created_at->format('d M Y, H:i') }}</p>
                                            
                                            @if($complaint->image)
                                                <a href="{{ asset('complaints/'.$complaint->image) }}" target="_blank" class="text-blue-500 text-xs mt-2 inline-block underline">Lihat Foto</a>
                                            @endif
                                        </div>
                                        <div>
                                            @if($complaint->status == 'Pending')
                                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Menunggu</span>
                                            @elseif($complaint->status == 'Proses')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">Sedang Diproses</span>
                                            @else
                                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Selesai ✅</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>