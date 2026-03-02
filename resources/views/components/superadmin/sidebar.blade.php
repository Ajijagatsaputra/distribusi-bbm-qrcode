<aside class="w-72 glass-panel border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col fixed h-full z-20">
    <div class="flex flex-col h-full px-6 py-8">
        <!-- Brand -->
        <div class="flex items-center gap-4 mb-12 px-2">
            <div class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 shadow-glow-blue size-12 shrink-0 animate-float">
                <span class="material-symbols-outlined text-2xl">local_gas_station</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white">BBM<span class="text-pertamina-red">Distribusi</span></h1>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5" style="font-size: 10px;">Super Admin Portal</p>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex flex-col flex-1 gap-2 overflow-y-auto no-scrollbar">
            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->is('superadmin/dashboard') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="/superadmin/dashboard">
                @if(request()->is('superadmin/dashboard'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform text-[20px]">dashboard</span>
                <span class="text-sm">Dashboard Overview</span>
            </a>
            
            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->is('superadmin/qr-code-management') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="/superadmin/qr-code-management">
                @if(request()->is('superadmin/qr-code-management'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform text-[20px]">qr_code_2</span>
                <span class="text-sm">QR Code Management</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->is('superadmin/users-management') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="/superadmin/users-management">
                @if(request()->is('superadmin/users-management'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform text-[20px]">group</span>
                <span class="text-sm">User Management</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->is('superadmin/master-data') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="{{ url('/superadmin/master-data') }}">
                @if(request()->is('superadmin/master-data'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform text-[20px]">database</span>
                <span class="text-sm">Master Data</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->is('superadmin/live-monitoring') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="{{ route('superadmin.live-monitoring') }}">
                @if(request()->is('superadmin/live-monitoring'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform relative text-[20px]">
                    monitoring
                    <span class="absolute flex w-2 h-2 -top-1 -right-1">
                        <span class="absolute inline-flex w-full h-full bg-pertamina-green rounded-full opacity-75 animate-ping"></span>
                        <span class="relative inline-flex w-2 h-2 bg-pertamina-green rounded-full"></span>
                    </span>
                </span>
                <span class="text-sm">Live Monitoring</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->is('superadmin/audit-reports') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="/superadmin/audit-reports">
                @if(request()->is('superadmin/audit-reports'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform text-[20px]">description</span>
                <span class="text-sm">Audit Reports</span>
            </a>
        </nav>

        <!-- Profile & Logout -->
        <div class="mt-auto pt-8 flex-shrink-0">
            <div class="glass-panel rounded-2xl p-4 flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Super+Admin&background=005eb8&color=fff" alt="User" class="rounded-full size-10 border-2 border-white shadow-sm" />
                        <div class="absolute bottom-0 right-0 size-3 bg-pertamina-green rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex flex-col overflow-hidden">
                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">Super Admin</p>
                        <p class="text-xs text-slate-500 font-medium">Headquarters</p>
                    </div>
                </div>
                <button class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-pertamina-red hover:bg-pertamina-red hover:text-white font-semibold transition-all border border-pertamina-red/20 shadow-sm" onclick="event.preventDefault(); document.location.href = '{{ url('/') }}'" type="button">
                    <span class="material-symbols-outlined text-sm">logout</span>
                    <span class="text-sm">Sign Out</span>
                </button>
            </div>
        </div>
    </div>
</aside>
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>
