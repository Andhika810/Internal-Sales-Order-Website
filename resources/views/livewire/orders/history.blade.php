{{-- Cart / Keranjang --}}
<div class="relative min-h-screen w-full">
    {{-- Force background full-page (nutup putih dari layout parent) --}}
    <div class="fixed inset-0 -z-10 bg-[#070D18]"></div>

    <section
        class="relative min-h-screen w-full overflow-hidden
               bg-gradient-to-b from-[#0E1A2E] via-[#0B1426] to-[#070D18]"
    >
        {{-- soft grid + glow --}}
        <div class="pointer-events-none absolute inset-0 opacity-[0.16]"
             style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 56px 56px;">
        </div>
        <div class="pointer-events-none absolute -top-28 -left-28 h-[420px] w-[420px] rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -right-28 h-[420px] w-[420px] rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="relative mx-auto w-full max-w-6xl px-4 py-6 md:px-8 md:py-8">
            {{-- Header --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-white">
                        Keranjang Belanja
                    </h1>
                    <p class="mt-1 text-sm md:text-base text-white/70">
                        Ringkasan item yang akan kamu checkout.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-xs font-medium text-emerald-200">
                        <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_0_4px_rgba(16,185,129,.15)]"></span>
                        Sistem aktif
                    </span>
                </div>
            </div>

            {{-- Body --}}
            <div class="mt-6">
                <div
                    class="rounded-[28px] border border-white/10 bg-white/[0.04]
                           shadow-[0_30px_80px_rgba(0,0,0,.45)]"
                >
                    <div class="p-6 md:p-8">
                        @php
                            // Supaya aman: dukung beberapa nama variable yang sering dipakai.
                            $items = $items ?? $cartItems ?? $keranjang ?? $cart ?? [];
                            $itemsCount = is_countable($items) ? count($items) : (method_exists($items, 'count') ? $items->count() : 0);
                        @endphp

                        @if($itemsCount === 0)
                            {{-- EMPTY STATE --}}
                            <div class="flex min-h-[420px] flex-col items-center justify-center text-center">
                                <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 text-white/70">
                                    {{-- cart icon --}}
                                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                                        <path d="M6 6H21L20 12H8L6 6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                                        <path d="M6 6L4 3H2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M8 12L7 16H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M9 20C9.55228 20 10 19.5523 10 19C10 18.4477 9.55228 18 9 18C8.44772 18 8 18.4477 8 19C8 19.5523 8.44772 20 9 20Z" fill="currentColor"/>
                                        <path d="M18 20C18.5523 20 19 19.5523 19 19C19 18.4477 18.5523 18 18 18C17.4477 18 17 18.4477 17 19C17 19.5523 17.4477 20 18 20Z" fill="currentColor"/>
                                    </svg>
                                </div>

                                <h2 class="text-lg md:text-xl font-semibold text-white">
                                    Keranjang belanja Anda kosong
                                </h2>
                                <p class="mt-1 text-sm text-white/65 max-w-md">
                                    Mulai pilih produk aluminium yang kamu butuhkan, lalu tambahkan ke keranjang.
                                </p>

                                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                                    <a
                                        href="{{ route('produk.index') }}"
                                        class="inline-flex items-center justify-center rounded-xl bg-sky-500/15 px-5 py-3 text-sm font-semibold text-sky-200
                                               ring-1 ring-sky-400/25 transition hover:bg-sky-500/20 focus:outline-none focus:ring-4 focus:ring-sky-500/15"
                                    >
                                        Lihat Produk
                                    </a>

                                    <a
                                        href="{{ route('dashboard') }}"
                                        class="inline-flex items-center justify-center rounded-xl border border-white/12 bg-white/5 px-5 py-3 text-sm font-semibold text-white/85
                                               transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-sky-500/10"
                                    >
                                        Kembali ke Dashboard
                                    </a>
                                </div>
                            </div>
                        @else
                            {{-- LIST ITEMS --}}
                            <div class="grid gap-4">
                                @foreach($items as $item)
                                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4 md:p-5">
                                        <div class="flex items-start justify-between gap-4">
                                            <div class="min-w-0">
                                                <div class="text-sm font-semibold text-white line-clamp-1">
                                                    {{ $item->product->name ?? ($item['name'] ?? 'Item') }}
                                                </div>
                                                <div class="mt-1 text-xs text-white/60">
                                                    Qty:
                                                    <span class="text-white/85 font-medium">
                                                        {{ $item->quantity ?? ($item['quantity'] ?? 1) }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="shrink-0 text-right">
                                                @php
                                                    $price = $item->product->price ?? ($item['price'] ?? 0);
                                                    $qty = $item->quantity ?? ($item['quantity'] ?? 1);
                                                    $subtotal = (float)$price * (int)$qty;
                                                @endphp

                                                <div class="text-sm font-semibold text-sky-200">
                                                    Rp {{ number_format($subtotal, 0, ',', '.') }}
                                                </div>

                                                {{-- tombol hapus (tetap pakai wire jika ada) --}}
                                                @if(isset($item->id) || isset($item['id']))
                                                    <button
                                                        type="button"
                                                        @if(method_exists($this ?? null, 'remove') || method_exists($this ?? null, 'hapus'))
                                                            wire:click="{{ method_exists($this ?? null, 'remove') ? 'remove' : 'hapus' }}({{ $item->id ?? $item['id'] }})"
                                                        @endif
                                                        class="mt-2 inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-medium text-white/75
                                                               transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-rose-500/10"
                                                    >
                                                        Hapus
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- SUMMARY --}}
                            @php
                                $total = 0;
                                foreach($items as $item){
                                    $p = $item->product->price ?? ($item['price'] ?? 0);
                                    $q = $item->quantity ?? ($item['quantity'] ?? 1);
                                    $total += (float)$p * (int)$q;
                                }
                            @endphp

                            <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-5">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-white/70">Total</div>
                                    <div class="text-lg font-semibold text-white">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="mt-4 flex flex-col sm:flex-row gap-3 justify-end">
                                    <a
                                        href="{{ route('produk.index') }}"
                                        class="inline-flex items-center justify-center rounded-xl border border-white/12 bg-white/5 px-5 py-3 text-sm font-semibold text-white/85
                                               transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-sky-500/10"
                                    >
                                        Tambah Produk
                                    </a>

                                    {{-- tombol checkout (sesuaikan route kalau ada) --}}
                                    @if(Route::has('checkout'))
                                        <a
                                            href="{{ route('checkout') }}"
                                            class="inline-flex items-center justify-center rounded-xl bg-sky-500/15 px-5 py-3 text-sm font-semibold text-sky-200
                                                   ring-1 ring-sky-400/25 transition hover:bg-sky-500/20 focus:outline-none focus:ring-4 focus:ring-sky-500/15"
                                        >
                                            Checkout
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="border-t border-white/10 px-6 py-4 md:px-8 flex items-center justify-between text-[11px] text-white/45">
                        <span>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</span>
                        <span>Navy-metal theme · Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>