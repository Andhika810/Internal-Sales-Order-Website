@php
    // =========================
    // ADMIN CHART DATA
    // =========================
    $orderChart = [
        'labels' => $adminData['orders']['labels'] ?? [],
        'datasets' => [
            [
                'label' => 'Jumlah Pesanan',
                'data' => $adminData['orders']['data'] ?? [],
                'backgroundColor' => 'rgba(59,130,246,0.55)', // navy-blue
                'yAxisID' => 'y',
            ],
            [
                'label' => 'Total Pendapatan',
                'data' => $adminData['orders']['income'] ?? [],
                'backgroundColor' => 'rgba(34,197,94,0.25)',
                'borderColor' => 'rgba(34,197,94,0.9)',
                'type' => 'line',
                'yAxisID' => 'y1',
            ]
        ]
    ];

    $topProductsChart = [
        'labels' => $adminData['top_products']['labels'] ?? [],
        'datasets' => [[
            'label' => 'Produk Terlaris',
            'data' => $adminData['top_products']['data'] ?? [],
            'backgroundColor' => 'rgba(96,165,250,0.65)',
        ]]
    ];

    $statusChart = [
        'labels' => array_keys($adminData['status'] ?? []),
        'datasets' => [[
            'label' => 'Status Pesanan',
            'data' => array_values($adminData['status'] ?? []),
            'backgroundColor' => [
                'rgba(59,130,246,0.75)',  // biru
                'rgba(34,197,94,0.75)',   // hijau
                'rgba(251,191,36,0.75)',  // kuning
                'rgba(244,63,94,0.75)',   // merah
            ],
        ]]
    ];

    $userChart = [
        'labels' => $adminData['users']['labels'] ?? [],
        'datasets' => [[
            'label' => 'User Baru',
            'data' => $adminData['users']['data'] ?? [],
            'backgroundColor' => 'rgba(148,163,184,0.6)',
            'borderColor' => 'rgba(148,163,184,0.95)',
        ]]
    ];

    // =========================
    // CUSTOMER CHART DATA
    // =========================
    $spendingChart = [
        'labels' => $customerData['spending']['labels'] ?? [],
        'datasets' => [[
            'label' => 'Pengeluaran',
            'data' => $customerData['spending']['data'] ?? [],
            'backgroundColor' => 'rgba(59,130,246,0.20)',
            'borderColor' => 'rgba(59,130,246,0.95)',
            'fill' => true,
            'tension' => 0.35,
        ]]
    ];

    $custStatusChart = [
        'labels' => array_keys($customerData['status'] ?? []),
        'datasets' => [[
            'label' => 'Status Pesanan',
            'data' => array_values($customerData['status'] ?? []),
            'backgroundColor' => [
                'rgba(59,130,246,0.75)',
                'rgba(34,197,94,0.75)',
                'rgba(251,191,36,0.75)',
                'rgba(244,63,94,0.75)',
            ],
        ]]
    ];

    // =========================
    // QUICK STATS (optional)
    // =========================
    $statTotalProduk   = $adminData['stats']['total_products'] ?? $customerData['stats']['total_products'] ?? null;
    $statTotalPesanan  = $adminData['stats']['total_orders'] ?? $customerData['stats']['total_orders'] ?? null;
    $statPendapatan    = $adminData['stats']['total_income'] ?? $customerData['stats']['total_income'] ?? null;

    // fallback dari chart kalau stats tidak ada
    if ($statTotalPesanan === null) {
        $statTotalPesanan = array_sum($adminData['orders']['data'] ?? []);
    }
    if ($statPendapatan === null) {
        $statPendapatan = array_sum($adminData['orders']['income'] ?? []);
    }
@endphp

<div class="w-full">
    {{-- PANEL UTAMA: full lebar, tidak kepotong --}}
    <div class="w-full rounded-2xl border border-slate-200/70 bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 shadow-xl ring-1 ring-white/5">
        <div class="px-6 py-6 md:px-10 md:py-8">
            {{-- HEADER (satu aja) --}}
            <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-semibold tracking-tight text-white">
                        Dashboard
                    </h1>
                    <p class="mt-1 text-sm text-slate-300">
                        Ringkasan performa & aktivitas terbaru · Mode {{ auth()->user()->isAdmin() ? 'Admin' : 'User' }}
                    </p>
                </div>

                <div class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-4 py-2 text-sm text-emerald-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_0_4px_rgba(16,185,129,0.12)]"></span>
                    Sistem aktif
                </div>
            </div>

            {{-- QUICK STATS (rapih, premium) --}}
            <div class="mt-6 grid gap-4 md:grid-cols-3">
                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <div class="text-sm text-slate-300">Total Produk</div>
                    <div class="mt-2 text-2xl font-semibold text-white">
                        {{ $statTotalProduk ?? 0 }}
                    </div>
                    <div class="mt-2 text-xs text-slate-400">Inventory master</div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <div class="text-sm text-slate-300">Total Pesanan</div>
                    <div class="mt-2 text-2xl font-semibold text-white">
                        {{ $statTotalPesanan ?? 0 }}
                    </div>
                    <div class="mt-2 text-xs text-slate-400">Order activity</div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur">
                    <div class="text-sm text-slate-300">Pendapatan</div>
                    <div class="mt-2 text-2xl font-semibold text-white">
                        Rp {{ number_format((float)($statPendapatan ?? 0), 0, ',', '.') }}
                    </div>
                    <div class="mt-2 text-xs text-slate-400">Revenue summary</div>
                </div>
            </div>

            {{-- CONTENT: charts --}}
            @if(auth()->user()->isAdmin())
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-sm backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-base font-semibold text-white">Penjualan & Pendapatan</h2>
                                <p class="mt-1 text-xs text-slate-300">Trend bulanan untuk monitoring performa</p>
                            </div>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Orders</span>
                        </div>

                        <div class="mt-4">
                            @if(empty(array_filter($orderChart['labels'])) || empty(array_filter($orderChart['datasets'][0]['data'])))
                                <div class="rounded-xl border border-dashed border-white/10 bg-black/10 py-10 text-center text-sm text-slate-300">
                                    Tidak ada data penjualan.
                                </div>
                            @else
                                <canvas id="admin-orders-chart" height="110" data-chart='@json($orderChart)'></canvas>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-sm backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-base font-semibold text-white">Produk Terlaris</h2>
                                <p class="mt-1 text-xs text-slate-300">Top items berdasarkan transaksi</p>
                            </div>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Inventory</span>
                        </div>

                        <div class="mt-4">
                            @if(empty(array_filter($topProductsChart['labels'])) || empty(array_filter($topProductsChart['datasets'][0]['data'])))
                                <div class="rounded-xl border border-dashed border-white/10 bg-black/10 py-10 text-center text-sm text-slate-300">
                                    Tidak ada data produk terlaris.
                                </div>
                            @else
                                <canvas id="admin-top-products-chart" height="110" data-chart='@json($topProductsChart)'></canvas>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-sm backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-base font-semibold text-white">Status Pesanan</h2>
                                <p class="mt-1 text-xs text-slate-300">Komposisi status order saat ini</p>
                            </div>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Status</span>
                        </div>

                        <div class="mt-4">
                            @if(empty(array_filter($statusChart['labels'])) || empty(array_filter($statusChart['datasets'][0]['data'])))
                                <div class="rounded-xl border border-dashed border-white/10 bg-black/10 py-10 text-center text-sm text-slate-300">
                                    Tidak ada data status pesanan.
                                </div>
                            @else
                                <canvas id="admin-status-chart" height="110" data-chart='@json($statusChart)'></canvas>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-sm backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-base font-semibold text-white">User Baru</h2>
                                <p class="mt-1 text-xs text-slate-300">Registrasi pengguna per bulan</p>
                            </div>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Users</span>
                        </div>

                        <div class="mt-4">
                            @if(empty(array_filter($userChart['labels'])) || empty(array_filter($userChart['datasets'][0]['data'])))
                                <div class="rounded-xl border border-dashed border-white/10 bg-black/10 py-10 text-center text-sm text-slate-300">
                                    Tidak ada data user baru.
                                </div>
                            @else
                                <canvas id="admin-users-chart" height="110" data-chart='@json($userChart)'></canvas>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-6 grid gap-6 md:grid-cols-2">
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-sm backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-base font-semibold text-white">Income</h2>
                                <p class="mt-1 text-xs text-slate-300">Grafik pengeluaran / spending</p>
                            </div>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Spending</span>
                        </div>

                        <div class="mt-4">
                            @if(empty(array_filter($spendingChart['labels'])) || empty(array_filter($spendingChart['datasets'][0]['data'])))
                                <div class="rounded-xl border border-dashed border-white/10 bg-black/10 py-10 text-center text-sm text-slate-300">
                                    Tidak ada data pengeluaran.
                                </div>
                            @else
                                <canvas id="customer-spending-chart" height="110" data-chart='@json($spendingChart)'></canvas>
                            @endif
                        </div>
                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-sm backdrop-blur">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-base font-semibold text-white">Status Pesanan</h2>
                                <p class="mt-1 text-xs text-slate-300">Ringkasan status order kamu</p>
                            </div>
                            <span class="rounded-full border border-white/10 bg-white/5 px-3 py-1 text-xs text-slate-200">Status</span>
                        </div>

                        <div class="mt-4">
                            @if(empty(array_filter($custStatusChart['labels'])) || empty(array_filter($custStatusChart['datasets'][0]['data'])))
                                <div class="rounded-xl border border-dashed border-white/10 bg-black/10 py-10 text-center text-sm text-slate-300">
                                    Tidak ada data status pesanan.
                                </div>
                            @else
                                <canvas id="customer-status-chart" height="110" data-chart='@json($custStatusChart)'></canvas>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- Footer kecil --}}
            <div class="mt-8 flex items-center justify-between text-xs text-slate-400">
                <div>© {{ date('Y') }} PT Caturmala · Aluminium & Solutions</div>
                <div class="hidden md:block">Navy-metal theme · Internal dashboard</div>
            </div>
        </div>
    </div>
</div>