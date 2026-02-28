<div class="relative min-h-screen w-full">
    {{-- Force background full-page (nutup putih dari parent layout) --}}
    <div class="fixed inset-0 -z-10 bg-[#070D18]"></div>

    <section
        class="relative min-h-screen w-full overflow-hidden
               bg-gradient-to-b from-[#0E1A2E] via-[#0B1426] to-[#070D18]"
    >
        {{-- soft grid + glow --}}
        <div class="pointer-events-none absolute inset-0 opacity-[0.14]"
             style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 56px 56px;">
        </div>
        <div class="pointer-events-none absolute -top-28 -left-28 h-[420px] w-[420px] rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -right-28 h-[420px] w-[420px] rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="relative mx-auto w-full max-w-6xl px-4 py-6 md:px-8 md:py-8">
            {{-- Header --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-white">
                        Lacak Pesanan
                    </h1>
                    <p class="mt-1 text-sm md:text-base text-white/70">
                        Masukkan ID pesanan untuk melihat status dan detail item.
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-xs font-medium text-emerald-200">
                        <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_0_4px_rgba(16,185,129,.15)]"></span>
                        Sistem aktif
                    </span>
                </div>
            </div>

            {{-- Container --}}
            <div class="mt-6 rounded-[28px] border border-white/10 bg-white/[0.04]
                        shadow-[0_30px_80px_rgba(0,0,0,.45)]">
                <div class="p-6 md:p-8">
                    {{-- Error --}}
                    @if (session()->has('error'))
                        <div class="mb-5 rounded-xl border border-rose-400/20 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                            <span class="font-semibold">Gagal:</span> {{ session('error') }}
                        </div>
                    @endif

                    {{-- Search form --}}
                    <form wire:submit.prevent="searchOrder" class="w-full">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <div class="w-full">
                                <label class="mb-2 block text-xs font-medium text-white/60">
                                    ID Pesanan
                                </label>
                                <input
                                    type="text"
                                    wire:model.defer="orderId"
                                    placeholder="Contoh: 1024"
                                    class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3
                                           text-white placeholder:text-white/35
                                           shadow-[inset_0_1px_0_rgba(255,255,255,.06)]
                                           outline-none transition
                                           focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10"
                                />
                            </div>

                            <div class="sm:pt-6">
                                <button
                                    type="submit"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-2xl
                                           bg-sky-500/15 px-6 py-3 text-sm font-semibold text-sky-200
                                           ring-1 ring-sky-400/25 transition
                                           hover:bg-sky-500/20
                                           focus:outline-none focus:ring-4 focus:ring-sky-500/15"
                                >
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Result --}}
                    @if($order)
                        <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-5 md:p-6">
                            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex items-center rounded-xl bg-white/5 px-3 py-2 text-sm font-semibold text-white">
                                        #{{ $order->id }}
                                    </span>
                                    <span class="text-xs text-white/55">
                                        {{ $order->created_at->format('d M Y H:i') }}
                                    </span>
                                </div>

                                @php
                                    $status = $order->status;
                                    $statusClass =
                                        $status === 'pending' ? 'border-sky-400/25 bg-sky-500/10 text-sky-200' :
                                        ($status === 'processing' ? 'border-amber-400/25 bg-amber-500/10 text-amber-200' :
                                        ($status === 'completed' ? 'border-emerald-400/25 bg-emerald-500/10 text-emerald-200' :
                                        'border-white/10 bg-white/5 text-white/70'));

                                    $dotClass =
                                        $status === 'pending' ? 'bg-sky-300' :
                                        ($status === 'processing' ? 'bg-amber-300' :
                                        ($status === 'completed' ? 'bg-emerald-300' : 'bg-white/40'));
                                @endphp

                                <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                    <span class="h-2 w-2 rounded-full {{ $dotClass }} shadow-[0_0_0_4px_rgba(255,255,255,.06)]"></span>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>

                            <div class="mt-5 grid gap-3 md:grid-cols-2">
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <div class="text-xs font-medium text-white/55">Alamat</div>
                                    <div class="mt-1 text-sm text-white/85">
                                        {{ $order->shipping_address }}
                                    </div>
                                </div>
                                <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                                    <div class="text-xs font-medium text-white/55">Penerima</div>
                                    <div class="mt-1 text-sm text-white/85">
                                        {{ $order->recipient_name }} <span class="text-white/55">({{ $order->recipient_phone }})</span>
                                    </div>
                                </div>
                            </div>

                            @if($order->notes)
                                <div class="mt-3 rounded-xl border border-white/10 bg-white/5 p-4">
                                    <div class="text-xs font-medium text-white/55">Catatan</div>
                                    <div class="mt-1 text-sm text-white/80 italic">
                                        {{ $order->notes }}
                                    </div>
                                </div>
                            @endif

                            {{-- Items table --}}
                            <div class="mt-5 overflow-x-auto rounded-xl border border-white/10">
                                <table class="w-full text-sm">
                                    <thead class="bg-white/5 text-white/70">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-semibold">Produk</th>
                                            <th class="px-4 py-3 text-left font-semibold">Harga</th>
                                            <th class="px-4 py-3 text-left font-semibold">Jumlah</th>
                                            <th class="px-4 py-3 text-left font-semibold">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-white/10">
                                        @foreach($order->items as $item)
                                            <tr class="hover:bg-white/[0.06] transition">
                                                <td class="px-4 py-3 text-white/85">{{ $item->product->name }}</td>
                                                <td class="px-4 py-3 text-white/80">Rp{{ number_format($item->price,0,',','.') }}</td>
                                                <td class="px-4 py-3 text-white/80">{{ $item->quantity }}</td>
                                                <td class="px-4 py-3 text-sky-200 font-semibold">
                                                    Rp{{ number_format($item->price * $item->quantity,0,',','.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-xs text-white/45">
                                    PT Caturmala · Order tracking
                                </div>
                                <div class="text-right text-white font-semibold text-lg">
                                    Total:
                                    <span class="text-sky-200">
                                        Rp{{ number_format($order->total_amount,0,',','.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="border-t border-white/10 px-6 py-4 md:px-8 flex items-center justify-between text-[11px] text-white/45">
                    <span>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</span>
                    <span>Navy-metal theme · Tracking</span>
                </div>
            </div>
        </div>
    </section>
</div>