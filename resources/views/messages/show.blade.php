<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Baca Pesan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="border-b pb-4 mb-4">
                        <h1 class="text-2xl font-bold mb-2">{{ $message->subject }}</h1>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                Dari: <span class="font-bold text-gray-800">{{ $message->sender->name }}</span> 
                                ({{ ucfirst($message->sender->role) }})
                            </div>
                            <div>
                                {{ $message->created_at->format('d F Y, H:i') }}
                            </div>
                        </div>
                    </div>

                    <div class="prose max-w-none mb-8 whitespace-pre-line text-gray-800">
                        {{ $message->content }}
                    </div>

                    <div class="flex justify-end">
                        @if(Auth::user()->role === 'dosen')
                            <a href="{{ route('dosen.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Kembali ke Dashboard</a>
                        @else
                            <a href="{{ route('student.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 mr-2">Kembali ke Dashboard</a>
                        @endif
                        
                        <a href="{{ route('messages.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Ke Kotak Masuk
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>