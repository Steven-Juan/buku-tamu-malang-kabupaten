@props([
'label' => null,
'url' => null,
'tag' => 'button',
'size' => 'sm',
'color' => 'primary',
'icon' => null,
'iconRight' => null,
'fullWidth' => false,
'loading' => false,
])

@php
// Icon size mapping
$iconSize = match ($size) {
'xs' => 'w-3.5 h-3.5',
'sm' => 'w-4 h-4',
'md' => 'w-5 h-5',
'lg' => 'w-6 h-6',
default => 'w-4 h-4',
};

// Padding and text size mapping
$sizeClass = match ($size) {
'xs' => 'text-[11px] px-3 py-1.5',
'sm' => 'text-xs px-4 py-2',
'md' => 'text-sm px-5 py-2.5',
'lg' => 'text-base px-6 py-3',
default => 'text-sm px-4 py-2',
};

// Enhanced color mapping with gradients and states
$colorClass = match ($color) {
'primary' => 'bg-gradient-to-r from-primary to-primary/90 hover:from-primary/90 hover:to-primary text-white shadow-md
shadow-primary/30 hover:shadow-lg hover:shadow-primary/40',

'accent' => 'bg-gradient-to-r from-accent/10 to-accent/5 hover:from-accent/20 hover:to-accent/10 text-primary
dark:text-accent border border-accent/20',

'dark' => 'bg-gradient-to-r from-text-dark to-text-dark/90 dark:from-text-light dark:to-text-light/90 text-white
dark:text-text-dark shadow-md',

'gray' => 'bg-gradient-to-r from-gray-100 to-gray-50 dark:from-gray-800 dark:to-gray-900 hover:from-gray-200
hover:to-gray-100 dark:hover:from-gray-700 dark:hover:to-gray-800 text-gray-700 dark:text-gray-300 border
border-gray-200 dark:border-gray-700',

'outline' => 'border-2 border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary
hover:bg-primary/5 dark:hover:bg-primary/10 text-gray-700 dark:text-gray-300 transition-all',

'success' => 'bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white shadow-md
shadow-green-500/30',

'danger' => 'bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white shadow-md
shadow-red-500/30',

default => 'bg-gradient-to-r from-primary to-primary/90 text-white',
};

// Width class
$widthClass = $fullWidth ? 'w-full' : '';

// Determine tag
$tag = $url ? 'a' : $tag;
@endphp

<{{ $tag }} {{ $attributes->merge([
        'class' => "inline-flex items-center justify-center rounded-full font-bold transition-all 
                   active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed
                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50
                   {$sizeClass} {$colorClass} {$widthClass}"
    ]) }} @if($url) href="{{ $url }}" @endif @if($loading) disabled @endif @if($attributes->has('wire:click'))
    wire:loading.attr="disabled" @endif
    >
    {{-- Loading spinner --}}
    @if($loading)
    <svg class="animate-spin {{ $iconSize }} mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
        </path>
    </svg>
    @endif

    {{-- Left icon with animation --}}
    @if ($icon && !$loading)
    <x-icon :name="$icon" class="{{ $iconSize }} mr-2 transition-transform group-hover/btn:-translate-x-0.5" />
    @endif

    {{-- Button content --}}
    <span class="relative">
        {{ $label ?? $slot }}

        {{-- Hover underline effect for links --}}
        @if($url)
        <span
            class="absolute -bottom-0.5 left-0 w-full h-0.5 bg-current opacity-0 scale-x-0 group-hover/btn:scale-x-100 group-hover/btn:opacity-100 transition-all origin-left"></span>
        @endif
    </span>

    {{-- Right icon with animation --}}
    @if ($iconRight)
    <x-icon :name="$iconRight" class="{{ $iconSize }} ml-2 transition-transform group-hover/btn:translate-x-0.5" />
    @endif
</{{ $tag }}>