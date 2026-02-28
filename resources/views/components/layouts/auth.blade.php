<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-zinc-950 text-zinc-100 antialiased">
    {{-- Background --}}
    <div class="pointer-events-none fixed inset-0">
        {{-- gradient base --}}
        <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-zinc-950 to-slate-900"></div>

        {{-- soft glows --}}
        <div class="absolute -top-40 left-1/2 h-[520px] w-[820px] -translate-x-1/2 rounded-full blur-3xl opacity-30 bg-blue-600"></div>
        <div class="absolute -bottom-40 right-[-120px] h-[520px] w-[520px] rounded-full blur-3xl opacity-20 bg-sky-500"></div>

        {{-- subtle grid --}}
        <div class="absolute inset-0 opacity-[0.08]"
             style="background-image: linear-gradient(to right, rgba(255,255,255,0.18) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(255,255,255,0.18) 1px, transparent 1px);
                    background-size: 64px 64px;">
        </div>
    </div>

    <main class="relative flex min-h-screen items-center justify-center px-4 py-12">
        <div class="w-full max-w-5xl">
            <div class="grid items-center gap-10 lg:grid-cols-2">
                {{-- Left panel --}}
                <section class="hidden lg:block">
                    <div class="rounded-3xl border border-white/10 bg-white/5 p-10 shadow-2xl shadow-black/40 backdrop-blur">
                        <div class="flex items-center gap-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/10 ring-1 ring-white/10">
                                <span class="text-lg font-extrabold tracking-wide text-white">CM</span>
                            </div>

                            <div>
                                <div class="text-sm font-semibold text-white/70">Aluminium &amp; Solutions</div>
                                <div class="text-2xl font-extrabold tracking-tight text-white">PT Caturmala</div>
                            </div>
                        </div>

                        <div class="mt-8 space-y-3 text-sm text-white/70">
                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-blue-400/80"></span>
                                <p>Dashboard internal untuk monitoring produk, pesanan, dan aktivitas operasional.</p>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-blue-400/80"></span>
                                <p>Keamanan akses dengan autentikasi pengguna &amp; role (Admin / User).</p>
                            </div>

                            <div class="flex items-start gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-blue-400/80"></span>
                                <p>Tampilan dark corporate dengan aksen navy–metal.</p>
                            </div>
                        </div>

                        <div class="mt-10 rounded-2xl border border-white/10 bg-black/20 p-5">
                            <div class="text-xs font-semibold text-white/60">Tip</div>
                            <div class="mt-1 text-sm text-white/75">
                                Gunakan akun yang sudah dibuat dari register / seeder untuk masuk ke sistem.
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Auth card --}}
                <section>
                    <div class="mx-auto w-full max-w-md">
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-8 shadow-2xl shadow-black/40 backdrop-blur">
                            {{ $slot }}
                        </div>

                        <div class="mt-6 text-center text-xs text-white/50">
                            © {{ date('Y') }} PT Caturmala • Internal System
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    @fluxScripts
</body>
</html>