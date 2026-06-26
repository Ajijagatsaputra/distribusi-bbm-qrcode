@props([
    'recentActivities' => collect()
])

<div class="flex flex-col p-6 bg-white border dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-2xl shadow-card">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h4 class="text-lg font-bold text-slate-900 dark:text-white">Aktivitas Terbaru</h4>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Pembaruan terkini sistem</p>
        </div>
        <a href="{{ route('admin.distribution-data') }}" class="flex items-center gap-1 text-sm font-semibold transition-colors text-primary hover:text-primary-dark">
            Lihat Semua
            <span class="text-sm material-symbols-outlined">arrow_forward</span>
        </a>
    </div>

    <!-- Activity List -->
    <div class="flex-1 space-y-3">
        @forelse($recentActivities as $activity)
            @php
                $fuelName = strtolower($activity->fuelType->name ?? '');
                if (str_contains($fuelName, 'solar') || str_contains($fuelName, 'dex')) {
                    $gradient = 'from-emerald-500 to-emerald-600';
                    $icon = 'oil_barrel';
                } elseif (str_contains($fuelName, 'pertamax')) {
                    $gradient = 'from-blue-500 to-blue-600';
                    $icon = 'local_shipping';
                } else {
                    $gradient = 'from-amber-500 to-amber-600';
                    $icon = 'local_gas_station';
                }
            @endphp
            <div class="group flex gap-4 p-3.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all cursor-pointer border border-transparent hover:border-slate-200 dark:hover:border-slate-700">
                <div class="flex items-center justify-center shadow-sm rounded-xl size-11 shrink-0 bg-gradient-to-br {{ $gradient }}">
                    <span class="text-xl text-white material-symbols-outlined">{{ $icon }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold transition-colors text-slate-900 dark:text-white group-hover:text-primary">
                        Distribusi ke {{ $activity->spbu->name ?? 'SPBU' }}
                    </p>
                    <div class="flex items-center gap-2 mt-1.5">
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 rounded-md">
                            <span class="text-xs material-symbols-outlined">oil_barrel</span>
                            {{ number_format($activity->volume_liter, 0, ',', '.') }} L
                        </span>
                        <span class="text-xs text-slate-400">•</span>
                        <span class="text-xs text-slate-500 dark:text-slate-400">
                            {{ $activity->distributed_at ? $activity->distributed_at->diffForHumans() : '-' }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-xs text-slate-400 font-medium py-10 text-center">Belum ada aktivitas distribusi terbaru.</div>
        @endforelse
    </div>

    <!-- Footer Action -->
    <div class="pt-6 mt-6 border-t border-slate-100 dark:border-slate-800">
        <a href="{{ route('admin.distribution-data') }}" class="flex items-center justify-center w-full gap-2 px-4 py-3 text-sm font-bold transition-all text-primary bg-primary/5 hover:bg-primary/10 rounded-xl group">
            <span>Lihat Semua Aktivitas</span>
            <span class="text-lg transition-transform material-symbols-outlined group-hover:translate-x-1">arrow_forward</span>
        </a>
    </div>

</div>

<style>
    /* Custom shadow for cards */
    .shadow-card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.08), 0 1px 2px 0 rgba(0, 0, 0, 0.04);
    }

    /* Smooth hover transitions */
    .group:hover .material-symbols-outlined {
        transition: all 0.2s ease;
    }
</style>
