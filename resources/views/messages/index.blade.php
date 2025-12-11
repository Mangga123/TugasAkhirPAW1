<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kotak Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-4">
                @php
                    // Cek role user untuk menentukan arah pulang
                    $dashboardRoute = route('dashboard'); // Default (Admin)
                    if (Auth::user()->role === 'dosen') {
                        $dashboardRoute = route('dosen.dashboard');
                    } elseif (Auth::user()->role === 'mahasiswa') {
                        $dashboardRoute = route('student.dashboard');
                    }
                @endphp

                <a href="{{ $dashboardRoute }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-bold transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="font-bold text-lg mb-4 text-gray-800">Pesan Masuk ({{ $messages->count() }})</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100 text-gray-600 text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Pengirim</th>
                                    <th class="py-3 px-6 text-left">Subjek</th>
                                    <th class="py-3 px-6 text-center">Tanggal</th>
                                    <th class="py-3 px-6 text-center">Status</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                @forelse($messages as $msg)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 {{ $msg->is_read ? '' : 'bg-blue-50 font-bold' }}">
                                    <td class="py-3 px-6 text-left">
                                        <div class="flex items-center">
                                            <div class="mr-2">
                                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold text-xs uppercase">
                                                    {{ substr($msg->sender->name, 0, 2) }}
                                                </div>
                                            </div>
                                            <div>
                                                {{ $msg->sender->name }} <br>
                                                <span class="text-xs text-gray-400">({{ ucfirst($msg->sender->role) }})</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $msg->subject }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        {{ $msg->created_at->format('d M Y, H:i') }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if($msg->is_read)
                                            <span class="text-gray-500 text-xs">Sudah Dibaca</span>
                                        @else
                                            <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-xs font-bold animate-pulse">Baru</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <a href="{{ route('messages.show', $msg->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-xs font-bold transition shadow">
                                            Baca Isi
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-gray-400 bg-gray-50 rounded">
                                        <p class="mb-2 text-2xl">📭</p>
                                        Belum ada pesan masuk untuk Anda.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>