<div class="relative min-h-screen w-full">
    {{-- Force background full-page (anti putih) --}}
    <div class="fixed inset-0 -z-10 bg-[#070D18]"></div>

    <section
        class="relative min-h-screen w-full overflow-hidden
               bg-gradient-to-b from-[#0E1A2E] via-[#0B1426] to-[#070D18]"
    >
        {{-- soft grid --}}
        <div class="pointer-events-none absolute inset-0 opacity-[0.12]"
             style="background-image: linear-gradient(rgba(255,255,255,.06) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.06) 1px, transparent 1px); background-size: 56px 56px;">
        </div>

        {{-- glow --}}
        <div class="pointer-events-none absolute -top-28 -left-28 h-[420px] w-[420px] rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -right-28 h-[420px] w-[420px] rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="relative mx-auto w-full max-w-6xl px-6 py-8">

            {{-- HEADER --}}
            <div class="flex items-end justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-white">Detail Produk</h1>
                    <p class="mt-1 text-white/70">Informasi lengkap produk aluminium.</p>
                </div>

                <a href="{{ route('produk.index') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-white/12 bg-white/5 px-4 py-2 text-sm font-semibold text-white/85
                          transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-sky-500/10">
                    ← Kembali
                </a>
            </div>

            {{-- MAIN CARD --}}
            <div class="mt-6 rounded-[28px] border border-white/10 bg-white/[0.04] shadow-[0_30px_80px_rgba(0,0,0,.45)]">
                <div class="p-6 md:p-8">

                    <div class="grid gap-6 lg:grid-cols-12">
                        {{-- LEFT: IMAGE --}}
                        <div class="lg:col-span-7">
                            <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-black/20">
                                @if($product->image)
                                    <img
                                        src="{{ \Illuminate\Support\Str::startsWith($product->image, 'http') ? $product->image : asset('storage/'.$product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="h-[360px] w-full object-cover md:h-[440px]"
                                    />
                                @else
                                    <div class="flex h-[360px] w-full items-center justify-center text-white/40 md:h-[440px]">
                                        No image
                                    </div>
                                @endif

                                {{-- status badge --}}
                                <div class="absolute left-4 top-4 inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-xs font-medium text-emerald-200">
                                    <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_0_4px_rgba(16,185,129,.15)]"></span>
                                    Available
                                </div>
                            </div>

                            {{-- mini highlights under image --}}
                            <div class="mt-5 grid gap-3 sm:grid-cols-3">
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <div class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 ring-1 ring-white/10">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 3l8 4.5v9L12 21 4 16.5v-9L12 3Z" stroke="currentColor" stroke-width="2" opacity=".9"/>
                                                <path d="M8.5 12.5l2.3 2.3 4.7-5.2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" opacity=".9"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <div class="text-sm font-semibold text-white">Material terverifikasi</div>
                                            <div class="mt-1 text-xs text-white/60">Kualitas stabil untuk proyek & retail.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <div class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 ring-1 ring-white/10">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 2s6 6.2 6 11a6 6 0 1 1-12 0c0-4.8 6-11 6-11Z" stroke="currentColor" stroke-width="2" opacity=".9"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <div class="text-sm font-semibold text-white">Tahan korosi</div>
                                            <div class="mt-1 text-xs text-white/60">Cocok untuk area lembap & outdoor.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                                    <div class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 ring-1 ring-white/10">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                <path d="M14.7 6.3 17.7 3.3a2.1 2.1 0 1 1 3 3l-3 3" stroke="currentColor" stroke-width="2" opacity=".9"/>
                                                <path d="M9.3 17.7l-3 3a2.1 2.1 0 1 1-3-3l3-3" stroke="currentColor" stroke-width="2" opacity=".9"/>
                                                <path d="M8 16l8-8" stroke="currentColor" stroke-width="2" opacity=".9"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <div class="text-sm font-semibold text-white">Siap fabrikasi</div>
                                            <div class="mt-1 text-xs text-white/60">Mudah diproses sesuai kebutuhan.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT: INFO --}}
                        <div class="lg:col-span-5">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <h2 class="text-3xl font-semibold tracking-tight text-white">
                                        {{ $product->name }}
                                    </h2>

                                    <div class="mt-3 flex flex-wrap items-center gap-2">
                                        <span class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-white/80">
                                            <span class="text-white/60 text-xs">Harga</span>
                                            <span class="font-semibold text-sky-200">
                                                Rp {{ number_format($product->price,0,',','.') }}
                                            </span>
                                        </span>

                                        <span class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-white/80">
                                            <span class="text-white/60 text-xs">Stok</span>
                                            <span class="font-semibold text-white">{{ $product->stock }}</span>
                                        </span>

                                        <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/70">
                                            Premium Grade
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="mt-5 rounded-2xl border border-white/10 bg-white/5 p-5">
                                <div class="text-sm font-semibold text-white">Deskripsi</div>
                                <p class="mt-2 text-sm leading-relaxed text-white/70">
                                    {{ $product->description }}
                                </p>
                            </div>

                            {{-- Keunggulan + Spesifikasi ringkas --}}
                            <div class="mt-5 grid gap-4 md:grid-cols-2">
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                    <div class="text-sm font-semibold text-white">Keunggulan</div>
                                    <ul class="mt-3 space-y-2 text-sm text-white/70">
                                        <li class="flex gap-2">
                                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                            Finishing rapi, cocok untuk tampilan premium.
                                        </li>
                                        <li class="flex gap-2">
                                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                            Stabil untuk kebutuhan proyek dan retail.
                                        </li>
                                        <li class="flex gap-2">
                                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                            Daya tahan baik untuk pemakaian jangka panjang.
                                        </li>
                                    </ul>
                                </div>

                                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                    <div class="text-sm font-semibold text-white">Spesifikasi ringkas</div>

                                    <div class="mt-3 space-y-2 text-sm">
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="text-white/60">Kategori</span>
                                            <span class="text-white/85 font-semibold">Aluminium</span>
                                        </div>
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="text-white/60">Rekomendasi</span>
                                            <span class="text-white/85 font-semibold">Facade / Interior</span>
                                        </div>
                                        <div class="flex items-center justify-between gap-3">
                                            <span class="text-white/60">Ketersediaan</span>
                                            <span class="text-emerald-200 font-semibold">Ready stock</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- CTA --}}
                            <div class="mt-5 rounded-2xl border border-white/10 bg-white/5 p-5">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="min-w-0">
                                        <div class="text-sm font-semibold text-white">Siap ditambahkan ke penawaran?</div>
                                        <div class="mt-1 text-xs text-white/60">
                                            Stok akan dicek otomatis saat checkout.
                                        </div>

                                        <div class="mt-3 flex flex-wrap gap-2">
                                            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] text-white/70">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                                                Estimasi respon cepat
                                            </span>
                                            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] text-white/70">
                                                <span class="h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                                Support kebutuhan proyek
                                            </span>
                                            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] text-white/70">
                                                <span class="h-1.5 w-1.5 rounded-full bg-indigo-300"></span>
                                                Kualitas konsisten
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- FIX AREA: tombol tidak kepotong --}}
                                <div class="mt-5 grid gap-3 lg:grid-cols-12 lg:items-center">
                                    {{-- qty --}}
                                    <div class="lg:col-span-4">
                                        <div class="flex items-center gap-3 rounded-xl border border-white/10 bg-white/5 px-4 py-3">
                                            <div class="text-xs text-white/60">Qty</div>
                                            <input
                                                type="number"
                                                min="1"
                                                wire:model.defer="qty"
                                                class="w-full bg-transparent text-sm font-semibold text-white outline-none"
                                            />
                                        </div>
                                    </div>

                                    {{-- buttons --}}
                                    <div class="lg:col-span-8">
                                        <div class="grid gap-3 sm:grid-cols-2">
                                            <button
                                                type="button"
                                                wire:click="addToCart"
                                                class="inline-flex w-full items-center justify-center rounded-xl bg-sky-500/15 px-5 py-3 text-sm font-semibold text-sky-200
                                                       ring-1 ring-sky-400/25 transition hover:bg-sky-500/20 focus:outline-none focus:ring-4 focus:ring-sky-500/15"
                                            >
                                                + Tambah ke Keranjang
                                            </button>

                                            <a
                                                href="{{ route('keranjang.index') }}"
                                                class="inline-flex w-full items-center justify-center rounded-xl border border-white/12 bg-white/5 px-5 py-3 text-sm font-semibold text-white/85
                                                       transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-sky-500/10"
                                            >
                                                Lihat Keranjang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- footer inside card --}}
                <div class="border-t border-white/10 px-6 py-4 md:px-8 flex items-center justify-between text-[11px] text-white/45">
                    <span>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</span>
                    <span>Navy-metal theme · Product Detail</span>
                </div>
            </div>

        </div>
    </section>
</div>