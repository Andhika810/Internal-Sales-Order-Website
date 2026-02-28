<x-layouts.app :title="__('Dashboard')">
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
                @auth
                    {{-- Dashboard Chart (tetap sama, tidak ubah fungsi) --}}
                    <livewire:dashboard-chart />

                    {{-- (Opsional) Kalau kamu MAU benar-benar bersih seperti dashboard profesional,
                        ini bagian menu shortcut "Lihat Produk / Keranjang / ..." bisa kamu HILANGKAN.
                        Aku set default: DISABLED (tidak ditampilkan) supaya dashboard fokus ke metrics/charts.
                        Kalau mau dimunculkan lagi, ubah $showShortcuts jadi true. --}}
                    @php
                        $showShortcuts = false;
                    @endphp

                    @if($showShortcuts)
                        @if(auth()->user()->isAdmin())
                            <div class="mt-6 grid md:grid-cols-3 gap-4">
                                <a href="{{ route('admin.pengguna') }}"
                                   class="group rounded-2xl border border-white/10 bg-white/5 p-6
                                          shadow-[0_18px_45px_rgba(0,0,0,.35)] transition
                                          hover:bg-white/[0.08] hover:border-white/20">
                                    <div class="text-sm text-white/60">Admin</div>
                                    <div class="mt-1 text-lg font-semibold text-white">Manajemen Pengguna</div>
                                    <div class="mt-3 inline-flex items-center gap-2 text-sky-200 text-sm font-semibold">
                                        Lihat
                                        <span class="transition group-hover:translate-x-0.5">→</span>
                                    </div>
                                </a>

                                <a href="{{ route('admin.produk') }}"
                                   class="group rounded-2xl border border-white/10 bg-white/5 p-6
                                          shadow-[0_18px_45px_rgba(0,0,0,.35)] transition
                                          hover:bg-white/[0.08] hover:border-white/20">
                                    <div class="text-sm text-white/60">Admin</div>
                                    <div class="mt-1 text-lg font-semibold text-white">Manajemen Produk</div>
                                    <div class="mt-3 inline-flex items-center gap-2 text-sky-200 text-sm font-semibold">
                                        Lihat
                                        <span class="transition group-hover:translate-x-0.5">→</span>
                                    </div>
                                </a>

                                <a href="{{ route('admin.pesanan') }}"
                                   class="group rounded-2xl border border-white/10 bg-white/5 p-6
                                          shadow-[0_18px_45px_rgba(0,0,0,.35)] transition
                                          hover:bg-white/[0.08] hover:border-white/20">
                                    <div class="text-sm text-white/60">Admin</div>
                                    <div class="mt-1 text-lg font-semibold text-white">Manajemen Pesanan</div>
                                    <div class="mt-3 inline-flex items-center gap-2 text-sky-200 text-sm font-semibold">
                                        Lihat
                                        <span class="transition group-hover:translate-x-0.5">→</span>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="mt-6 grid md:grid-cols-2 gap-4">
                                <a href="{{ route('produk.index') }}"
                                   class="group rounded-2xl border border-white/10 bg-white/5 p-6
                                          shadow-[0_18px_45px_rgba(0,0,0,.35)] transition
                                          hover:bg-white/[0.08] hover:border-white/20">
                                    <div class="text-sm text-white/60">Catalog</div>
                                    <div class="mt-1 text-lg font-semibold text-white">Lihat Produk</div>
                                    <div class="mt-3 inline-flex items-center gap-2 text-sky-200 text-sm font-semibold">
                                        Lihat
                                        <span class="transition group-hover:translate-x-0.5">→</span>
                                    </div>
                                </a>

                                <a href="{{ route('keranjang.index') }}"
                                   class="group rounded-2xl border border-white/10 bg-white/5 p-6
                                          shadow-[0_18px_45px_rgba(0,0,0,.35)] transition
                                          hover:bg-white/[0.08] hover:border-white/20">
                                    <div class="text-sm text-white/60">Cart</div>
                                    <div class="mt-1 text-lg font-semibold text-white">Keranjang Belanja</div>
                                    <div class="mt-3 inline-flex items-center gap-2 text-sky-200 text-sm font-semibold">
                                        Lihat
                                        <span class="transition group-hover:translate-x-0.5">→</span>
                                    </div>
                                </a>

                                <a href="{{ route('pesanan.riwayat') }}"
                                   class="group rounded-2xl border border-white/10 bg-white/5 p-6
                                          shadow-[0_18px_45px_rgba(0,0,0,.35)] transition
                                          hover:bg-white/[0.08] hover:border-white/20">
                                    <div class="text-sm text-white/60">Orders</div>
                                    <div class="mt-1 text-lg font-semibold text-white">Riwayat Pesanan</div>
                                    <div class="mt-3 inline-flex items-center gap-2 text-sky-200 text-sm font-semibold">
                                        Lihat
                                        <span class="transition group-hover:translate-x-0.5">→</span>
                                    </div>
                                </a>

                                <a href="{{ route('pesanan.lacak') }}"
                                   class="group rounded-2xl border border-white/10 bg-white/5 p-6
                                          shadow-[0_18px_45px_rgba(0,0,0,.35)] transition
                                          hover:bg-white/[0.08] hover:border-white/20">
                                    <div class="text-sm text-white/60">Tracking</div>
                                    <div class="mt-1 text-lg font-semibold text-white">Lacak Pesanan</div>
                                    <div class="mt-3 inline-flex items-center gap-2 text-sky-200 text-sm font-semibold">
                                        Lihat
                                        <span class="transition group-hover:translate-x-0.5">→</span>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif

                @else
                    <div class="mt-6 rounded-[28px] border border-white/10 bg-white/[0.04]
                                shadow-[0_30px_80px_rgba(0,0,0,.45)]">
                        <div class="p-6 md:p-8 text-center">
                            <h2 class="text-lg md:text-xl font-semibold text-white">
                                Selamat datang di PT Caturmala
                            </h2>
                            <p class="mt-2 text-sm text-white/70">
                                Silakan masuk untuk mengakses dashboard internal.
                            </p>

                            <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                                <a href="{{ route('login') }}"
                                   class="inline-flex items-center justify-center rounded-xl bg-sky-500/15 px-5 py-3 text-sm font-semibold text-sky-200
                                          ring-1 ring-sky-400/25 transition hover:bg-sky-500/20 focus:outline-none focus:ring-4 focus:ring-sky-500/15">
                                    Masuk
                                </a>

                                @if(Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="inline-flex items-center justify-center rounded-xl border border-white/12 bg-white/5 px-5 py-3 text-sm font-semibold text-white/85
                                              transition hover:bg-white/10 hover:border-white/20 focus:outline-none focus:ring-4 focus:ring-sky-500/10">
                                        Daftar
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="border-t border-white/10 px-6 py-4 md:px-8 flex items-center justify-between text-[11px] text-white/45">
                            <span>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</span>
                            <span>Navy-metal theme · Dashboard</span>
                        </div>
                    </div>
                @endauth
            </div>
        </section>
    </div>
</x-layouts.app>