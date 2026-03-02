<div class="flex flex-col p-6 bg-white border dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-2xl shadow-card">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h4 class="text-lg font-bold text-slate-900 dark:text-white">Aktivitas Terbaru</h4>
            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Pembaruan terkini sistem</p>
        </div>
        <a href="#" class="flex items-center gap-1 text-sm font-semibold transition-colors text-primary hover:text-primary-dark">
            Lihat Semua
            <span class="text-sm material-symbols-outlined">arrow_forward</span>
        </a>
    </div>

    <!-- Activity List -->
    <div class="flex-1 space-y-3">

        <!-- Activity Item 1 - Success -->
        <div class="group flex gap-4 p-3.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all cursor-pointer border border-transparent hover:border-slate-200 dark:hover:border-slate-700">
            <div class="flex items-center justify-center shadow-sm rounded-xl size-11 shrink-0 bg-gradient-to-br from-blue-500 to-blue-600">
                <span class="text-xl text-white material-symbols-outlined">local_shipping</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold transition-colors text-slate-900 dark:text-white group-hover:text-primary">
                    Distribusi BBM ke SPBU A
                </p>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 rounded-md">
                        <span class="text-xs material-symbols-outlined">oil_barrel</span>
                        1.000 KL
                    </span>
                    <span class="text-xs text-slate-400">•</span>
                    <span class="text-xs text-slate-500 dark:text-slate-400">2 jam lalu</span>
                </div>
            </div>
            <div class="flex items-center transition-opacity opacity-0 group-hover:opacity-100">
                <span class="text-xl material-symbols-outlined text-slate-400">chevron_right</span>
            </div>
        </div>

        <!-- Activity Item 2 - Report -->
        <div class="group flex gap-4 p-3.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all cursor-pointer border border-transparent hover:border-slate-200 dark:hover:border-slate-700">
            <div class="flex items-center justify-center shadow-sm rounded-xl size-11 shrink-0 bg-gradient-to-br from-emerald-500 to-emerald-600">
                <span class="text-xl text-white material-symbols-outlined">description</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold transition-colors text-slate-900 dark:text-white group-hover:text-primary">
                    Laporan distribusi dibuat
                </p>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-md">
                        <span class="text-xs material-symbols-outlined">location_on</span>
                        Terminal Jakarta
                    </span>
                    <span class="text-xs text-slate-400">•</span>
                    <span class="text-xs text-slate-500 dark:text-slate-400">5 jam lalu</span>
                </div>
            </div>
            <div class="flex items-center transition-opacity opacity-0 group-hover:opacity-100">
                <span class="text-xl material-symbols-outlined text-slate-400">chevron_right</span>
            </div>
        </div>

        <!-- Activity Item 3 - QR Code -->
        <div class="group flex gap-4 p-3.5 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-all cursor-pointer border border-transparent hover:border-slate-200 dark:hover:border-slate-700">
            <div class="flex items-center justify-center shadow-sm rounded-xl size-11 shrink-0 bg-gradient-to-br from-amber-500 to-amber-600">
                <span class="text-xl text-white material-symbols-outlined">qr_code</span>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold transition-colors text-slate-900 dark:text-white group-hover:text-primary">
                    QR Code digenerate
                </p>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 rounded-md font-mono">
                        #882193
                    </span>
                    <span class="text-xs text-slate-400">•</span>
                    <span class="text-xs text-slate-500 dark:text-slate-400">1 hari lalu</span>
                </div>
            </div>
            <div class="flex items-center transition-opacity opacity-0 group-hover:opacity-100">
                <span class="text-xl material-symbols-outlined text-slate-400">chevron_right</span>
            </div>
        </div>

        <!-- Activity Item 4 - Incident/Warning -->
        <div class="group flex gap-4 p-3.5 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-900/10 transition-all cursor-pointer border border-rose-100 dark:border-rose-900/30 hover:border-rose-200 dark:hover:border-rose-800/50">
            <div class="flex items-center justify-center shadow-sm rounded-xl size-11 shrink-0 bg-gradient-to-br from-rose-500 to-rose-600">
                <span class="text-xl text-white material-symbols-outlined">warning</span>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2">
                    <p class="text-sm font-semibold transition-colors text-rose-600 dark:text-rose-400 group-hover:text-rose-700 dark:group-hover:text-rose-300">
                        Incident Report Pending
                    </p>
                    <span class="flex items-center gap-1 px-1.5 py-0.5 text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-400 rounded">
                        <span class="w-1 h-1 rounded-full bg-rose-600 dark:bg-rose-400 animate-pulse"></span>
                        Urgent
                    </span>
                </div>
                <div class="flex items-center gap-2 mt-1.5">
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium bg-rose-50 text-rose-700 dark:bg-rose-900/30 dark:text-rose-400 rounded-md font-mono">
                        <span class="text-xs material-symbols-outlined">local_shipping</span>
                        B-9122-TX
                    </span>
                    <span class="text-xs text-slate-400">•</span>
                    <span class="text-xs text-slate-500 dark:text-slate-400">1 hari lalu</span>
                </div>
            </div>
            <div class="flex items-center transition-opacity opacity-0 group-hover:opacity-100">
                <span class="text-xl material-symbols-outlined text-rose-600">chevron_right</span>
            </div>
        </div>

    </div>

    <!-- Footer Action -->
    <div class="pt-6 mt-6 border-t border-slate-100 dark:border-slate-800">
        <button class="flex items-center justify-center w-full gap-2 px-4 py-3 text-sm font-bold transition-all text-primary bg-primary/5 hover:bg-primary/10 rounded-xl group">
            <span>Lihat Semua Aktivitas</span>
            <span class="text-lg transition-transform material-symbols-outlined group-hover:translate-x-1">arrow_forward</span>
        </button>
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
