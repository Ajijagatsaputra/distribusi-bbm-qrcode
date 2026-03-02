<div class="flex flex-wrap items-start justify-between gap-6 mb-8">

    {{-- LEFT --}}
    <div class="flex flex-col gap-2">
        <h3 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
            Monitoring <span class="gradient-text">Distribusi BBM</span>
        </h3>

        <p class="text-base font-medium text-slate-500 dark:text-slate-400">
            Pemantauan real-time aktivitas distribusi BBM berbasis QR Code
        </p>

        {{-- MINI STATUS --}}
        <div class="flex items-center gap-3 mt-2 text-xs">
            <span class="flex items-center gap-1.5 px-3 py-1 font-bold text-pertamina-green bg-pertamina-green/10 rounded-full border border-pertamina-green/20">
                <span class="text-[14px] material-symbols-outlined">sync</span>
                Live Data
            </span>

            <span class="text-slate-500 font-medium">
                Update terakhir: <strong class="text-slate-700 dark:text-slate-300">Baru saja</strong>
            </span>
        </div>
    </div>

    {{-- RIGHT ACTION --}}
    <div class="glass-panel px-4 py-3 rounded-2xl shadow-glass flex items-center gap-3">

        {{-- EXPORT SUMMARY --}}
        <button class="flex items-center gap-2 px-4 py-2.5 text-sm font-bold transition-all rounded-xl text-slate-600 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 hover:text-pertamina-blue hover:border-pertamina-blue/50 shadow-sm">
            <span class="text-lg material-symbols-outlined">download</span>
            Ekspor Laporan
        </button>

        {{-- QUICK ACTION --}}
        <a href="{{ route('admin.distribution-data') }}" class="flex items-center gap-2 px-5 py-2.5 text-sm font-bold text-white transition-all rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:to-blue-500 shadow-glow-blue hover:scale-105">
            <span class="text-lg material-symbols-outlined">add_circle</span>
            Kelola Scan QR
        </a>
    </div>

</div>
