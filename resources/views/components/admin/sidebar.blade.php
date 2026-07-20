<aside
    class="w-72 glass-panel border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col fixed top-0 left-0 h-full z-20">
    <div class="flex flex-col h-full px-6 py-8">
        <!-- Brand -->
        <div class="flex items-center gap-4 mb-12 px-2">
            <div
                class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 shadow-glow-blue size-12 shrink-0 animate-float">
                <span class="material-symbols-outlined text-2xl">local_gas_station</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white">BBM<span
                        class="text-pertamina-red">Distribusi</span></h1>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5"
                    style="font-size: 10px;">Admin Depo Portal</p>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex flex-col flex-1 gap-2 overflow-y-auto no-scrollbar">
            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.dashboard') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('admin.dashboard') }}">
                @if(request()->routeIs('admin.dashboard'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.verifikasi*') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('admin.verifikasi') }}">
                @if(request()->routeIs('admin.verifikasi*'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">verified</span>
                <span class="text-sm">Verifikasi Surat Jalan</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.input-distribusi*') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('admin.input-distribusi') }}">
                @if(request()->routeIs('admin.input-distribusi*'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">add_circle</span>
                <span class="text-sm">Input Distribusi</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.qr-management*') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('admin.qr-management') }}">
                @if(request()->routeIs('admin.qr-management*'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">qr_code</span>
                <span class="text-sm">QR Code Management</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.distribution-data') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('admin.distribution-data') }}">
                @if(request()->routeIs('admin.distribution-data'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">local_shipping</span>
                <span class="text-sm">Data Pengiriman</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.reports') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('admin.reports') }}">
                @if(request()->routeIs('admin.reports'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">description</span>
                <span class="text-sm">Laporan Audit</span>
            </a>

            <!-- <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('admin.forecasting') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('admin.forecasting') }}">
                @if(request()->routeIs('admin.forecasting'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span
                    class="material-symbols-outlined group-hover:scale-110 transition-transform">online_prediction</span>
                <span class="text-sm">Prediksi Kebutuhan</span>
            </a> -->
        </nav>

        <!-- Profile & Logout -->
        <div class="mt-auto pt-8 flex-shrink-0">
            <div class="glass-panel rounded-2xl p-4 flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=005eb8&color=fff"
                            alt="User" class="rounded-full size-10 border-2 border-white shadow-sm" />
                        <div
                            class="absolute bottom-0 right-0 size-3 bg-pertamina-green rounded-full border-2 border-white">
                        </div>
                    </div>
                    <div class="flex flex-col overflow-hidden">
                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-slate-500 font-medium">Admin Depo Portal</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-pertamina-red hover:bg-pertamina-red hover:text-white font-semibold transition-all border border-pertamina-red/20 shadow-sm"
                        type="submit">
                        <span class="material-symbols-outlined text-sm">logout</span>
                        <span class="text-sm">Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>