@props([
'label' => null,
'url' => null,
'tag' => 'button',
'size' => 'sm',
'color' => 'primary',
'icon' => null,
'iconRight' => null,
])

@php($iconSize = match ($size) {
'xs' => 'w-3 h-3',
'sm' => 'w-4 h-4',
'md' => 'w-5 h-5',
'lg' => 'w-6 h-6',
default => 'w-4 h-4',
})

@php($sizeClass = match ($size) {
'xs' => 'text-[10px] px-3 py-1.5',
'sm' => 'text-xs px-4 py-2',
'md' => 'text-sm px-5 py-2.5',
'lg' => 'text-base px-6 py-3',
default => 'text-sm px-4 py-2',
})

@php($colorClass = match ($color) {
'primary' => 'bg-primary hover:bg-[#0100AA] text-white shadow-sm shadow-primary/20',
'accent' => 'bg-accent/10 hover:bg-accent/20 text-primary dark:text-accent',
'dark' => 'bg-text-dark dark:bg-text-light text-white dark:text-text-dark',
'gray' => 'bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300',
'outline' => 'border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700
dark:text-gray-300',
default => 'bg-primary text-white',
})

@php($tag = $url ? 'a' : $tag)

<{{ $tag }}
    {{ $attributes->merge(['class' => "inline-flex items-center justify-center rounded-full font-bold transition-all active:scale-95 {$sizeClass} {$colorClass}"]) }}
    @if($url) href="{{ $url }}" @endif>
    @if ($icon)
    <x-icon :name="$icon" class="{{ $iconSize }} mr-2" />
    @endif

    <span>{{ $label ?? $slot }}</span>

    @if ($iconRight)
    <x-icon :name="$iconRight" class="{{ $iconSize }} ml-2" />
    @endif
</{{ $tag }}>