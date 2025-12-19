@component('layouts.dosen-panel')

<div class="flex flex-col md:flex-row md:items-center justify-between p-2 mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800 tracking-tight">
            Selamat datang, <span class="text-gray-900">{{ Auth::user()->name }}.</span>
        </h1>
        <p class="text-gray-500 mt-2 text-lg font-medium">
            Ringkasan aktivitas akademik Anda hari ini.
        </p>
    </div>
    
    <div class="mt-4 md:mt-0 text-right">
        <span class="text-sm font-bold uppercase tracking-widest" style="color: #9F3E28;">
            Semester Ganjil
        </span>
        <div class="text-gray-400 text-sm">2025/2026</div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    
    <div class="bg-white p-8 rounded-[30px] border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="relative z-10">
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Buat Pesan Baru</h3>
            <p class="text-gray-500 mb-8 h-12">Kirim pengumuman atau tugas kepada mahasiswa.</p>
            
            <a href="{{ route('messages.create') }}" class="inline-flex items-center font-bold transition group-hover:gap-2" style="color: #9F3E28;">
                Tulis Sekarang 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>

    <div class="bg-white p-8 rounded-[30px] border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
        <div class="relative z-10">
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Kotak Masuk</h3>
            <p class="text-gray-500 mb-8 h-12">Cek pesan dan notifikasi terbaru Anda.</p>
            
            <a href="{{ route('messages.index') }}" class="inline-flex items-center font-bold transition group-hover:gap-2" style="color: #9F3E28;">
                Lihat Inbox
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>

</div>

<div class="bg-white rounded-[30px] p-8 border border-gray-100 shadow-sm flex flex-col md:flex-row justify-around items-center gap-8">
    <div class="text-center">
        <div class="text-4xl font-bold text-gray-800">12</div>
        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Pesan Terkirim</div>
    </div>
    <div class="hidden md:block w-px h-12 bg-gray-100"></div>
    <div class="text-center">
        <div class="text-4xl font-bold text-gray-800">3</div>
        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Menunggu Respon</div>
    </div>
    <div class="hidden md:block w-px h-12 bg-gray-100"></div>
    <div class="text-center">
        <div class="text-4xl font-bold text-gray-800">2</div>
        <div class="text-xs font-bold text-gray-400 uppercase tracking-widest mt-1">Total Mahasiswa</div>
    </div>
</div>

@endcomponent