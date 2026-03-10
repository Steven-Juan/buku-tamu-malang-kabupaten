@props([
    'title' => null,
    'afterTitle' => null,
])

<div {{ $attributes->merge(['class' => 'py-16 mb-8']) }}>
    <x-container>
        @if ($title)
            {!! $title !!}
        @else
            <h1 class="text-4xl font-bold">{{ $slot }}</h1>
        @endif

        @if ($afterTitle)
            <div class="mt-4">
                {{ $afterTitle }}
            </div>
        @endif
    </x-container>
</div>
