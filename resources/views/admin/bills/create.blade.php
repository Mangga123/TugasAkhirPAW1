<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Tagihan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.bills.store') }}" method="POST">
                        @csrf
                        
                        <!-- Pilih Penghuni -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Penghuni / Unit</label>
                            <select name="resident_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                @foreach($residents as $res)
                                    <option value="{{ $res->id }}">
                                        Unit {{ $res->unit->unit_number }} - {{ $res->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Periode Bulan & Tahun -->
                        <div class="flex gap-4 mb-4">
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Bulan Tagihan</label>
                                <select name="month" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                    <option>Januari</option><option>Februari</option><option>Maret</option>
                                    <option>April</option><option>Mei</option><option>Juni</option>
                                    <option>Juli</option><option>Agustus</option><option>September</option>
                                    <option>Oktober</option><option selected>November</option><option>Desember</option>
                                </select>
                            </div>
                            <div class="w-1/2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tahun</label>
                                <input type="number" name="year" value="2025" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                            </div>
                        </div>

                        <!-- Jumlah Tagihan -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Total Tagihan (Rp)</label>
                            <input type="number" name="amount" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" placeholder="Contoh: 500000" required>
                        </div>

                        <!-- Jatuh Tempo -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Batas Pembayaran (Jatuh Tempo)</label>
                            <input type="date" name="due_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                        </div>

                        <div class="flex items-center justify-between">
                            <!-- TOMBOL DISINI SUDAH DIGANTI JADI BIRU (bg-blue-600) -->
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Buat Tagihan
                            </button>
                            <a href="{{ route('admin.bills.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-bold">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>