<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#111827]">
            
            <div class="mb-6">
                <h1 class="text-4xl font-bold text-[#A8E6CF]">Sistem Akademik</h1>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-[#1F2937] shadow-md overflow-hidden sm:rounded-lg border border-gray-700">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>