@props([
    'weeklyVolume' => 0,
    'dailyAverage' => 0
])

<div class="relative p-6 overflow-hidden bg-white border shadow-card rounded-2xl dark:bg-slate-900 border-slate-200 dark:border-slate-800">

    {{-- DECORATIVE BACKGROUND GRADIENT --}}
    <div class="absolute top-0 right-0 w-64 h-64 rounded-full bg-gradient-to-br from-primary/5 to-transparent blur-3xl -z-0"></div>

    {{-- HEADER --}}
    <div class="relative z-10 flex items-start justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-primary/10 to-primary/5">
                    <span class="text-xl material-symbols-outlined text-primary">trending_up</span>
                </div>
                <h4 class="text-lg font-bold tracking-tight text-slate-900 dark:text-white">
                    Tren Volume Distribusi BBM
                </h4>
            </div>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Analisis distribusi BBM berdasarkan waktu
            </p>
        </div>

        <div class="flex items-center gap-2">
            {{-- Performance Badge --}}
            <div class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-green-700 bg-green-100 rounded-lg dark:bg-green-900/30 dark:text-green-400 shadow-sm">
                <span class="text-base material-symbols-outlined">arrow_upward</span>
                <span>Aktif</span>
            </div>
        </div>
    </div>

    {{-- CHART AREA --}}
    <div class="relative z-10 p-6 overflow-hidden border rounded-xl bg-gradient-to-br from-slate-50 to-slate-100/50 dark:from-slate-800/50 dark:to-slate-900/50 border-slate-200 dark:border-slate-700">

        {{-- GRID BACKGROUND --}}
        <div class="absolute inset-0 opacity-30">
            <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(0,0,0,0.03)_1px,transparent_1px),linear-gradient(to_bottom,rgba(0,0,0,0.03)_1px,transparent_1px)] bg-[size:32px_32px] dark:bg-[linear-gradient(to_right,rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.03)_1px,transparent_1px)]"></div>
        </div>

        {{-- MAIN CHART SVG --}}
        <div class="relative h-64">
            <svg viewBox="0 0 400 200" class="w-full h-full" preserveAspectRatio="none">
                <defs>
                    {{-- Gradient for area fill --}}
                    <linearGradient id="chartGradient" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="rgb(25, 93, 230)" stop-opacity="0.3"/>
                        <stop offset="50%" stop-color="rgb(25, 93, 230)" stop-opacity="0.1"/>
                        <stop offset="100%" stop-color="rgb(25, 93, 230)" stop-opacity="0"/>
                    </linearGradient>

                    {{-- Shadow filter --}}
                    <filter id="shadow">
                        <feDropShadow dx="0" dy="2" stdDeviation="3" flood-opacity="0.3"/>
                    </filter>
                </defs>

                {{-- Area fill --}}
                <path
                    d="M 0,160 L 60,140 L 120,150 L 180,110 L 240,120 L 300,80 L 360,90 L 400,85 L 400,200 L 0,200 Z"
                    fill="url(#chartGradient)"
                />

                {{-- Main line --}}
                <polyline
                    fill="none"
                    stroke="rgb(25, 93, 230)"
                    stroke-width="3"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    points="0,160 60,140 120,150 180,110 240,120 300,80 360,90 400,85"
                    filter="url(#shadow)"
                />

                {{-- Data points --}}
                <circle cx="0" cy="160" r="5" fill="white" stroke="rgb(25, 93, 230)" stroke-width="2" class="transition-opacity opacity-0 hover:opacity-100"/>
                <circle cx="60" cy="140" r="5" fill="white" stroke="rgb(25, 93, 230)" stroke-width="2" class="transition-opacity opacity-0 hover:opacity-100"/>
                <circle cx="120" cy="150" r="5" fill="white" stroke="rgb(25, 93, 230)" stroke-width="2" class="transition-opacity opacity-0 hover:opacity-100"/>
                <circle cx="180" cy="110" r="5" fill="white" stroke="rgb(25, 93, 230)" stroke-width="2" class="transition-opacity opacity-0 hover:opacity-100"/>
                <circle cx="240" cy="120" r="5" fill="white" stroke="rgb(25, 93, 230)" stroke-width="2" class="transition-opacity opacity-0 hover:opacity-100"/>
                <circle cx="300" cy="80" r="5" fill="white" stroke="rgb(25, 93, 230)" stroke-width="2" class="transition-opacity opacity-0 hover:opacity-100"/>
                <circle cx="360" cy="90" r="5" fill="white" stroke="rgb(25, 93, 230)" stroke-width="2" class="transition-opacity opacity-0 hover:opacity-100"/>
            </svg>

            {{-- Y-Axis Labels --}}
            <div class="absolute top-0 left-0 flex flex-col justify-between h-full py-2 text-xs font-medium text-slate-400">
                <span>15K</span>
                <span>10K</span>
                <span>5K</span>
                <span>0</span>
            </div>

            {{-- Y-Axis Label --}}
            <div class="absolute left-0 text-xs font-semibold transform -rotate-90 -translate-x-full -translate-y-1/2 top-1/2 text-slate-500 whitespace-nowrap">
                Volume (KL)
            </div>
        </div>

        {{-- X-Axis Labels --}}
        <div class="flex items-center justify-between px-2 mt-3 text-xs font-semibold text-slate-500">
            <span>Sen</span>
            <span>Sel</span>
            <span>Rab</span>
            <span>Kam</span>
            <span>Jum</span>
            <span>Sab</span>
            <span>Min</span>
        </div>
    </div>

    {{-- STATISTICS ROW --}}
    <div class="relative z-10 grid grid-cols-3 gap-4 mt-6">
        {{-- Stat 1 --}}
        <div class="p-4 border border-blue-100 rounded-xl bg-gradient-to-br from-blue-50 to-transparent dark:from-blue-900/10 dark:border-blue-900/30">
            <div class="flex items-center gap-2 mb-1">
                <span class="text-lg text-blue-600 material-symbols-outlined dark:text-blue-400">water_drop</span>
                <p class="text-xs font-medium text-slate-600 dark:text-slate-400">Total Minggu Ini</p>
            </div>
            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($weeklyVolume / 1000, 1, ',', '.') }}K</p>
            <p class="mt-1 text-xs font-medium text-blue-600 dark:text-blue-400">KL Didistribusikan</p>
        </div>

        {{-- Stat 2 --}}
        <div class="p-4 border rounded-xl bg-gradient-to-br from-emerald-50 to-transparent dark:from-emerald-900/10 border-emerald-100 dark:border-emerald-900/30">
            <div class="flex items-center gap-2 mb-1">
                <span class="text-lg material-symbols-outlined text-emerald-600 dark:text-emerald-400">speed</span>
                <p class="text-xs font-medium text-slate-600 dark:text-slate-400">Rata-rata Harian</p>
            </div>
            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($dailyAverage / 1000, 1, ',', '.') }}K</p>
            <p class="mt-1 text-xs font-medium text-emerald-600 dark:text-emerald-400">KL per Hari</p>
        </div>

        {{-- Stat 3 --}}
        <div class="p-4 border rounded-xl bg-gradient-to-br from-amber-50 to-transparent dark:from-amber-900/10 border-amber-100 dark:border-amber-900/30">
            <div class="flex items-center gap-2 mb-1">
                <span class="text-lg material-symbols-outlined text-amber-600 dark:text-amber-400">schedule</span>
                <p class="text-xs font-medium text-slate-600 dark:text-slate-400">Status</p>
            </div>
            <p class="text-2xl font-bold text-slate-900 dark:text-white">Active</p>
            <p class="mt-1 text-xs font-medium text-amber-600 dark:text-amber-400">Data Real-time</p>
        </div>
    </div>

    {{-- FOOTER INFO --}}
    <div class="relative z-10 flex flex-wrap items-center justify-between gap-3 p-4 mt-6 border rounded-xl bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-700">
        <div class="flex items-center gap-2">
            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-primary/20 to-primary/10">
                <span class="text-base material-symbols-outlined text-primary">info</span>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-900 dark:text-white">Data Real-time</p>
                <p class="text-xs text-slate-500 dark:text-slate-400">Sinkronisasi otomatis dari database</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold transition-all rounded-lg text-slate-600 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-700">
                <span class="text-base material-symbols-outlined">download</span>
                Export
            </button>
        </div>
    </div>

</div>

<style>
    /* Custom shadow for cards */
    .shadow-card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.08), 0 1px 2px 0 rgba(0, 0, 0, 0.04);
    }

    /* Smooth transitions for interactive elements */
    select:focus {
        outline: none;
    }

    /* Hover effect for data points */
    circle:hover {
        r: 7;
        transition: all 0.2s ease;
    }
</style>
