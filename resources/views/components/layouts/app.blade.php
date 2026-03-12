<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('logos/logo_kabmalang.svg') }}">
    {{ seo()->render() }}

    @stack('head')

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" :class="{ 'dark': darkMode }"
    class="font-sans text-base leading-normal tracking-tight text-text-dark bg-light dark:bg-dark dark:text-text-light antialiased transition-colors duration-300">

    <div class="flex flex-col min-h-screen">
        <x-sections.header />
        <main class="flex-1 pt-28">
            {{ $slot }}
        </main>
        <x-sections.footer />
    </div>

    @livewireScriptConfig
    @stack('scripts')
</body>

</html>
