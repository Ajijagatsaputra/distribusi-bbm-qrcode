<!DOCTYPE html>
<html class="light" lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pertamina - Riwayat Distribusi</title>
    @pwaHead('logo.png', '#005eb8')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "pertamina-blue": "#005eb8",
                        "pertamina-red": "#ed161f",
                        "pertamina-green": "#7abb3a",
                        "background-light": "#f4f7fb",
                        "background-dark": "#0f172a",
                    },
                    fontFamily: { "sans": ["Outfit", "sans-serif"] },
                    boxShadow: { 'glass': '0 8px 32px 0 rgba(0, 94, 184, 0.05)' },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .gradient-text {
            background: linear-gradient(135deg, #005eb8, #0099ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="bg-background-light min-h-screen text-slate-800 overflow-x-hidden">
    <div
        class="fixed top-0 right-0 w-[50%] h-[50%] rounded-bl-full bg-pertamina-blue/5 blur-[100px] pointer-events-none -z-10">
    </div>
    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar Backdrop for Mobile -->
        <div id="sidebar-overlay" onclick="toggleSidebar()"
            class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm z-20 hidden lg:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-72 glass-panel border-r border-slate-200/50 flex flex-col fixed h-full z-30 transition-transform duration-300 -translate-x-full lg:translate-x-0">
            <div class="flex flex-col h-full px-6 py-8">
                <!-- Brand -->
                <div class="flex items-center gap-4 mb-12 px-2">
                    <div
                        class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 size-12 shrink-0">
                        <span class="material-symbols-outlined text-2xl">local_gas_station</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900">BBM<span
                                class="text-pertamina-red">Distribusi</span></h1>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5">Driver Portal
                        </p>
                    </div>
                </div>

                <!-- Nav -->
                <nav class="flex flex-col flex-1 gap-2">
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group"
                        href="{{ route('operator.dashboard') }}">
                        <span
                            class="material-symbols-outlined group-hover:scale-110 transition-transform">dashboard</span>
                        <span class="text-sm">Dashboard Overview</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group"
                        href="{{ route('operator.surat-jalan') }}">
                        <span
                            class="material-symbols-outlined group-hover:scale-110 transition-transform">description</span>
                        <span class="text-sm">Surat Jalan</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-pertamina-blue/10 text-pertamina-blue font-bold transition-all relative group"
                        href="{{ route('operator.history') }}">
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full">
                        </div>
                        <span class="material-symbols-outlined">history</span>
                        <span class="text-sm">Riwayat Pengiriman</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group"
                        href="{{ route('operator.profile') }}">
                        <span class="material-symbols-outlined group-hover:scale-110 transition-transform">person</span>
                        <span class="text-sm">Profile Settings</span>
                    </a>
                </nav>

                <!-- Profile -->
                <div class="mt-auto pt-8">
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
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-slate-500 font-medium">Driver BBM</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-pertamina-red hover:bg-pertamina-red hover:text-white font-semibold transition-all border border-pertamina-red/20 shadow-sm">
                                <span class="material-symbols-outlined text-sm">logout</span>
                                <span class="text-sm">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Header -->
        <header
            class="lg:hidden w-full h-16 glass-panel border-b border-slate-200/50 dark:border-slate-800/50 fixed top-0 left-0 flex items-center justify-between px-6 z-20">
            <div class="flex items-center gap-3">
                <div
                    class="flex items-center justify-center text-white rounded-lg bg-gradient-to-br from-pertamina-blue to-blue-700 size-10 shrink-0">
                    <span class="material-symbols-outlined text-xl">local_gas_station</span>
                </div>
                <span class="text-base font-bold text-slate-900">BBM<span
                        class="text-pertamina-red">Distribusi</span></span>
            </div>
            <button onclick="toggleSidebar()"
                class="p-2 text-slate-500 hover:text-pertamina-blue hover:bg-slate-100 rounded-xl transition-all">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </header>

        <!-- Main Content -->
        <main class="flex-1 w-full min-w-0 lg:ml-72 min-h-screen pt-20 lg:pt-0">
            <div class="max-w-[1200px] mx-auto p-4 sm:p-6 lg:p-10">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
                    <div>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-900 mb-2">
                            Riwayat <span class="gradient-text">Log Distribusi</span></h2>
                        <p class="text-slate-500 font-medium text-base sm:text-lg">Laporan detail seluruh aktivitas
                            pengiriman BBM
                            dari stasiun operator.</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-slate-500">Total Volume</p>
                        <p class="text-2xl font-black text-pertamina-blue">
                            {{ number_format($totalVolume, 0, ',', '.') }} L
                        </p>
                    </div>
                </div>

                @if(session('success'))
                    <div
                        class="mb-6 flex items-center gap-3 px-4 py-3 bg-pertamina-green/10 border border-pertamina-green/30 rounded-xl text-pertamina-green font-semibold text-sm">
                        <span class="material-symbols-outlined">check_circle</span>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Filters -->
                <form method="GET" action="{{ route('operator.history') }}"
                    class="glass-panel p-5 rounded-2xl shadow-glass mb-8 flex flex-col md:flex-row gap-4 items-stretch md:items-center">
                    <div class="relative w-full md:flex-1">
                        <span
                            class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400">search</span>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari No. Polisi atau kode distribusi..."
                            class="w-full h-11 pl-11 pr-4 rounded-xl bg-white border border-slate-200 outline-none focus:border-pertamina-blue text-sm" />
                    </div>
                    <select name="fuel_type"
                        class="w-full md:w-auto h-11 px-4 rounded-xl bg-white border border-slate-200 outline-none text-sm font-semibold text-slate-700">
                        <option value="">Semua BBM</option>
                        @foreach($fuelTypes as $ft)
                            <option value="{{ $ft->id }}" {{ request('fuel_type') == $ft->id ? 'selected' : '' }}>
                                {{ $ft->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="w-full md:w-auto h-11 px-5 bg-pertamina-blue text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">search</span> Cari
                    </button>
                    @if(request('search') || request('fuel_type'))
                        <a href="{{ route('operator.history') }}"
                            class="w-full md:w-auto h-11 px-5 bg-slate-100 text-slate-600 rounded-xl font-bold text-sm hover:bg-slate-200 transition-colors flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">close</span> Reset
                        </a>
                    @endif
                </form>

                <!-- Table -->
                <div class="glass-panel rounded-2xl sm:rounded-3xl shadow-glass overflow-hidden border border-white/50">
                    <!-- Desktop Table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/80">
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Kode
                                        Distribusi</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                        Tanggal &amp; Waktu</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">No.
                                        Polisi</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                        Produk BBM</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                        Volume (L)</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                        Tujuan SPBU</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/50 bg-white/40">
                                @forelse ($distributions as $dist)
                                    <tr class="hover:bg-white/80 transition-colors">
                                        <td class="px-6 py-4">
                                            <span
                                                class="font-mono text-xs font-bold text-pertamina-blue">{{ $dist->distribution_code }}</span>
                                        </td>
                                        <td class="px-6 py-5">
                                            <p class="text-sm font-bold text-slate-900">
                                                {{ $dist->distributed_at?->format('d M Y') }}</p>
                                            <p class="text-xs text-slate-500 mt-0.5">
                                                {{ $dist->distributed_at?->format('H:i') }} WIB</p>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div
                                                class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 border border-slate-200">
                                                <span
                                                    class="text-sm font-bold tracking-widest text-slate-800">{{ $dist->vehicle_plate }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 font-semibold text-slate-700">{{ $dist->fuelType->name }}</td>
                                        <td class="px-6 py-5 font-extrabold text-slate-900">
                                            {{ number_format($dist->volume_liter, 0, ',', '.') }}</td>
                                        <td class="px-6 py-5 font-medium text-slate-600 text-sm">{{ $dist->spbu->name }}
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($dist->status === 'selesai')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pertamina-green/10 text-pertamina-green text-xs font-bold border border-pertamina-green/20">
                                                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                                    Selesai
                                                </span>
                                            @elseif($dist->status === 'pending')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 text-amber-600 text-xs font-bold border border-amber-500/20">
                                                    <span class="material-symbols-outlined text-[14px]">sync</span> Pending
                                                </span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pertamina-red/10 text-pertamina-red text-xs font-bold border border-pertamina-red/20">
                                                    <span class="material-symbols-outlined text-[14px]">error</span> Gagal
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-16 text-center">
                                            <span
                                                class="material-symbols-outlined text-5xl text-slate-300 block mb-3">history</span>
                                            <p class="text-slate-400 font-semibold">Belum ada riwayat distribusi.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile List (hidden on desktop) -->
                    <div
                        class="block md:hidden divide-y divide-slate-100/70 dark:divide-slate-800/70 bg-white/10 dark:bg-slate-900/10">
                        @forelse ($distributions as $dist)
                            <div
                                class="p-4 flex flex-col gap-3 hover:bg-white/40 dark:hover:bg-slate-800/40 transition-colors">
                                <div class="flex items-center justify-between">
                                    <span
                                        class="font-mono font-bold text-xs text-pertamina-blue bg-pertamina-blue/5 px-2.5 py-0.5 rounded-lg border border-pertamina-blue/10">{{ $dist->distribution_code }}</span>
                                    @if($dist->status === 'selesai')
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-pertamina-green/10 text-pertamina-green text-[10px] font-bold border border-pertamina-green/20">
                                            <span class="material-symbols-outlined text-[12px] mr-0.5">check_circle</span>
                                            Selesai
                                        </span>
                                    @elseif($dist->status === 'pending')
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/10 text-amber-600 text-[10px] font-bold border border-amber-500/20">
                                            <span class="material-symbols-outlined text-[12px] mr-0.5">sync</span> Pending
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-pertamina-red/10 text-pertamina-red text-[10px] font-bold border border-pertamina-red/20">
                                            <span class="material-symbols-outlined text-[12px] mr-0.5">error</span> Gagal
                                        </span>
                                    @endif
                                </div>

                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase">No. Polisi & SPBU</p>
                                        <p class="font-bold text-slate-800 dark:text-slate-200 mt-0.5">
                                            {{ $dist->vehicle_plate }}</p>
                                        <p class="text-[10px] text-slate-500 truncate mt-0.5">{{ $dist->spbu->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-slate-400 font-bold uppercase">Muatan BBM</p>
                                        <p class="font-bold text-slate-800 dark:text-slate-200 mt-0.5">
                                            {{ $dist->fuelType->name }}</p>
                                        <p class="text-[10px] text-slate-500 font-extrabold mt-0.5">
                                            {{ number_format($dist->volume_liter, 0, ',', '.') }} L</p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center justify-between pt-2 border-t border-slate-100/50 dark:border-slate-800/50 text-[10px] text-slate-400">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">calendar_month</span>
                                        {{ $dist->distributed_at?->translatedFormat('d M Y, H:i') }} WIB
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-slate-400 font-medium text-xs">Belum ada riwayat distribusi.
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div
                        class="px-6 py-4 bg-slate-50/80 border-t border-slate-200/50 flex items-center justify-between">
                        <p class="text-sm text-slate-500 font-medium">
                            Menampilkan <span
                                class="font-bold text-slate-900">{{ $distributions->firstItem() ?? 0 }}-{{ $distributions->lastItem() ?? 0 }}</span>
                            dari <span class="font-bold text-slate-900">{{ $distributions->total() }}</span> data
                        </p>
                        <div class="text-sm">{{ $distributions->links() }}</div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
        }
    </script>

    <!-- Custom PWA Install Banner -->
    <div id="pwa-install-banner"
        class="hidden fixed bottom-6 left-6 right-6 lg:left-80 lg:right-10 bg-gradient-to-r from-pertamina-blue to-blue-700 text-white rounded-3xl p-6 shadow-2xl z-40 border border-white/20">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-white/10 rounded-2xl border border-white/20 shrink-0">
                    <span class="material-symbols-outlined text-3xl text-white">install_mobile</span>
                </div>
                <div>
                    <h4 class="text-lg font-bold">Pasang Aplikasi PWA</h4>
                    <p class="text-xs text-blue-100 font-medium">Instal aplikasi untuk akses cepat tanpa internet &
                        notifikasi langsung.</p>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto shrink-0">
                <button id="pwa-install-btn"
                    class="flex-1 sm:flex-none px-6 py-3 bg-white text-pertamina-blue font-bold text-sm rounded-xl hover:bg-blue-50 transition-all shadow-sm">
                    Pasang Sekarang
                </button>
                <button onclick="document.getElementById('pwa-install-banner').classList.add('hidden')"
                    class="p-3 bg-white/10 hover:bg-white/20 text-white rounded-xl transition-all">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
        </div>
    </div>

    @laravelPWA
    @pwaUpdateNotifier

    <script>
        window.addEventListener('pwa-installable', (e) => {
            const banner = document.getElementById('pwa-install-banner');
            if (banner) {
                banner.classList.remove('hidden');
            }
        });
    </script>
</body>

</html>