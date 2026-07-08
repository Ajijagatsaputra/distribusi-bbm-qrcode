<aside
    class="w-72 glass-panel border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col fixed top-0 left-0 h-full z-20">
    <div class="flex flex-col h-full px-6 py-8">
        <!-- Brand -->
        <div class="flex items-center gap-4 mb-12 px-2">
            <div
                class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 shadow-glow-blue size-12 shrink-0 animate-float">
                <span class="material-symbols-outlined text-2xl">storefront</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white">BBM<span
                        class="text-pertamina-red">Distribusi</span></h1>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5"
                    style="font-size: 10px;">Admin SPBU Portal</p>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex flex-col flex-1 gap-2 overflow-y-auto no-scrollbar">
            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('spbu.dashboard') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('spbu.dashboard') }}">
                @if(request()->routeIs('spbu.dashboard'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('spbu.orders*') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('spbu.orders.index') }}">
                @if(request()->routeIs('spbu.orders*'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span class="material-symbols-outlined group-hover:scale-110 transition-transform">shopping_cart</span>
                <span class="text-sm">Pemesanan BBM</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all relative group {{ request()->routeIs('spbu.verify*') ? 'bg-pertamina-blue/10 text-pertamina-blue font-bold' : 'text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium' }}"
                href="{{ route('spbu.verify.scan') }}">
                @if(request()->routeIs('spbu.verify*'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                @endif
                <span
                    class="material-symbols-outlined group-hover:scale-110 transition-transform">qr_code_scanner</span>
                <span class="text-sm">Scan Barcode Driver</span>
            </a>
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
                        <p class="text-xs text-slate-500 font-medium truncate" style="font-size: 10px;">
                            {{ auth()->user()->spbu ? auth()->user()->spbu->name : 'SPBU Portal' }}
                        </p>
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