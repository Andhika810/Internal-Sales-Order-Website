<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')

    {{-- SweetAlert2 (kalau sudah ada di partials.head, boleh hapus baris ini) --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ====== Sidebar theme (ONLY VISUAL) ====== */
        .cm-sidebar {
            background: linear-gradient(180deg,
                rgba(2, 6, 23, .98) 0%,
                rgba(3, 7, 18, .98) 60%,
                rgba(9, 9, 11, .98) 100%);
            border-right: 1px solid rgba(255,255,255,.08);
        }

        .cm-brand { border-bottom: 1px solid rgba(255,255,255,.08); }

        .cm-nav-item {
            position: relative;
            border-radius: 14px;
            transition: background-color .18s ease, transform .18s ease, box-shadow .18s ease;
        }
        .cm-nav-item:hover {
            background: rgba(255,255,255,.06);
            transform: translateX(2px);
        }

        .cm-nav-item[data-active="1"] {
            background: rgba(255,255,255,.08);
            box-shadow: 0 0 0 1px rgba(255,255,255,.08) inset;
        }
        .cm-nav-item::before{
            content:"";
            position:absolute;
            left:10px;
            top:50%;
            transform: translateY(-50%);
            width:0px;
            height:18px;
            border-radius:999px;
            background: linear-gradient(180deg, rgba(56,189,248,.95), rgba(59,130,246,.95));
            opacity:0;
            transition: width .18s ease, opacity .18s ease;
        }
        .cm-nav-item[data-active="1"]::before{
            width:4px;
            opacity:1;
        }

        .cm-badge {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
        }
    </style>
</head>

<body class="min-h-screen bg-[#070D18] text-white">
    <flux:sidebar sticky stashable class="cm-sidebar">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        {{-- BRAND --}}
        <div class="cm-brand pb-3">
            @php
                $brandHref = route('produk.index');
                if (auth()->check() && auth()->user()->isAdmin()) {
                    $brandHref = route('dashboard');
                }
            @endphp

            <a href="{{ $brandHref }}" class="me-5 flex items-center gap-3 px-2 py-2 rtl:space-x-reverse" wire:navigate>
                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-white/5 ring-1 ring-white/10">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" class="opacity-90">
                        <path d="M4 7.5 12 3l8 4.5v9L12 21l-8-4.5v-9Z" stroke="rgba(255,255,255,.85)" stroke-width="1.6" />
                        <path d="M8 10.5h8M8 13.5h8" stroke="rgba(56,189,248,.95)" stroke-width="1.6" stroke-linecap="round"/>
                    </svg>
                </span>

                <div class="leading-tight">
                    <div class="text-[11px] tracking-wide text-zinc-300/80">Aluminium &amp; Solutions</div>
                    <div class="font-semibold text-[15px] text-white">PT Caturmala</div>
                </div>
            </a>

            <div class="px-2 pt-1">
                <div class="flex flex-wrap gap-2">
                    <span class="cm-badge rounded-full px-3 py-1 text-[11px] text-zinc-200">Sales</span>
                    <span class="cm-badge rounded-full px-3 py-1 text-[11px] text-zinc-200">Inventory</span>
                    <span class="cm-badge rounded-full px-3 py-1 text-[11px] text-zinc-200">Orders</span>
                </div>
            </div>
        </div>

        <flux:navlist variant="outline" class="mt-3">
            @auth
                @if(auth()->user()->isAdmin())
                    <flux:navlist.group heading="Admin" class="grid text-zinc-300">
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate
                            class="cm-nav-item px-3 py-2.5 text-zinc-200" :data-active="request()->routeIs('dashboard') ? 1 : 0">
                            Dashboard
                        </flux:navlist.item>

                        <flux:navlist.item icon="users" :href="route('admin.pengguna')" :current="request()->routeIs('admin.pengguna')" wire:navigate
                            class="cm-nav-item px-3 py-2.5 text-zinc-200" :data-active="request()->routeIs('admin.pengguna') ? 1 : 0">
                            Pengguna
                        </flux:navlist.item>

                        <flux:navlist.item icon="archive" :href="route('admin.produk')" :current="request()->routeIs('admin.produk')" wire:navigate
                            class="cm-nav-item px-3 py-2.5 text-zinc-200" :data-active="request()->routeIs('admin.produk') ? 1 : 0">
                            Produk
                        </flux:navlist.item>

                        <flux:navlist.item icon="shopping-bag" :href="route('admin.pesanan')" :current="request()->routeIs('admin.pesanan')" wire:navigate
                            class="cm-nav-item px-3 py-2.5 text-zinc-200" :data-active="request()->routeIs('admin.pesanan') ? 1 : 0">
                            Pesanan
                        </flux:navlist.item>
                    </flux:navlist.group>
                @else
                    <flux:navlist.group heading="Menu" class="grid text-zinc-300">
                        <flux:navlist.item icon="archive" :href="route('produk.index')"
                            :current="request()->routeIs('produk.index') || request()->routeIs('produk.show')"
                            wire:navigate class="cm-nav-item px-3 py-2.5 text-zinc-200"
                            :data-active="(request()->routeIs('produk.index') || request()->routeIs('produk.show')) ? 1 : 0">
                            Produk
                        </flux:navlist.item>

                        <flux:navlist.item icon="shopping-cart" :href="route('keranjang.index')" :current="request()->routeIs('keranjang.index')" wire:navigate
                            class="cm-nav-item px-3 py-2.5 text-zinc-200" :data-active="request()->routeIs('keranjang.index') ? 1 : 0">
                            Keranjang
                        </flux:navlist.item>
                    </flux:navlist.group>
                @endif
            @else
                <flux:navlist.group heading="Menu" class="grid text-zinc-300">
                    <flux:navlist.item icon="archive" :href="route('produk.index')" :current="request()->routeIs('produk.index')" wire:navigate
                        class="cm-nav-item px-3 py-2.5 text-zinc-200" :data-active="request()->routeIs('produk.index') ? 1 : 0">
                        Produk
                    </flux:navlist.item>
                </flux:navlist.group>
            @endauth
        </flux:navlist>

        <flux:spacer />

        @auth
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()" icon:trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
        @endauth
    </flux:sidebar>

    {{-- SLOT --}}
    {{ $slot }}

    {{-- ✅ Toast Overlay GLOBAL --}}
    <div id="cm-toast" class="fixed inset-0 z-[9999] hidden items-center justify-center">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

        <div class="relative w-[92%] max-w-md rounded-2xl border border-white/10 bg-[#0B1426]/90 p-6 shadow-[0_30px_80px_rgba(0,0,0,.55)]">
            <div class="flex flex-col items-center text-center gap-3">
                <div id="cm-toast-icon"
                    class="h-14 w-14 rounded-full bg-emerald-500/15 ring-1 ring-emerald-400/25 flex items-center justify-center">
                </div>

                <div class="text-xl font-semibold text-white" id="cm-toast-title">Berhasil</div>
                <div class="text-sm text-white/70" id="cm-toast-msg">Pesanan berhasil dibuat.</div>

                <button id="cm-toast-btn"
                    class="mt-2 inline-flex items-center justify-center rounded-xl bg-sky-500/15 px-5 py-2.5 text-sm font-semibold text-sky-200
                           ring-1 ring-sky-400/25 transition hover:bg-sky-500/20">
                    OK
                </button>
            </div>
        </div>
    </div>

    {{-- ✅ WAJIB: Livewire Scripts --}}
    @livewireScripts
    @fluxScripts

    {{-- ✅ Toast Listener (aman untuk wire:navigate) --}}
    <script>
        (function initToastOnce(){
            if (window.__CM_TOAST_INIT__) return;
            window.__CM_TOAST_INIT__ = true;

            const el = () => document.getElementById('cm-toast');
            const title = () => document.getElementById('cm-toast-title');
            const msg = () => document.getElementById('cm-toast-msg');
            const btn = () => document.getElementById('cm-toast-btn');
            const iconWrap = () => document.getElementById('cm-toast-icon');

            function setIcon(type){
                const w = iconWrap();
                if (!w) return;

                if (type === 'error') {
                    w.className = "h-14 w-14 rounded-full bg-rose-500/15 ring-1 ring-rose-400/25 flex items-center justify-center";
                    w.innerHTML = `
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <path d="M18 6L6 18M6 6l12 12" stroke="rgba(253,164,175,1)" stroke-width="2.5" stroke-linecap="round"/>
                        </svg>`;
                } else {
                    w.className = "h-14 w-14 rounded-full bg-emerald-500/15 ring-1 ring-emerald-400/25 flex items-center justify-center";
                    w.innerHTML = `
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none">
                            <path d="M20 6L9 17L4 12" stroke="rgba(110,231,183,1)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>`;
                }
            }

            function openToast(data){
                const toast = el();
                if (!toast) return;

                title().textContent = data.title || 'Info';
                msg().textContent = data.message || '';
                setIcon((data.type || 'success'));

                toast.classList.remove('hidden');
                toast.classList.add('flex');

                const close = () => {
                    toast.classList.add('hidden');
                    toast.classList.remove('flex');
                };

                btn().onclick = () => {
                    close();
                    if (data.redirect) window.location.href = data.redirect;
                };

                if ((data.type || 'success') !== 'error' && data.redirect) {
                    setTimeout(() => {
                        close();
                        window.location.href = data.redirect;
                    }, 1200);
                }
            }

            // ✅ Paling aman untuk Livewire v3 dispatch: browser event
            window.addEventListener('toast', (e) => {
                openToast(e.detail || {});
            });

            // ✅ fallback jika ternyata event dikirim sebagai Livewire event
            document.addEventListener('livewire:init', () => {
                if (window.Livewire && typeof window.Livewire.on === 'function') {
                    window.Livewire.on('toast', (payload) => {
                        const data = payload?.[0] ?? payload ?? {};
                        openToast(data);
                    });
                }
            });
        })();
    </script>
</body>
</html>