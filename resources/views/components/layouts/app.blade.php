<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('logos/logo_kabmalang.svg') }}">
    {{ seo()->render() }}

    @stack('head')

    <script>
        if (localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-base leading-normal tracking-tight text-text-dark dark:text-text-light antialiased transition-colors duration-300">
    <div
        class="min-h-screen
            bg-gradient-to-b
            from-white via-indigo-50/40 to-slate-100
            dark:from-gray-900 dark:via-gray-900 dark:to-gray-900">
        <div class="flex flex-col min-h-screen">
            <x-sections.header />
            <main class="flex-1 pt-28">
                {{ $slot }}
            </main>
            <x-sections.footer />
        </div>

        @livewireScriptConfig
        @stack('scripts')
    </div>
</body>

</html>
