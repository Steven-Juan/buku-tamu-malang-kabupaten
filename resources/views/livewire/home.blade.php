<div>
    <x-hero title="Buku Tamu Digital" />

    <x-container>
        <h2 class="mb-8 text-4xl font-bold">
            Kunjungan Terbaru
        </h2>

        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($guests as $guest)
                <div>
                    <a class="*:transition group" href="{{ route('guest.show', $guest->id) }}" wire:navigate>
                        <div
                            class="w-full h-48 mb-2 overflow-hidden border rounded-lg group-hover:brightness-90 bg-gray-50">
                            @if ($guest->foto)
                                <img class="object-cover w-full h-full" src="{{ asset('storage/' . $guest->foto) }}"
                                    alt="Foto {{ $guest->nama }}" />
                            @else
                                <div
                                    class="flex flex-col items-center justify-center w-full h-full text-gray-400 bg-gray-200">
                                    <x-heroicon-o-user class="w-12 h-12 mb-1" />
                                    <span class="text-xs">No Photo</span>
                                </div>
                            @endif
                        </div>

                        <div class="px-1">
                            <span class="text-xs font-semibold uppercase text-primary-600">
                                {{ $guest->perangkatDaerah->nama_pd }}
                            </span>
                            <h3 class="text-lg font-bold text-gray-800 group-hover:text-primary-500">
                                {{ $guest->nama }}
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-1">
                                {{ $guest->asal_instansi }}
                            </p>
                        </div>
                    </a>
                </div>
            @empty
                <div class="py-10 text-center col-span-full">
                    <x-heroicon-o-chat-bubble-left-ellipsis class="w-12 h-12 mx-auto text-gray-300" />
                    <p class="mt-2 text-gray-500">Belum ada riwayat kunjungan.</p>
                </div>
            @endforelse
        </div>

        @if ($guests->hasPages())
            <div class="pt-6 mt-10 border-t">
                {{ $guests->links() }}
            </div>
        @endif
    </x-container>
</div>
