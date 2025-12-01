<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Tagihan Bulanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Daftar Tagihan</h3>
                        <a href="{{ route('admin.bills.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                            + Buat Tagihan Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left text-gray-600">Unit & Penghuni</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Periode</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Total</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Status</th>
                                    <th class="border px-4 py-2 text-left text-gray-600">Bukti Bayar</th>
                                    <th class="border px-4 py-2 text-center text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bills as $bill)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">
                                            <div class="font-bold text-gray-800">Unit {{ $bill->resident->unit->unit_number ?? '-' }}</div>
                                            <div class="text-sm text-gray-500">{{ $bill->resident->user->name ?? 'User Hapus' }}</div>
                                        </td>
                                        <td class="border px-4 py-2 text-gray-700">{{ $bill->month }}</td>
                                        <td class="border px-4 py-2 font-bold text-gray-900">
                                            Rp {{ number_format($bill->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if($bill->status == 'Lunas')
                                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Lunas</span>
                                            @elseif($bill->status == 'Menunggu Konfirmasi')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded">Cek Bukti!</span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-0.5 rounded">Belum Bayar</span>
                                            @endif
                                        </td>
                                        
                                        <!-- KOLOM BUKTI BAYAR -->
                                        <td class="border px-4 py-2">
                                            @if($bill->payment && $bill->payment->proof_image)
                                                <a href="{{ asset('payments/' . $bill->payment->proof_image) }}" target="_blank" class="text-blue-600 hover:underline text-sm font-bold">
                                                    📷 Lihat Foto
                                                </a>
                                                <div class="text-xs text-gray-500 mt-1">Tgl: {{ $bill->payment->payment_date }}</div>
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>

                                        <!-- KOLOM AKSI -->
                                        <td class="border px-4 py-2 text-center">
                                            @if($bill->status == 'Menunggu Konfirmasi')
                                                <!-- TAMPILKAN TOMBOL TERIMA / TOLAK -->
                                                <div class="flex flex-col space-y-2">
                                                    <!-- Form Terima -->
                                                    <form action="{{ route('admin.bills.confirm', $bill->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="action" value="accept">
                                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-xs font-bold py-1 px-2 rounded w-full shadow">
                                                            ✅ Terima
                                                        </button>
                                                    </form>
                                                    
                                                    <!-- Tombol Tolak (Trigger JS) -->
                                                    <button onclick="rejectPayment({{ $bill->id }})" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-1 px-2 rounded w-full shadow">
                                                        ❌ Tolak
                                                    </button>
                                                    
                                                    <!-- Form Hidden untuk Tolak -->
                                                    <form id="reject-form-{{ $bill->id }}" action="{{ route('admin.bills.confirm', $bill->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        <input type="hidden" name="action" value="reject">
                                                        <input type="hidden" name="admin_note" id="note-{{ $bill->id }}">
                                                    </form>
                                                </div>
                                            @else
                                                <!-- Tombol Hapus Biasa -->
                                                <form action="{{ route('admin.bills.destroy', $bill->id) }}" method="POST" onsubmit="return confirm('Hapus tagihan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm">Hapus</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="border px-4 py-8 text-center text-gray-400 italic">
                                            Belum ada data tagihan. Silakan buat tagihan baru.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $bills->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Script Sederhana untuk Input Alasan Tolak -->
    <script>
        function rejectPayment(id) {
            let note = prompt("Masukkan alasan penolakan (Wajib diisi):", "Bukti transfer tidak jelas / Salah nominal.");
            if (note != null && note.trim() !== "") {
                document.getElementById('note-' + id).value = note;
                document.getElementById('reject-form-' + id).submit();
            } else if (note != null) {
                alert("Alasan penolakan tidak boleh kosong!");
            }
        }
    </script>
</x-app-layout>