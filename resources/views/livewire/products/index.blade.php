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
        <div class="pointer-events-none absolute -top-28 -left-28 h-[420px] w-[420px] rounded-full bg-sky-500/12 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-28 -right-28 h-[520px] w-[520px] rounded-full bg-indigo-500/10 blur-3xl"></div>

        <div class="relative mx-auto w-full max-w-6xl px-6 py-8">

            {{-- HERO / HEADER --}}
            <div class="rounded-[28px] border border-white/10 bg-white/[0.04] shadow-[0_30px_80px_rgba(0,0,0,.45)]">
                <div class="p-6 md:p-8">
                    <div class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
                        <div class="min-w-0">
                            <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/70">
                                <span class="h-1.5 w-1.5 rounded-full bg-sky-400"></span>
                                Premium Aluminium Catalog
                            </div>

                            <h1 class="mt-3 text-3xl md:text-4xl font-semibold tracking-tight text-white">
                                Daftar Produk Aluminium
                            </h1>
                            <p class="mt-2 max-w-2xl text-sm md:text-base text-white/70">
                                Pilih material aluminium terbaik untuk kebutuhan proyek & retail — extrusion, facade, ACP, partition, hingga hardware.
                            </p>

                            {{-- Trust badges --}}
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] text-white/70">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                                    Quality checked
                                </span>
                                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] text-white/70">
                                    <span class="h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                    Fast quotation
                                </span>
                                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] text-white/70">
                                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-300"></span>
                                    Stock updated
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center justify-start md:justify-end gap-2">
                            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-xs font-medium text-emerald-200">
                                <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_0_4px_rgba(16,185,129,.15)]"></span>
                                Sistem aktif
                            </span>
                        </div>
                    </div>

                    {{-- TOOLBAR --}}
                    <div class="mt-6 grid gap-4 md:grid-cols-12">
                        <div class="md:col-span-8">
                            <label class="text-xs text-white/70">Cari produk</label>
                            <div class="mt-2 flex items-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 focus-within:border-sky-400/40 focus-within:ring-4 focus-within:ring-sky-500/10 transition">
                                {{-- icon --}}
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" class="text-white/45">
                                    <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                                </svg>

                                <input
                                    type="text"
                                    wire:model.debounce.300ms="search"
                                    placeholder="Cari nama, deskripsi, kategori…"
                                    class="w-full bg-transparent text-white placeholder:text-white/35 outline-none"
                                />
                            </div>
                            <div class="mt-2 text-[11px] text-white/45">
                                Tips: coba kata kunci seperti <span class="text-white/70">“ACP”, “seri 6000”, “hardware”</span>.
                            </div>
                        </div>

                        <div class="md:col-span-4 md:text-right">
                            <label class="text-xs text-white/70">Tampilkan</label>
                            <select
                                wire:model="perPage"
                                class="mt-2 w-full md:w-[180px] rounded-2xl border border-white/10 bg-white/5 px-3 py-3 text-white
                                       focus:border-sky-400/40 focus:ring-4 focus:ring-sky-500/10 outline-none transition"
                            >
                                <option class="bg-[#0B1426]" value="6">6</option>
                                <option class="bg-[#0B1426]" value="12">12</option>
                                <option class="bg-[#0B1426]" value="24">24</option>
                                <option class="bg-[#0B1426]" value="48">48</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="mt-8">
                @if(isset($products) && $products->count())

                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach($products as $product)
                            @php
                                $stock = (int)($product->stock ?? 0);
                                $isLow = $stock > 0 && $stock <= 10;
                                $isOut = $stock <= 0;
                            @endphp

                            <div class="group relative overflow-hidden rounded-[24px] border border-white/10 bg-white/[0.04]
                                        shadow-[0_18px_45px_rgba(0,0,0,.35)]
                                        transition hover:border-white/20 hover:bg-white/[0.07]">

                                {{-- subtle top highlight --}}
                                <div class="pointer-events-none absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-white/10 to-transparent opacity-0 transition group-hover:opacity-100"></div>

                                {{-- Image --}}
                                <div class="relative p-4">
                                    <div class="rounded-2xl overflow-hidden border border-white/10 bg-black/25">
                                        @if($product->image)
                                            <img
                                                src="{{ asset('storage/'.$product->image) }}"
                                                class="h-44 w-full object-cover transition duration-300 group-hover:scale-[1.03]"
                                                alt="{{ $product->name }}"
                                            >
                                        @else
                                            <div class="h-44 flex items-center justify-center text-white/40 text-sm">
                                                No image
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Stock pill --}}
                                    <div class="absolute left-6 top-6">
                                        @if($isOut)
                                            <span class="inline-flex items-center gap-2 rounded-full border border-rose-400/20 bg-rose-400/10 px-3 py-1 text-[11px] font-medium text-rose-200">
                                                <span class="h-1.5 w-1.5 rounded-full bg-rose-300"></span>
                                                Stok habis
                                            </span>
                                        @elseif($isLow)
                                            <span class="inline-flex items-center gap-2 rounded-full border border-amber-400/20 bg-amber-400/10 px-3 py-1 text-[11px] font-medium text-amber-200">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-300"></span>
                                                Stok menipis
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-[11px] font-medium text-emerald-200">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                                                Ready
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Info --}}
                                <div class="px-5 pb-5">
                                    <div class="flex items-start justify-between gap-3">
                                        <h3 class="min-w-0 text-sm font-semibold text-white line-clamp-1">
                                            {{ $product->name }}
                                        </h3>

                                        <div class="shrink-0 text-right">
                                            <div class="text-[10px] text-white/45 leading-none">Mulai dari</div>
                                            <div class="mt-1 text-sm font-semibold text-sky-200">
                                                Rp {{ number_format($product->price,0,',','.') }}
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mt-2 text-xs text-white/60 line-clamp-2">
                                        {{ $product->description }}
                                    </p>

                                    <div class="mt-4 flex items-center justify-between">
                                        <div class="text-xs text-white/55">
                                            Stok:
                                            <span class="font-semibold text-white/85">{{ $stock }}</span>
                                        </div>

                                        <a
                                            href="{{ route('produk.show', $product->id) }}"
                                            class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-xs font-semibold text-white/80
                                                   transition hover:bg-white/10 hover:border-white/20"
                                        >
                                            Detail
                                            <span aria-hidden="true">→</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>

                    {{-- WHY SECTION (murni tampilan, tanpa ubah function) --}}
                    <div class="mt-10 rounded-[28px] border border-white/10 bg-white/[0.04] shadow-[0_30px_80px_rgba(0,0,0,.35)]">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
                                <div>
                                    <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/70">
                                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-300"></span>
                                        Kenapa pilih produk kami
                                    </div>
                                    <h2 class="mt-3 text-xl md:text-2xl font-semibold tracking-tight text-white">
                                        Lebih dari sekadar katalog — fokus kualitas & ketepatan
                                    </h2>
                                    <p class="mt-2 max-w-2xl text-sm text-white/70">
                                        Kami membantu kamu memilih aluminium yang tepat untuk kebutuhan proyek, dengan informasi yang jelas, stok yang terkontrol,
                                        dan proses order yang rapi.
                                    </p>
                                </div>

                                <div class="mt-4 md:mt-0 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-white/70">
                                    <span class="h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                    Transparan • Terukur • Siap proyek
                                </div>
                            </div>

                            <div class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                                {{-- Card 1 --}}
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                    <div class="flex items-start gap-3">
                                        <div class="h-11 w-11 rounded-2xl bg-sky-500/10 ring-1 ring-sky-400/20 flex items-center justify-center">
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3Z" stroke="rgba(125,211,252,1)" stroke-width="1.8"/>
                                                <path d="M8 12l2.2 2.2L16.5 8" stroke="rgba(125,211,252,1)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-white">Quality & Spec clarity</div>
                                            <div class="mt-1 text-sm text-white/65">
                                                Deskripsi ringkas dan fokus pada kebutuhan penggunaan.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card 2 --}}
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                    <div class="flex items-start gap-3">
                                        <div class="h-11 w-11 rounded-2xl bg-emerald-500/10 ring-1 ring-emerald-400/20 flex items-center justify-center">
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                                <path d="M7 7h10v10H7V7Z" stroke="rgba(110,231,183,1)" stroke-width="1.8"/>
                                                <path d="M9 12h6" stroke="rgba(110,231,183,1)" stroke-width="2.2" stroke-linecap="round"/>
                                                <path d="M12 9v6" stroke="rgba(110,231,183,1)" stroke-width="2.2" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-white">Stok terkontrol</div>
                                            <div class="mt-1 text-sm text-white/65">
                                                Indikator stok membantu keputusan cepat saat order.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card 3 --}}
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                    <div class="flex items-start gap-3">
                                        <div class="h-11 w-11 rounded-2xl bg-indigo-500/10 ring-1 ring-indigo-400/20 flex items-center justify-center">
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                                <path d="M4 7h16" stroke="rgba(165,180,252,1)" stroke-width="2.2" stroke-linecap="round"/>
                                                <path d="M7 11h10" stroke="rgba(165,180,252,1)" stroke-width="2.2" stroke-linecap="round"/>
                                                <path d="M9 15h6" stroke="rgba(165,180,252,1)" stroke-width="2.2" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-white">Rapi untuk proyek</div>
                                            <div class="mt-1 text-sm text-white/65">
                                                Katalog tersusun untuk kebutuhan internal & pengadaan.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Card 4 --}}
                                <div class="rounded-2xl border border-white/10 bg-white/5 p-5">
                                    <div class="flex items-start gap-3">
                                        <div class="h-11 w-11 rounded-2xl bg-cyan-500/10 ring-1 ring-cyan-400/20 flex items-center justify-center">
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 6v6l4 2" stroke="rgba(103,232,249,1)" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="rgba(103,232,249,1)" stroke-width="1.8"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-sm font-semibold text-white">Respon cepat</div>
                                            <div class="mt-1 text-sm text-white/65">
                                                Proses pencarian & pemilihan produk lebih efisien.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- mini note --}}
                            <div class="mt-6 rounded-2xl border border-white/10 bg-white/5 p-5">
                                <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                                    <div class="text-sm text-white/70">
                                        Butuh kombinasi produk untuk satu proyek? Mulai dari detail produk untuk lihat spesifikasi & ketersediaan.
                                    </div>
                                    <div class="text-xs text-white/50">
                                        *Konten ini hanya tampilan, tidak mengubah alur sistem.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @else
                    <div class="rounded-[24px] border border-white/10 bg-white/[0.04] p-12 text-center shadow-[0_18px_45px_rgba(0,0,0,.30)]">
                        <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl border border-white/10 bg-white/5 text-white/60">
                            <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <h3 class="text-white font-semibold">Produk tidak ditemukan</h3>
                        <p class="text-white/60 text-sm mt-2">
                            Coba ubah kata kunci pencarian atau reset filter jumlah tampil.
                        </p>
                    </div>
                @endif
            </div>

            {{-- FOOTER --}}
            <div class="mt-12 text-[11px] text-white/40 flex justify-between">
                <span>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</span>
                <span>Navy-metal theme · Products</span>
            </div>

        </div>
    </section>
</div>