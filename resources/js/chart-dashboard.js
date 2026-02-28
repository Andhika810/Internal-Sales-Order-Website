document.addEventListener('DOMContentLoaded', renderCharts);
document.addEventListener('livewire:navigated', renderCharts);

function renderCharts() {
    if (typeof window.Chart === 'undefined') return;

    const THEME = {
        text: 'rgba(244, 244, 245, 0.92)',
        muted: 'rgba(161, 161, 170, 0.85)',
        grid: 'rgba(255, 255, 255, 0.08)',
        border: 'rgba(255, 255, 255, 0.10)',
        tooltipBg: 'rgba(9, 9, 11, 0.95)',
        tooltipBorder: 'rgba(255, 255, 255, 0.12)',
    };

    // Global defaults (safe if called multiple times)
    window.Chart.defaults.color = THEME.muted;
    window.Chart.defaults.font.family =
        'ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji"';

    function createOrUpdateChart(canvas, config) {
        if (canvas._chartInstance) canvas._chartInstance.destroy();
        canvas._chartInstance = new window.Chart(canvas.getContext('2d'), config);
    }

    const commonPlugins = {
        legend: {
            display: true,
            position: 'top',
            align: 'start',
            labels: {
                color: THEME.muted,
                usePointStyle: true,
                pointStyle: 'circle',
                padding: 16,
                font: { size: 11, weight: '600' },
            },
        },
        tooltip: {
            enabled: true,
            backgroundColor: THEME.tooltipBg,
            borderColor: THEME.tooltipBorder,
            borderWidth: 1,
            titleColor: THEME.text,
            bodyColor: THEME.text,
            padding: 12,
            cornerRadius: 10,
            displayColors: true,
            boxPadding: 6,
            callbacks: {
                label: (ctx) => {
                    const label = ctx.dataset?.label ?? ctx.label ?? '';
                    const val = ctx.parsed?.y ?? ctx.parsed ?? 0;
                    return label ? `${label}: ${val}` : `${val}`;
                },
            },
        },
    };

    const commonScales = {
        x: {
            grid: { color: THEME.grid, drawBorder: false },
            ticks: { color: THEME.muted, font: { size: 11 } },
        },
        y: {
            beginAtZero: true,
            grid: { color: THEME.grid, drawBorder: false },
            ticks: { color: THEME.muted, font: { size: 11 } },
        },
    };

    function enhanceDatasets(data, chartType) {
        if (!data || !Array.isArray(data.datasets)) return data;

        data.datasets = data.datasets.map((ds) => {
            const enhanced = { ...ds };

            if (chartType === 'bar') {
                enhanced.borderRadius = 10;
                enhanced.borderSkipped = false;
                enhanced.borderWidth = 0;
                enhanced.maxBarThickness = 36;
            }

            if (enhanced.type === 'line' || chartType === 'line') {
                enhanced.tension = 0.35;
                enhanced.borderWidth = enhanced.borderWidth ?? 2;
                enhanced.pointRadius = 2;
                enhanced.pointHoverRadius = 4;
                enhanced.pointBorderWidth = 0;
                enhanced.fill = enhanced.fill ?? false;
            }

            if (chartType === 'pie' || chartType === 'doughnut') {
                enhanced.borderColor = THEME.border;
                enhanced.borderWidth = 1;
            }

            return enhanced;
        });

        return data;
    }

    // ✅ IMPORTANT FIX: keep aspect ratio so canvas always has stable height
    function baseOptions({ showLegend = true, aspectRatio = 2.2 } = {}) {
        return {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio,
            animation: { duration: 650, easing: 'easeOutQuart' },
            plugins: {
                ...commonPlugins,
                legend: { ...commonPlugins.legend, display: showLegend },
            },
        };
    }

    function cartesianOptions({ showLegend = true, aspectRatio = 2.2, extraScales = {} } = {}) {
        return {
            ...baseOptions({ showLegend, aspectRatio }),
            scales: {
                ...commonScales,
                ...extraScales,
            },
        };
    }

    // Admin: Penjualan & Pendapatan per Bulan
    const adminOrders = document.getElementById('admin-orders-chart');
    if (adminOrders) {
        const chartData = enhanceDatasets(JSON.parse(adminOrders.dataset.chart), 'bar');
        createOrUpdateChart(adminOrders, {
            type: 'bar',
            data: chartData,
            options: cartesianOptions({
                showLegend: true,
                aspectRatio: 2.4,
                extraScales: {
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: { color: THEME.muted, font: { size: 11 } },
                    },
                },
            }),
        });
    }

    // Admin: Produk Terlaris
    const adminTopProducts = document.getElementById('admin-top-products-chart');
    if (adminTopProducts) {
        const chartData = enhanceDatasets(JSON.parse(adminTopProducts.dataset.chart), 'bar');
        createOrUpdateChart(adminTopProducts, {
            type: 'bar',
            data: chartData,
            options: cartesianOptions({ showLegend: false, aspectRatio: 2.4 }),
        });
    }

    // Admin: Status Pesanan
    const adminStatus = document.getElementById('admin-status-chart');
    if (adminStatus) {
        const chartData = enhanceDatasets(JSON.parse(adminStatus.dataset.chart), 'pie');
        createOrUpdateChart(adminStatus, {
            type: 'pie',
            data: chartData,
            options: baseOptions({ showLegend: true, aspectRatio: 1.6 }),
        });
    }

    // Admin: User Baru per Bulan
    const adminUsers = document.getElementById('admin-users-chart');
    if (adminUsers) {
        const chartData = enhanceDatasets(JSON.parse(adminUsers.dataset.chart), 'line');
        createOrUpdateChart(adminUsers, {
            type: 'line',
            data: chartData,
            options: cartesianOptions({ showLegend: false, aspectRatio: 2.4 }),
        });
    }

    // Customer: Pengeluaran per Bulan
    const customerSpending = document.getElementById('customer-spending-chart');
    if (customerSpending) {
        const chartData = enhanceDatasets(JSON.parse(customerSpending.dataset.chart), 'line');
        createOrUpdateChart(customerSpending, {
            type: 'line',
            data: chartData,
            options: cartesianOptions({ showLegend: false, aspectRatio: 2.4 }),
        });
    }

    // Customer: Status Pesanan
    const customerStatus = document.getElementById('customer-status-chart');
    if (customerStatus) {
        const chartData = enhanceDatasets(JSON.parse(customerStatus.dataset.chart), 'pie');
        createOrUpdateChart(customerStatus, {
            type: 'pie',
            data: chartData,
            options: baseOptions({ showLegend: true, aspectRatio: 1.6 }),
        });
    }
}