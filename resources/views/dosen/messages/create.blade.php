<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Jarkoman Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('messages.store') }}" method="POST" id="messageForm">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2">Kirim Kepada Siapa?</label>
                            <div class="flex space-x-4">
                                <label class="flex items-center p-4 border rounded cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="target_type" value="dosen" checked onclick="toggleTarget('dosen')" class="mr-2">
                                    <span class="font-bold text-blue-600">Sesama Dosen</span>
                                </label>
                                <label class="flex items-center p-4 border rounded cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="target_type" value="mahasiswa" onclick="toggleTarget('mahasiswa')" class="mr-2">
                                    <span class="font-bold text-green-600">Mahasiswa</span>
                                </label>
                            </div>
                        </div>

                        <div id="dosen-options" class="mb-6 border p-4 rounded bg-blue-50">
                            <h4 class="font-bold mb-2 text-blue-700">Pilih Rekan Dosen:</h4>
                            
                            <div class="mb-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" id="checkAll" onclick="toggleSelectAll(this)" class="form-checkbox h-5 w-5 text-blue-600">
                                    <span class="ml-2 text-sm font-bold">Pilih Semua Dosen</span>
                                </label>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2 max-h-40 overflow-y-auto">
                                @foreach($dosen as $d)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="dosen_ids[]" value="{{ $d->id }}" class="dosen-checkbox form-checkbox h-4 w-4 text-blue-600">
                                    <span class="ml-2 text-sm">{{ $d->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div id="mahasiswa-options" class="mb-6 border p-4 rounded bg-green-50 hidden">
                            <h4 class="font-bold mb-2 text-green-700">Filter Mahasiswa:</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold mb-1">Pilih Angkatan</label>
                                    <select name="angkatan" class="w-full border rounded p-2">
                                        <option value="all">-- Semua Angkatan --</option>
                                        @foreach($angkatan as $akt)
                                            <option value="{{ $akt }}">Angkatan {{ $akt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                </div>
                        </div>

                        <hr class="my-6">

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Judul Pesan / Perihal</label>
                            <input type="text" name="subject" class="w-full border rounded p-2" placeholder="Contoh: Undangan Rapat / Info Jarkom" required>
                        </div>

                        <div class="mb-2">
                            <span class="text-sm text-gray-500 mr-2">Template Cepat:</span>
                            <button type="button" onclick="isiTemplate('gmeet')" class="bg-gray-200 hover:bg-gray-300 text-xs px-2 py-1 rounded mr-1">📹 Link Gmeet</button>
                            <button type="button" onclick="isiTemplate('workshop')" class="bg-gray-200 hover:bg-gray-300 text-xs px-2 py-1 rounded mr-1">📅 Info Workshop</button>
                            <button type="button" onclick="isiTemplate('batal')" class="bg-gray-200 hover:bg-gray-300 text-xs px-2 py-1 rounded mr-1">❌ Batal Kelas</button>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-700 font-bold mb-2">Isi Pesan</label>
                            <textarea name="content" id="pesanArea" rows="6" class="w-full border rounded p-2" placeholder="Ketik pesan anda disini..." required></textarea>
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded shadow-lg">
                            🚀 Kirim Jarkoman
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 1. Fungsi Ganti Tab (Dosen vs Mahasiswa)
        function toggleTarget(type) {
            if (type === 'dosen') {
                document.getElementById('dosen-options').classList.remove('hidden');
                document.getElementById('mahasiswa-options').classList.add('hidden');
            } else {
                document.getElementById('dosen-options').classList.add('hidden');
                document.getElementById('mahasiswa-options').classList.remove('hidden');
            }
        }

        // 2. Fungsi Pilih Semua Dosen (Select All)
        function toggleSelectAll(source) {
            checkboxes = document.getElementsByClassName('dosen-checkbox');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        // 3. Fungsi Template Chat
        function isiTemplate(jenis) {
            let text = "";
            if(jenis === 'gmeet') {
                text = "Halo rekan-rekan/mahasiswa,\n\nBerikut adalah link Google Meet untuk pertemuan kita hari ini:\n[MASUKKAN LINK DISINI]\n\nHarap hadir tepat waktu. Terima kasih.";
            } else if (jenis === 'workshop') {
                text = "Diberitahukan kepada seluruh mahasiswa,\n\nAkan diadakan Workshop Teknologi Terbaru pada:\nHari/Tanggal: ...\nJam: ...\nTempat: ...\n\nWajib hadir bagi yang mengambil mata kuliah ini.";
            } else if (jenis === 'batal') {
                text = "Mohon maaf,\n\nPerkuliahan hari ini ditiadakan dikarenakan Dosen berhalangan hadir. Jadwal pengganti akan diinfokan menyusul.\n\nTerima kasih.";
            }
            document.getElementById('pesanArea').value = text;
        }
    </script>
</x-app-layout>