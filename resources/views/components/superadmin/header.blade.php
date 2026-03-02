<header class="sticky top-0 z-40 flex items-center justify-between h-20 px-8 glass-panel border-b border-slate-200/50 dark:border-slate-800/50 backdrop-blur-md">
    <nav class="flex items-center gap-2 text-sm">
        <span class="text-slate-500 material-symbols-outlined text-[18px]">home</span>
        <span class="text-slate-400">/</span>
        <span class="font-bold text-slate-900 dark:text-white">QR Monitoring Dashboard</span>
    </nav>

    <div class="flex items-center gap-6">
        <!-- Date/Time Display -->
        <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-white/50 dark:bg-slate-800/50 rounded-xl border border-slate-200/50 text-sm font-medium text-slate-600">
            <span class="material-symbols-outlined text-[18px] text-pertamina-blue">calendar_today</span>
            {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </div>
        
        <!-- Notifications -->
        <button class="relative p-2 text-slate-500 hover:text-pertamina-blue transition-colors rounded-full hover:bg-pertamina-blue/10">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-1 right-1 size-2.5 bg-pertamina-red rounded-full border border-white"></span>
        </button>
    </div>
</header>
