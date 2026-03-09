<div>
    <div class="hidden bg-black md:block bg-opacity-90">
        <x-container>
            {{-- Pastikan Breadcrumbs sudah disesuaikan di config/breadcrumbs.php --}}
            {{ Breadcrumbs::render('guest', $guest) }}
        </x-container>
    </div>

    <article>
        <x-hero :title="'Detail Kunjungan: ' . $guest->nama">
            @slot('afterTitle')
                <div class="text-lg opacity-90">{{ $guest->asal_instansi }}</div>

                <div class="inline-flex items-center mt-2 text-sm cursor-help"
                    x-tooltip.raw="{{ $guest->created_at->format('F j, Y H:i') }}">
                    <x-heroicon-o-calendar class="w-4 h-4 mr-1" />
                    <time datetime="{{ $guest->created_at->format('Y-m-d H:i:s') }}">
                        {{ $guest->created_at->diffForHumans() }}
                    </time>
                </div>
            @endslot
        </x-hero>

        <x-container>
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <div class="p-6 bg-white border rounded-xl shadow-sm">
                        <h4 class="mb-4 text-xl font-bold border-b pb-2">Informasi Kunjungan</h4>

                        <div class="space-y-4">
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase">Tujuan Instansi</label>
                                <p class="text-lg text-gray-800">{{ $guest->perangkatDaerah->nama_pd }}</p>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase">Keperluan</label>
                                <p class="text-gray-700 leading-relaxed">{{ $guest->keperluan }}</p>
                            </div>

                            @if ($guest->pesan_kesan)
                                <div>
                                    <label class="text-xs font-bold text-gray-400 uppercase">Pesan & Kesan</label>
                                    <p class="italic text-gray-600">"{{ $guest->pesan_kesan }}"</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-8">
                        <label class="block mb-2 text-sm font-bold text-gray-500 uppercase">Tanda Tangan Digital</label>
                        <div class="inline-block p-2 bg-gray-50 border-2 border-dashed rounded-lg">
                            <img src="{{ $guest->ttd_digital }}" alt="Tanda tangan {{ $guest->nama }}"
                                class="max-h-32">
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="overflow-hidden border-4 border-white rounded-lg shadow-lg rotate-2">
                        @if ($guest->foto)
                            <img src="{{ asset('storage/' . $guest->foto) }}" alt="Foto Pengunjung"
                                class="w-full h-auto">
                        @else
                            <div class="flex items-center justify-center bg-gray-200 aspect-square">
                                <x-heroicon-o-camera class="w-12 h-12 text-gray-400" />
                            </div>
                        @endif
                        <div class="p-2 text-center bg-white">
                            <span class="text-xs text-gray-400 uppercase font-bold">Capture Foto</span>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::check())
                <div class="pt-6 mt-12 border-t">
                    <a class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition rounded-lg bg-primary-600 hover:bg-primary-700"
                        href="/admin/guests/{{ $guest->id }}/edit">
                        <x-heroicon-s-pencil class="inline-block w-4 h-4 mr-2" />
                        Edit record
                    </a>
                </div>
            @endif
        </x-container>
    </article>
</div>
