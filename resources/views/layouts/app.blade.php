<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Caturmala · Aluminium & Solutions</title>

    {{-- Kalau project kamu sudah pakai Vite (biasanya iya), ini yang benar: --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="h-full bg-[#070D18] text-white antialiased">
    {{-- Background global: navy-metal + grid halus --}}
    <div class="min-h-screen bg-gradient-to-b from-[#0E1A2E] via-[#0B1426] to-[#070D18]">
        <div class="pointer-events-none fixed inset-0 opacity-[0.14]"
             style="background-image: linear-gradient(rgba(255,255,255,.08) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.08) 1px, transparent 1px); background-size: 60px 60px;">
        </div>
        <div class="pointer-events-none fixed -top-28 -left-28 h-[420px] w-[420px] rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="pointer-events-none fixed -bottom-28 -right-28 h-[420px] w-[420px] rounded-full bg-indigo-500/10 blur-3xl"></div>

        {{-- Topbar --}}
        <header class="sticky top-0 z-40 border-b border-white/10 bg-[#070D18]/60 backdrop-blur-xl">
            <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-4 px-4 py-3 md:px-8">
                {{-- Brand --}}
                <a href="/" class="flex items-center gap-3">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white/8 ring-1 ring-white/10 shadow-[0_12px_30px_rgba(0,0,0,.35)]">
                        {{-- simple logo mark --}}
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                            <path d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2" opacity=".9"/>
                            <path d="M8 8h8M8 12h8M8 16h6" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity=".85"/>
                        </svg>
                    </span>

                    <div class="leading-tight">
                        <div class="text-[11px] font-medium tracking-wide text-white/60">
                            Aluminium & Solutions
                        </div>
                        <div class="text-sm font-semibold tracking-tight text-white">
                            PT Caturmala
                        </div>
                    </div>
                </a>

                {{-- Nav links (tetap sama functionnya) --}}
                <nav class="hidden items-center gap-2 md:flex">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="/admin/pengguna"
                               class="rounded-xl px-3 py-2 text-sm text-white/75 ring-1 ring-white/10 hover:bg-white/8 hover:text-white transition">
                                Pengguna
                            </a>
                            <a href="/admin/produk"
                               class="rounded-xl px-3 py-2 text-sm text-white/75 ring-1 ring-white/10 hover:bg-white/8 hover:text-white transition">
                                Produk
                            </a>
                            <a href="/admin/pesanan"
                               class="rounded-xl px-3 py-2 text-sm text-white/75 ring-1 ring-white/10 hover:bg-white/8 hover:text-white transition">
                                Pesanan
                            </a>
                        @else
                            <a href="/produk"
                               class="rounded-xl px-3 py-2 text-sm text-white/75 ring-1 ring-white/10 hover:bg-white/8 hover:text-white transition">
                                Produk Aluminium
                            </a>
                            <a href="/keranjang"
                               class="rounded-xl px-3 py-2 text-sm text-white/75 ring-1 ring-white/10 hover:bg-white/8 hover:text-white transition">
                                Penawaran
                            </a>
                            <a href="/pesanan/riwayat"
                               class="rounded-xl px-3 py-2 text-sm text-white/75 ring-1 ring-white/10 hover:bg-white/8 hover:text-white transition">
                                Riwayat Transaksi
                            </a>
                            <a href="/pesanan/lacak"
                               class="rounded-xl px-3 py-2 text-sm text-white/75 ring-1 ring-white/10 hover:bg-white/8 hover:text-white transition">
                                Tracking Project
                            </a>
                        @endif
                    @else
                        <a href="/login"
                           class="rounded-xl px-3 py-2 text-sm text-white/75 ring-1 ring-white/10 hover:bg-white/8 hover:text-white transition">
                            Masuk
                        </a>
                        <a href="/register"
                           class="rounded-xl bg-sky-500/15 px-3 py-2 text-sm font-semibold text-sky-200 ring-1 ring-sky-400/25 hover:bg-sky-500/20 transition">
                            Daftar
                        </a>
                    @endauth
                </nav>

                {{-- Right (user + logout) --}}
                <div class="flex items-center gap-3">
                    @auth
                        <div class="hidden md:flex items-center gap-3">
                            <div class="text-right">
                                <div class="text-xs text-white/55">Signed in as</div>
                                <div class="text-sm font-semibold text-white/85">{{ auth()->user()->name }}</div>
                            </div>

                            <form action="/logout" method="POST" class="inline">
                                @csrf
                                <button
                                    type="submit"
                                    class="rounded-xl border border-white/12 bg-white/5 px-3 py-2 text-sm font-semibold text-white/80
                                           hover:bg-white/10 hover:border-white/20 transition focus:outline-none focus:ring-4 focus:ring-sky-500/10"
                                >
                                    Keluar
                                </button>
                            </form>
                        </div>
                    @endauth

                    {{-- Mobile menu hint (biar rapi di HP) --}}
                    <div class="md:hidden text-xs text-white/60">
                        Menu tersedia di sidebar
                    </div>
                </div>
            </div>
        </header>

        {{-- Main: full width + tidak pakai container ketat biar page kamu bisa full panel --}}
        <main class="relative mx-auto w-full max-w-7xl px-4 py-6 md:px-8 md:py-8">
            @yield('content')
            {{ $slot ?? '' }}
        </main>

        {{-- Footer kecil --}}
        <footer class="relative mx-auto w-full max-w-7xl px-4 pb-8 md:px-8">
            <div class="text-[11px] text-white/45 flex items-center justify-between border-t border-white/10 pt-4">
                <span>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</span>
                <span>Navy-metal theme</span>
            </div>
        </footer>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('livewire:loading', () => {
                let loader = document.getElementById('lw-full-loader');
                if (loader) loader.classList.remove('hidden');
            });
            window.addEventListener('livewire:load', () => {
                let loader = document.getElementById('lw-full-loader');
                if (loader) loader.classList.add('hidden');
            });
            window.addEventListener('livewire:finished', () => {
                let loader = document.getElementById('lw-full-loader');
                if (loader) loader.classList.add('hidden');
            });
        });
    </script>

    {{-- Loader --}}
    <div id="lw-full-loader"
         class="fixed inset-0 z-50 flex items-center justify-center bg-[#070D18]/75 backdrop-blur-md hidden">
        <div class="flex flex-col items-center gap-4">
            <div class="h-14 w-14 rounded-full border-4 border-white/25 border-t-sky-300/80 animate-spin"></div>
            <div class="text-xs text-white/70">Memuat…</div>
        </div>
    </div>
</body>
</html>