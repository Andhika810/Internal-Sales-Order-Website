<div class="min-h-[calc(100vh-0px)] w-full bg-[#070D18]">
    <section class="relative min-h-[calc(100vh-0px)] w-full overflow-hidden
                    bg-gradient-to-b from-[#0E1A2E] via-[#0B1426] to-[#070D18]">

        <div class="pointer-events-none absolute inset-0 opacity-[0.16]"
             style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 56px 56px;">
        </div>
        <div class="pointer-events-none absolute -top-28 -left-28 h-[420px] w-[420px] rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -right-28 h-[420px] w-[420px] rounded-full bg-indigo-500/10 blur-3xl"></div>

        @php
            $itemsCount = $items->count();
        @endphp

        <div class="relative mx-auto w-full max-w-6xl px-4 py-6 md:px-8 md:py-8">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-white">Checkout</h1>
                    <p class="mt-1 text-sm md:text-base text-white/70">Konfirmasi data penerima & alamat pengiriman.</p>
                </div>

                <a href="{{ route('keranjang.index') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-white/12 bg-white/5 px-4 py-2 text-sm font-semibold text-white/85
                          transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-sky-500/10">
                    ← Kembali
                </a>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-3">
                {{-- Form --}}
                <div class="lg:col-span-2 rounded-[28px] border border-white/10 bg-white/[0.04]
                            shadow-[0_30px_80px_rgba(0,0,0,.45)]">
                    <div class="p-6 md:p-8 space-y-4">
                        @if($itemsCount === 0)
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 text-sm text-white/70">
                                Keranjang kamu kosong. Silakan tambah produk dulu.
                            </div>
                        @endif

                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-white/70 mb-2">Nama penerima</label>
                                <input wire:model.defer="recipient_name" type="text"
                                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/30
                                              outline-none focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10">
                                @error('recipient_name') <div class="mt-1 text-xs text-rose-200">{{ $message }}</div> @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-white/70 mb-2">No. HP</label>
                                <input wire:model.defer="recipient_phone" type="text" placeholder="08xxxxxxxxxx"
                                       class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/30
                                              outline-none focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10">
                                @error('recipient_phone') <div class="mt-1 text-xs text-rose-200">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-white/70 mb-2">Alamat pengiriman</label>
                            <textarea wire:model.defer="shipping_address" rows="4" placeholder="Alamat lengkap..."
                                      class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/30
                                             outline-none focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"></textarea>
                            @error('shipping_address') <div class="mt-1 text-xs text-rose-200">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-white/70 mb-2">Catatan (opsional)</label>
                            <input wire:model.defer="notes" type="text" placeholder="Contoh: kirim siang..."
                                   class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-white placeholder:text-white/30
                                          outline-none focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10">
                        </div>

                        <div class="pt-2 flex justify-end">
                            <button
                                type="button"
                                wire:click="placeOrder"
                                wire:loading.attr="disabled"
                                @disabled($itemsCount === 0)
                                class="inline-flex items-center justify-center rounded-xl bg-sky-500/15 px-6 py-3 text-sm font-semibold text-sky-200
                                       ring-1 ring-sky-400/25 transition hover:bg-sky-500/20 focus:outline-none focus:ring-4 focus:ring-sky-500/15
                                       disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span wire:loading.remove>Konfirmasi & Buat Pesanan</span>
                                <span wire:loading>Memproses…</span>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="rounded-[28px] border border-white/10 bg-white/[0.04]
                            shadow-[0_30px_80px_rgba(0,0,0,.45)]">
                    <div class="p-6 md:p-8">
                        <div class="text-sm font-semibold text-white">Ringkasan</div>

                        <div class="mt-4 space-y-3">
                            @forelse($items as $ci)
                                @php
                                    $p = $ci->product;
                                    $price = (float)($p->price ?? 0);
                                    $qty = (int)($ci->quantity ?? 1);
                                    $sub = $price * $qty;
                                @endphp

                                <div class="rounded-xl border border-white/10 bg-white/5 p-3">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-white line-clamp-1">{{ $p->name ?? 'Produk' }}</div>
                                            <div class="mt-1 text-xs text-white/60">Qty {{ $qty }}</div>
                                        </div>

                                        <div class="shrink-0 text-sm font-semibold text-sky-200">
                                            Rp {{ number_format($sub, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4 text-sm text-white/70">
                                    Keranjang kosong.
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-5 flex items-center justify-between rounded-xl border border-white/10 bg-white/5 p-4">
                            <div class="text-sm text-white/70">Total</div>
                            <div class="text-lg font-semibold text-white">
                                Rp {{ number_format($total ?? 0, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-[11px] text-white/45 flex items-center justify-between border-t border-white/10 pt-4">
                <span>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</span>
                <span>Navy-metal theme · Checkout</span>
            </div>
        </div>
    </section>
</div>