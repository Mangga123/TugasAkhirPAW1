<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tagihan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($bills->isEmpty())
                    <div class="text-center py-10 text-gray-500">
                        <div class="mb-4 text-6xl">🎉</div>
                        <p class="text-lg">Hore! Tidak ada tagihan aktif saat ini.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($bills as $bill)
                            <!-- Card Tagihan -->
                            <div class="border rounded-xl p-6 shadow-sm hover:shadow-md transition duration-200 {{ $bill->status == 'Lunas' ? 'bg-green-50 border-green-200' : 'bg-white border-gray-200' }}">
                                
                                <!-- Header Card -->
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="font-bold text-xl text-gray-800">{{ $bill->month }}</h3>
                                        <p class="text-xs text-gray-500 mt-1">Jatuh Tempo: <span class="text-red-500">{{ \Carbon\Carbon::parse($bill->due_date)->format('d M Y') }}</span></p>
                                    </div>
                                    <div>
                                        @if($bill->status == 'Lunas')
                                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full border border-green-200">LUNAS</span>
                                        @elseif($bill->status == 'Menunggu Konfirmasi')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded-full border border-yellow-200">DIPROSES</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded-full border border-red-200">BELUM BAYAR</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Nominal -->
                                <div class="mb-6">
                                    <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">Total Tagihan</p>
                                    <p class="text-2xl font-extrabold text-gray-900 mt-1">Rp {{ number_format($bill->amount, 0, ',', '.') }}</p>
                                </div>

                                <!-- Alert jika Ditolak -->
                                @if($bill->payment && $bill->payment->status == 'Ditolak')
                                    <div class="bg-red-50 border-l-4 border-red-500 p-3 mb-4 rounded-r">
                                        <p class="text-xs text-red-800 font-bold">Pembayaran Ditolak!</p>
                                        <p class="text-xs text-red-600 italic mt-1">"{{ $bill->payment->admin_note }}"</p>
                                    </div>
                                @endif

                                <!-- Tombol Aksi (Footer Card) -->
                                <div class="border-t pt-4 mt-2">
                                    @if($bill->status == 'Belum Dibayar')
                                        <a href="{{ route('resident.payments.create', $bill->id) }}" class="flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out group">
                                            <span>
                                                @if($bill->payment && $bill->payment->status == 'Ditolak')
                                                    Upload Ulang Bukti
                                                @else
                                                    Bayar Sekarang 💳
                                                @endif
                                            </span>
                                        </a>
                                    @elseif($bill->status == 'Menunggu Konfirmasi')
                                        <button disabled class="flex items-center justify-center w-full bg-gray-100 text-gray-400 font-bold py-2 px-4 rounded-lg cursor-not-allowed border border-gray-200">
                                            ⏳ Menunggu Verifikasi
                                        </button>
                                    @else
                                        <button disabled class="flex items-center justify-center w-full bg-green-600 text-white font-bold py-2 px-4 rounded-lg cursor-default shadow-sm">
                                            ✅ Pembayaran Diterima
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>