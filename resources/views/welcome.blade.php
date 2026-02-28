<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'PT Caturmala') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full bg-slate-950 text-slate-100">
<div class="relative min-h-screen overflow-hidden">
    {{-- BACKDROP --}}
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute -top-32 -left-32 h-[420px] w-[420px] rounded-full bg-blue-600/20 blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 h-[520px] w-[520px] rounded-full bg-cyan-400/10 blur-3xl"></div>

        <div class="absolute inset-0 opacity-[0.12]">
            <div class="h-full w-full"
                 style="background-image: linear-gradient(rgba(148,163,184,.25) 1px, transparent 1px), linear-gradient(90deg, rgba(148,163,184,.25) 1px, transparent 1px);
                        background-size: 44px 44px;">
            </div>
        </div>
    </div>

    {{-- TOP BAR --}}
    <header class="relative z-10 border-b border-white/10 bg-slate-950/40 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <x-caturmala-logo class="h-11 w-11" />
                <div class="leading-tight">
                    <div class="text-xs tracking-wide text-slate-300/80">Aluminium &amp; Solutions</div>
                    <div class="text-lg font-semibold text-slate-100">PT Caturmala</div>
                </div>
            </a>

            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-blue-600/90 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 ring-1 ring-white/10 transition hover:bg-blue-600">
                        Dashboard
                        <span aria-hidden="true">→</span>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center justify-center rounded-xl bg-white/5 px-4 py-2 text-sm font-semibold text-slate-100 ring-1 ring-white/10 transition hover:bg-white/10">
                        Masuk
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-blue-600/90 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 ring-1 ring-white/10 transition hover:bg-blue-600">
                            Daftar
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="relative z-10">
        <div class="mx-auto max-w-6xl px-6 py-12 lg:py-16">
            {{-- Hero + Panel (lebih “isi”, rapi, dan center) --}}
            <div class="grid items-center gap-10 lg:grid-cols-12">
                {{-- LEFT / HERO --}}
                <section class="lg:col-span-7">
                    <div class="mx-auto max-w-2xl lg:mx-0">
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/5 px-3 py-1 text-xs text-slate-200 ring-1 ring-white/10">
                            <span class="h-1.5 w-1.5 rounded-full bg-blue-400"></span>
                            Aluminium • Sales • Inventory • Orders
                        </div>

                        <h1 class="mt-4 text-4xl font-semibold leading-tight tracking-tight text-slate-50 sm:text-5xl">
                            Sistem Operasional
                            <span class="text-blue-300">Aluminium</span>
                            yang rapi &amp; terukur
                        </h1>

                        <p class="mt-4 text-base leading-relaxed text-slate-300">
                            PT Caturmala menyediakan solusi aluminium untuk kebutuhan proyek dan retail:
                            <span class="text-slate-200 font-medium">Extrusion</span>,
                            <span class="text-slate-200 font-medium">Glass &amp; Facade</span>,
                            <span class="text-slate-200 font-medium">ACP</span>,
                            <span class="text-slate-200 font-medium">Partition</span>, hingga
                            <span class="text-slate-200 font-medium">Hardware</span>.
                            Semua dikelola dalam satu sistem yang aman dan konsisten.
                        </p>

                        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                            <a href="{{ route('produk.index') }}"
                               class="inline-flex items-center justify-center gap-2 rounded-2xl bg-blue-600/90 px-6 py-3 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 ring-1 ring-white/10 transition hover:bg-blue-600">
                                Lihat Katalog Produk
                                <span aria-hidden="true">→</span>
                            </a>

                            @auth
                                <a href="{{ route('dashboard') }}"
                                   class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white/5 px-6 py-3 text-sm font-semibold text-slate-100 ring-1 ring-white/10 transition hover:bg-white/10">
                                    Masuk ke Dashboard
                                </a>
                            @endauth
                        </div>

                        {{-- Quick stats (statis) --}}
                        <div class="mt-10 grid gap-3 sm:grid-cols-3">
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <div class="text-xs text-slate-300/80">Fokus</div>
                                <div class="mt-1 text-sm font-semibold text-slate-100">Project & Retail</div>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <div class="text-xs text-slate-300/80">Workflow</div>
                                <div class="mt-1 text-sm font-semibold text-slate-100">Order → Tracking</div>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                <div class="text-xs text-slate-300/80">Keamanan</div>
                                <div class="mt-1 text-sm font-semibold text-slate-100">Role-based access</div>
                            </div>
                        </div>

                        {{-- PRODUCT TAGS --}}
                        <div class="mt-8 flex flex-wrap gap-2">
                            @foreach ([
                                'Extrusion Profiles',
                                'Glass & Facade',
                                'ACP (Aluminium Composite Panel)',
                                'Partition & Interior',
                                'Accessories & Hardware',
                                'Custom Order Project'
                            ] as $tag)
                                <span class="rounded-full bg-white/5 px-3 py-1 text-xs text-slate-200 ring-1 ring-white/10">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- RIGHT / INFO PANEL (statis, biar gak sepi) --}}
                <section class="lg:col-span-5">
                    <div class="rounded-[28px] bg-gradient-to-b from-white/10 to-white/5 p-[1px] shadow-2xl shadow-black/40">
                        <div class="rounded-[27px] bg-slate-950/60 p-6 ring-1 ring-white/10 backdrop-blur">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-xs uppercase tracking-widest text-slate-300/70">Overview</div>
                                    <div class="mt-1 text-lg font-semibold text-slate-100">Ringkasan Layanan</div>
                                </div>
                                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1 text-xs text-emerald-200 ring-1 ring-emerald-300/20">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                    Online
                                </div>
                            </div>

                            {{-- Highlights --}}
                            <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                                <div class="rounded-2xl bg-white/5 p-5 ring-1 ring-white/10">
                                    <div class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-600/15 ring-1 ring-blue-400/20">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                <path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity=".9"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-100">Katalog Terstruktur</div>
                                            <div class="mt-1 text-sm text-slate-300">Produk rapi, detail jelas, siap untuk penawaran.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-2xl bg-white/5 p-5 ring-1 ring-white/10">
                                    <div class="flex items-start gap-3">
                                        <span class="mt-0.5 inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-cyan-500/15 ring-1 ring-cyan-400/20">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" opacity=".9"/>
                                                <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="2" opacity=".7"/>
                                            </svg>
                                        </span>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-100">Tracking & Riwayat</div>
                                            <div class="mt-1 text-sm text-slate-300">Pantau status pesanan dan histori transaksi.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- How it works --}}
                            <div class="mt-6 rounded-2xl bg-white/5 p-5 ring-1 ring-white/10">
                                <div class="text-sm font-semibold text-slate-100">Cara Order (Singkat)</div>
                                <ol class="mt-3 space-y-2 text-sm text-slate-300">
                                    <li class="flex gap-3">
                                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-white/5 ring-1 ring-white/10 text-xs font-semibold text-slate-100">1</span>
                                        <span>Pilih produk dari katalog.</span>
                                    </li>
                                    <li class="flex gap-3">
                                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-white/5 ring-1 ring-white/10 text-xs font-semibold text-slate-100">2</span>
                                        <span>Tambahkan ke keranjang dan checkout.</span>
                                    </li>
                                    <li class="flex gap-3">
                                        <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-white/5 ring-1 ring-white/10 text-xs font-semibold text-slate-100">3</span>
                                        <span>Admin memproses, kamu bisa lacak statusnya.</span>
                                    </li>
                                </ol>
                            </div>

                            {{-- Trusted / Notes --}}
                            <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-2">
                                <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                    <div class="text-xs text-slate-300/80">Standar</div>
                                    <div class="mt-1 text-sm font-semibold text-slate-100">QC & Konsistensi</div>
                                </div>
                                <div class="rounded-2xl bg-white/5 p-4 ring-1 ring-white/10">
                                    <div class="text-xs text-slate-300/80">Support</div>
                                    <div class="mt-1 text-sm font-semibold text-slate-100">Respons cepat</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="relative z-10 border-t border-white/10 bg-slate-950/30">
        <div class="mx-auto flex max-w-6xl flex-col gap-2 px-6 py-6 text-sm text-slate-400 sm:flex-row sm:items-center sm:justify-between">
            <div>© {{ date('Y') }} PT Caturmala. All rights reserved.</div>
            <div class="text-slate-400/80">Aluminium &amp; Solutions • Internal System</div>
        </div>
    </footer>
</div>
</body>
</html>