<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body>
    <div class="bg-gray-100 w-full min-h-screen flex flex-col">
        <livewire:layout.navbar />
        <div class="flex-1 px-4 flex flex-col">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>

</html>
