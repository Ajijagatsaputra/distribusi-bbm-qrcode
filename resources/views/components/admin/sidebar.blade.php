<aside class="w-72 glass-panel border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col fixed h-full z-20">
    <div class="flex flex-col h-full px-6 py-8">
        <!-- Brand -->
        <div class="flex items-center gap-4 mb-12 px-2">
            <div class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 shadow-glow-blue size-12 shrink-0 animate-float">
                <span class="material-symbols-outlined text-2xl">local_gas_station</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white">BBM<span class="text-pertamina-red">Distribusi</span></h1>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5">Admin Portal</p>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex flex-col flex-1 gap-2">
            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.dashboard') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="{{ route('admin.dashboard') }}">
                @if(request()->routeIs('admin.dashboard'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>
            
            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.distribution-data') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="{{ route('admin.distribution-data') }}">
                @if(request()->routeIs('admin.distribution-data'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">local_shipping</span>
                <span class="text-sm">Distribution Data</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.reports') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="{{ route('admin.reports') }}">
                @if(request()->routeIs('admin.reports'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">description</span>
                <span class="text-sm">Reports</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.profile') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}" href="{{ route('admin.profile') }}">
                @if(request()->routeIs('admin.profile'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">person</span>
                <span class="text-sm">Profile</span>
            </a>
        </nav>

        <!-- Profile & Logout -->
        <div class="mt-auto pt-8">
            <div class="glass-panel rounded-2xl p-4 flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=005eb8&color=fff" alt="User" class="rounded-full size-10 border-2 border-white shadow-sm" />
                        <div class="absolute bottom-0 right-0 size-3 bg-pertamina-green rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex flex-col overflow-hidden">
                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">Administrator</p>
                        <p class="text-xs text-slate-500 font-medium">Head Office</p>
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
