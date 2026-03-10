@props(['size' => 'md'])

@php
    $sizeClass = match ($size) {
        'sm' => 'max-w-4xl',
        'md' => 'max-w-5xl',
        'lg' => 'max-w-6xl',
        'full' => 'max-w-full',
        default => 'max-w-5xl',
    };
@endphp

<div {{ $attributes->merge(['class' => "{$sizeClass} w-full px-4 md:px-6 mx-auto relative"]) }}>
    {{ $slot }}
</div>
