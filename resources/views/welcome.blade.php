<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Akhir PAW</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full">
        <h1 class="text-3xl font-bold text-blue-600 mb-4">Sistem Akademik</h1>
        <p class="text-gray-600 mb-6">Selamat datang di Tugas Akhir PAW 1.</p>
        
        <div class="space-y-3">
            <a href="{{ route('login') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition">
                Login Akun
            </a>
            
            <a href="{{ route('register') }}" class="block w-full border border-blue-500 text-blue-500 hover:bg-blue-50 font-bold py-2 px-4 rounded transition">
                Register
            </a>
        </div>

        <div class="mt-8 text-xs text-gray-400">
            Database Connection: {{ DB::connection()->getDatabaseName() }}
        </div>
    </div>

</body>
</html>