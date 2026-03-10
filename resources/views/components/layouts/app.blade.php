<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    {{ seo()->render() }}

    @stack('head')

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Integrasi Alpine.js untuk Dark Mode agar tombol toggle di Header berfungsi --}}

<body x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" :class="{ 'dark': darkMode }"
    class="font-sans text-base leading-normal tracking-tight text-text-dark bg-light dark:bg-dark dark:text-text-light antialiased transition-colors duration-300">
    <div class="flex flex-col min-h-screen">
        {{-- Header sekarang bertipe fixed, jadi kita perlu padding-top di main --}}
        <x-sections.header />

        {{-- Menggunakan pt-24 atau pt-28 agar konten slot tidak tertabrak header yang melayang --}}
        <main class="flex-1 pt-28">
            {{ $slot }}
        </main>

        <x-sections.footer />
    </div>

    @livewireScriptConfig
    @stack('scripts')

    {{-- Script untuk Jam Digital Real-time --}}
    <script>
        function updateClock() {
            const clockElement = document.getElementById('digital-clock');
            if (!clockElement) return;

            const now = new Date();
            // Format 24 jam Indonesia (WIB)
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            }).replace(/\./g, ':');

            clockElement.textContent = timeString;
        }

        // Update setiap detik
        setInterval(updateClock, 1000);
        // Panggil langsung agar tidak menunggu 1 detik pertama
        document.addEventListener('DOMContentLoaded', updateClock);
        // Dukungan untuk Livewire wire:navigate
        document.addEventListener('livewire:navigated', updateClock);
    </script>
</body>

</html>
