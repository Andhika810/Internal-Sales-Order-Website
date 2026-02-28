<div class="min-h-[calc(100vh-0px)] w-full bg-[#070D18]">
    <section
        class="relative min-h-[calc(100vh-0px)] w-full overflow-hidden
               bg-gradient-to-b from-[#0E1A2E] via-[#0B1426] to-[#070D18]"
    >
        <div class="pointer-events-none absolute inset-0 opacity-[0.16]"
             style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 56px 56px;">
        </div>
        <div class="pointer-events-none absolute -top-28 -left-28 h-[420px] w-[420px] rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -right-28 h-[420px] w-[420px] rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="relative mx-auto w-full max-w-6xl px-4 py-6 md:px-8 md:py-8">
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

                    <button
                        wire:click="clear"
                        class="inline-flex items-center justify-center rounded-xl border border-white/12 bg-white/5 px-4 py-2 text-sm font-semibold text-white/85
                               transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-rose-500/10"
                    >
                        Kosongkan
                    </button>
                </div>
            </div>

            @if (session('success'))
                <div class="mt-4 rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-200">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mt-4 rounded-xl border border-rose-400/20 bg-rose-400/10 px-4 py-3 text-sm text-rose-200">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mt-6 rounded-[28px] border border-white/10 bg-white/[0.04] shadow-[0_30px_80px_rgba(0,0,0,.45)]">
                <div class="p-6 md:p-8">
                    @php
                        $itemsCount = is_countable($items) ? count($items) : (method_exists($items, 'count') ? $items->count() : 0);
                    @endphp

                    @if($itemsCount === 0)
                        <div class="flex min-h-[420px] flex-col items-center justify-center text-center">
                            <div class="mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-white/10 text-white/70">
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
                        @php $total = 0; @endphp

                        <div class="grid gap-4">
                            @foreach($items as $item)
                                @php
                                    $p = $item->product;
                                    $price = (float)($p->price ?? 0);
                                    $qty = (int)($item->quantity ?? 1);
                                    $sub = $price * $qty;
                                    $total += $sub;
                                @endphp

                                <div class="rounded-2xl border border-white/10 bg-white/5 p-4 md:p-5">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="min-w-0 flex items-start gap-3">
                                            <div class="h-12 w-12 rounded-xl overflow-hidden border border-white/10 bg-black/20 shrink-0">
                                                @if($p && $p->image)
                                                    <img
                                                        src="{{ \Illuminate\Support\Str::startsWith($p->image, 'http') ? $p->image : asset('storage/'.$p->image) }}"
                                                        class="h-full w-full object-cover"
                                                        alt="{{ $p->name }}"
                                                    />
                                                @endif
                                            </div>

                                            <div class="min-w-0">
                                                <div class="text-sm font-semibold text-white line-clamp-1">
                                                    {{ $p->name ?? 'Item' }}
                                                </div>
                                                <div class="mt-1 text-xs text-white/60">
                                                    Rp {{ number_format($price, 0, ',', '.') }}
                                                </div>

                                                <div class="mt-3 inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2">
                                                    <button wire:click="dec({{ $item->id }})" class="text-white/80 hover:text-white transition">−</button>
                                                    <span class="text-sm font-semibold text-white">{{ $qty }}</span>
                                                    <button wire:click="inc({{ $item->id }})" class="text-white/80 hover:text-white transition">+</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="shrink-0 text-right">
                                            <div class="text-sm font-semibold text-sky-200">
                                                Rp {{ number_format($sub, 0, ',', '.') }}
                                            </div>

                                            <button
                                                type="button"
                                                wire:click="remove({{ $item->id }})"
                                                class="mt-2 inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-xs font-medium text-white/75
                                                       transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-rose-500/10"
                                            >
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

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

                                <button
                             type="button"
                             wire:click="goCheckout"
                         class="inline-flex items-center justify-center rounded-xl bg-sky-500/15 px-5 py-3 text-sm font-semibold text-sky-200
                                ring-1 ring-sky-400/25 transition hover:bg-sky-500/20 focus:outline-none focus:ring-4 focus:ring-sky-500/15"
>
                               Checkout
                             </button>
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
    </section>
</div>