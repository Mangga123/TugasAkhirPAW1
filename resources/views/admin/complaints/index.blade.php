<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Laporan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">Tgl & Pelapor</th>
                                    <th class="border px-4 py-2 text-left">Masalah</th>
                                    <th class="border px-4 py-2 text-left">Foto</th>
                                    <th class="border px-4 py-2 text-left">Status</th>
                                    <th class="border px-4 py-2 text-center">Update Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaints as $complaint)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">
                                            <div class="font-bold">{{ $complaint->resident->user->name ?? 'Anonim' }}</div>
                                            <div class="text-xs text-gray-500">Unit {{ $complaint->resident->unit->unit_number ?? '-' }}</div>
                                            <div class="text-xs text-gray-400">{{ $complaint->created_at->format('d/m/Y') }}</div>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <div class="font-bold text-gray-700">{{ $complaint->title }}</div>
                                            <div class="text-sm text-gray-600">{{ Str::limit($complaint->description, 50) }}</div>
                                        </td>
                                        <td class="border px-4 py-2">
                                            @if($complaint->image)
                                                <a href="{{ asset('complaints/'.$complaint->image) }}" target="_blank" class="text-blue-600 underline text-sm">Lihat</a>
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2">
                                             @if($complaint->status == 'Pending')
                                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">Pending</span>
                                            @elseif($complaint->status == 'Proses')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">Proses</span>
                                            @else
                                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <form action="{{ route('admin.complaints.update', $complaint->id) }}" method="POST" class="flex items-center justify-center space-x-2">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" class="text-sm border rounded px-2 py-1">
                                                    <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Proses" {{ $complaint->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="Selesai" {{ $complaint->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-1 px-2 rounded">
                                                    Simpan
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $complaints->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>