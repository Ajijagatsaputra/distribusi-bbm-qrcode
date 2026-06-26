@props([
    'totalVolume' => 0,
    'totalSpbu' => 0,
    'activeDistributions' => 0,
    'pendingSuratJalan' => 0
])

<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 mb-10">

    {{-- TOTAL DISTRIBUSI --}}
    <div class="glass-panel p-6 rounded-3xl hover-lift relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 size-24 bg-pertamina-blue/5 rounded-full blur-xl group-hover:bg-pertamina-blue/10 transition-colors"></div>
        <div class="flex items-start justify-between mb-6 relative z-10">
            <div>
                <span class="text-xs font-bold tracking-wider uppercase text-slate-500">Total Distribusi</span>
                <h4 class="mt-1 text-4xl font-extrabold text-slate-900 dark:text-white">
                    {{ number_format($totalVolume / 1000, 1, ',', '.') }} <span class="text-sm font-semibold text-slate-500">KL</span>
                </h4>
            </div>
            <div class="size-12 rounded-2xl bg-pertamina-blue/10 flex items-center justify-center text-pertamina-blue">
                <span class="material-symbols-outlined">local_gas_station</span>
            </div>
        </div>
        <div class="flex items-center gap-2 relative z-10">
            <span class="flex items-center gap-1 text-xs font-bold text-pertamina-green bg-pertamina-green/10 px-2 py-1 rounded-md">
                <span class="material-symbols-outlined text-[14px]">trending_up</span> +5%
            </span>
            <span class="text-xs font-medium text-slate-500">vs bulan lalu</span>
        </div>
    </div>

    {{-- SPBU AKTIF --}}
    <div class="glass-panel p-6 rounded-3xl hover-lift relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 size-24 bg-pertamina-green/5 rounded-full blur-xl group-hover:bg-pertamina-green/10 transition-colors"></div>
        <div class="flex items-start justify-between mb-6 relative z-10">
            <div>
                <span class="text-xs font-bold tracking-wider uppercase text-slate-500">SPBU Aktif</span>
                <h4 class="mt-1 text-4xl font-extrabold text-slate-900 dark:text-white">{{ $totalSpbu }}</h4>
            </div>
            <div class="size-12 rounded-2xl bg-pertamina-green/10 flex items-center justify-center text-pertamina-green">
                <span class="material-symbols-outlined">store</span>
            </div>
        </div>
        <div class="flex items-center gap-2 relative z-10">
            <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                <div class="bg-pertamina-green h-1.5 rounded-full" style="width: 100%"></div>
            </div>
            <span class="text-xs font-bold text-slate-500 whitespace-nowrap">100% Aktif</span>
        </div>
    </div>

    {{-- DISTRIBUSI AKTIF --}}
    <div class="glass-panel p-6 rounded-3xl hover-lift relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 size-24 bg-orange-500/5 rounded-full blur-xl group-hover:bg-orange-500/10 transition-colors"></div>
        <div class="flex items-start justify-between mb-6 relative z-10">
            <div>
                <span class="text-xs font-bold tracking-wider uppercase text-slate-500">Dalam Perjalanan</span>
                <h4 class="mt-1 text-4xl font-extrabold text-slate-900 dark:text-white">{{ $activeDistributions }}</h4>
            </div>
            <div class="size-12 rounded-2xl bg-orange-500/10 flex items-center justify-center text-orange-500">
                <span class="material-symbols-outlined">local_shipping</span>
            </div>
        </div>
        <div class="flex items-center gap-2 relative z-10">
            <span class="flex items-center gap-1 text-xs font-bold text-orange-600 bg-orange-500/10 px-2 py-1 rounded-md">
                Armada live jalan
            </span>
        </div>
    </div>

    {{-- LAPORAN PENDING --}}
    <div class="glass-panel p-6 rounded-3xl hover-lift relative overflow-hidden group">
        <div class="absolute -right-6 -top-6 size-24 bg-pertamina-red/5 rounded-full blur-xl group-hover:bg-pertamina-red/10 transition-colors"></div>
        <div class="flex items-start justify-between mb-6 relative z-10">
            <div>
                <span class="text-xs font-bold tracking-wider uppercase text-slate-500">Menunggu Verifikasi</span>
                <h4 class="mt-1 text-4xl font-extrabold text-slate-900 dark:text-white">{{ $pendingSuratJalan }}</h4>
            </div>
            <div class="size-12 rounded-2xl bg-pertamina-red/10 flex items-center justify-center text-pertamina-red">
                <span class="material-symbols-outlined">warning</span>
            </div>
        </div>
        <div class="flex items-center gap-2 relative z-10">
            <span class="flex items-center gap-1 text-xs font-bold text-pertamina-red bg-pertamina-red/10 px-2 py-1 rounded-md border border-pertamina-red/20">
                Butuh tindakan verifikasi depo
            </span>
        </div>
    </div>

</div>
