<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Unit Apartemen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-100">
                    
                    <div class="mb-6">
                        <a href="#" class="bg-emerald-700 text-white px-4 py-2 rounded-lg hover:bg-emerald-600 transition duration-200 shadow-md">
                            + Tambah Unit Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto rounded-lg shadow-lg">
                        <table class="min-w-full bg-gray-800 border border-gray-700">
                            <thead>
                                <tr class="bg-gray-700 text-gray-300 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">No Unit</th>
                                    <th class="py-3 px-6 text-left">Tower</th>
                                    <th class="py-3 px-6 text-left">Lantai</th>
                                    <th class="py-3 px-6 text-left">Tipe</th>
                                    <th class="py-3 px-6 text-center">Status</th>
                                    <th class="py-3 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-400 text-sm font-light">
                                @foreach ($units as $unit)
                                <tr class="border-b border-gray-700 hover:bg-gray-600 transition duration-150">
                                    <td class="py-3 px-6 text-left whitespace-nowrap font-bold text-gray-200">
                                        {{ $unit->unit_number }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $unit->tower }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $unit->floor }}
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $unit->type }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="py-1 px-3 rounded-full text-xs font-bold border border-opacity-20
                                            {{ $unit->status == 'Kosong' ? 'bg-green-900 text-green-300 border-green-500' : 
                                              ($unit->status == 'Terisi' ? 'bg-red-900 text-red-300 border-red-500' : 'bg-yellow-900 text-yellow-300 border-yellow-500') }}">
                                            {{ $unit->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center space-x-3">
                                            <button class="text-yellow-500 hover:text-yellow-300 transform hover:scale-110 transition">
                                                Edit
                                            </button>
                                            <button class="text-red-500 hover:text-red-300 transform hover:scale-110 transition">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>