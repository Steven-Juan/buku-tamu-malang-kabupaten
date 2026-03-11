@props([
'label' => null,
'url' => null,
'tag' => 'button',
'size' => 'sm',
'icon' => null,
'iconRight' => null,
'fullWidth' => false,
])

@php
$sizeClass = match ($size) {
'xs' => 'text-[11px] px-6 py-1.5',
'sm' => 'text-xs px-8 py-2.5',
'md' => 'text-sm px-10 py-3',
'lg' => 'text-base px-12 py-3.5',
default => 'text-sm px-8 py-2.5',
};

$iconSize = match ($size) {
'xs' => 'w-4 h-4',
'sm' => 'w-5 h-5',
'md' => 'w-5.5 h-5.5',
'lg' => 'w-6 h-6',
default => 'w-5 h-5',
};

$tag = $url ? 'a' : $tag;
$widthClass = $fullWidth ? 'w-full' : 'w-max';
@endphp

{{-- Container dengan shadow yang lebih lembut --}}
<div
    class="button-bg-animate rounded-full p-[2px] transition duration-300 hover:scale-105 active:scale-95 shadow-md shadow-primary/10 {{ $widthClass }}">
    <{{ $tag }} {{ $attributes->merge([
            'class' => "{$widthClass} {$sizeClass} flex items-center justify-center rounded-full font-bold
                                           bg-slate-100 dark:bg-slate-800
                                           text-slate-800 dark:text-slate-100
                                           transition-all duration-300 shadow-inner",
        ]) }} @if ($url) href="{{ $url }}" @endif>

        @if ($icon)
        <x-icon :name="$icon" class="{{ $iconSize }} mr-2" />
        @endif

        <span class="relative">{{ $label ?? $slot }}</span>

        @if ($iconRight)
        <x-icon :name="$iconRight" class="{{ $iconSize }} ml-2" />
        @endif
    </{{ $tag }}>
</div>