<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Financial Adviser CRM' }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/ts/app.ts'])
    @endif
</head>
<body class="bg-gray-900 flex flex-col min-h-screen">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <a href="/" class="text-xl font-bold">{{ config('app.title') }}</a>
            <div>
                @auth
                    <span class="mr-4">Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700">Login</a>
                @endauth
            </div>
        </div>
    </header>
    
    <main class="flex-grow flex justify-center items-center py-16">
        @yield('content')
    </main>
    
    <footer class="bg-gray-800 py-4 mt-auto">
        <div class="container mx-auto px-4 text-center text-gray-400 text-sm">
            &copy; {{ date('Y') }} {{ config('app.title', 'Financial Adviser CRM') }}. All rights reserved.
        </div>
    </footer>
</body>
</html>