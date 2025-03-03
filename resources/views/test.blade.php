<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/ts/app.ts'])
    @endif
</head>
<body class="bg-gray-900">
    <header>
    </header>
    <main class="flex justify-center items-center mt-16">
        <div class="bg-white text-black w-1/2 p-6 rounded-lg shadow-lg">
            <counter-component data-initial-count="{{ json_encode($initialCount ?? 0) }}"></counter-component>
        </div>
    </main>
</body>
</html>