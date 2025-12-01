<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Unit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Pesan Sukses (Jika ada) -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Tombol Tambah Data -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Daftar Unit Apartemen</h3>
                        <a href="{{ route('admin.units.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Tambah Unit Baru
                        </a>
                    </div>

                    <!-- Tabel Data -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">No. Unit</th>
                                    <th class="border px-4 py-2 text-left">Tower</th>
                                    <th class="border px-4 py-2 text-left">Lantai</th>
                                    <th class="border px-4 py-2 text-left">Tipe</th>
                                    <th class="border px-4 py-2 text-left">Status</th>
                                    <th class="border px-4 py-2 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($units as $unit)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2 font-bold">{{ $unit->unit_number }}</td>
                                        <td class="border px-4 py-2">{{ $unit->tower }}</td>
                                        <td class="border px-4 py-2">{{ $unit->floor }}</td>
                                        <td class="border px-4 py-2">{{ $unit->type }}</td>
                                        <td class="border px-4 py-2">
                                            @if($unit->status == 'Terisi')
                                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Terisi</span>
                                            @elseif($unit->status == 'Kosong')
                                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Kosong</span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Maintenance</span>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('admin.units.edit', $unit->id) }}" class="text-yellow-600 hover:text-yellow-900 font-bold">Edit</a>
                                                
                                                <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus unit ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $units->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>