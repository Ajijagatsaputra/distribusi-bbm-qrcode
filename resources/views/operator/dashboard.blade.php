<!DOCTYPE html>
<html class="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pertamina - Operator Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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
                    fontFamily: {
                        "sans": ["Outfit", "sans-serif"]
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(0, 94, 184, 0.05)',
                        'glow-blue': '0 0 20px rgba(0, 94, 184, 0.3)',
                        'glow-red': '0 0 20px rgba(237, 22, 31, 0.3)',
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 4s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .dark .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .gradient-text {
            background: linear-gradient(135deg, #005eb8, #0099ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hover-lift { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .hover-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 24px -8px rgba(0, 94, 184, 0.2); }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark min-h-screen text-slate-800 dark:text-slate-100 overflow-x-hidden">
    <!-- Ambient Backgrounds -->
    <div class="fixed top-0 left-0 w-full h-80 bg-gradient-to-b from-pertamina-blue/10 to-transparent pointer-events-none -z-10"></div>
    <div class="fixed top-[-10%] right-[-5%] w-[40%] h-[40%] rounded-full bg-pertamina-blue/10 blur-[120px] pointer-events-none -z-10"></div>
    
    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar Backdrop for Mobile -->
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm z-20 hidden lg:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="w-72 glass-panel border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col fixed h-full z-30 transition-transform duration-300 -translate-x-full lg:translate-x-0">
            <div class="flex flex-col h-full px-6 py-8">
                <!-- Brand -->
                <div class="flex items-center gap-4 mb-12 px-2">
                    <div class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 shadow-glow-blue size-12 shrink-0 animate-float">
                        <span class="material-symbols-outlined text-2xl">local_gas_station</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white">BBM<span class="text-pertamina-red">Distribusi</span></h1>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5">Driver Portal</p>
                    </div>
                </div>

                <!-- Nav -->
                <nav class="flex flex-col flex-1 gap-2">
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-pertamina-blue/10 text-pertamina-blue font-bold transition-all relative group" href="{{ route('operator.dashboard') }}">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="text-sm">Dashboard Overview</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group" href="{{ route('operator.surat-jalan') }}">
                        <span class="material-symbols-outlined group-hover:scale-110 transition-transform">description</span>
                        <span class="text-sm">Surat Jalan</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group" href="{{ route('operator.history') }}">
                        <span class="material-symbols-outlined group-hover:scale-110 transition-transform">history</span>
                        <span class="text-sm">Riwayat Pengiriman</span>
                    </a>
                </nav>

                <!-- Profile -->
                <div class="mt-auto pt-8">
                    <div class="glass-panel rounded-2xl p-4 flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=005eb8&color=fff" alt="User" class="rounded-full size-10 border-2 border-white shadow-sm" />
                                <div class="absolute bottom-0 right-0 size-3 bg-pertamina-green rounded-full border-2 border-white"></div>
                            </div>
                            <div class="flex flex-col overflow-hidden">
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-slate-500 font-medium">Driver BBM</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-pertamina-red hover:bg-pertamina-red hover:text-white font-semibold transition-all border border-pertamina-red/20 shadow-sm">
                                <span class="material-symbols-outlined text-sm">logout</span>
                                <span class="text-sm">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Header -->
        <header class="lg:hidden w-full h-16 glass-panel border-b border-slate-200/50 dark:border-slate-800/50 fixed top-0 left-0 flex items-center justify-between px-6 z-20">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center text-white rounded-lg bg-gradient-to-br from-pertamina-blue to-blue-700 size-10 shrink-0">
                    <span class="material-symbols-outlined text-xl">local_gas_station</span>
                </div>
                <span class="text-base font-bold text-slate-900 dark:text-white">BBM<span class="text-pertamina-red">Distribusi</span></span>
            </div>
            <button onclick="toggleSidebar()" class="p-2 text-slate-500 hover:text-pertamina-blue hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-all">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </header>

        <!-- Main Content -->
        <main class="flex-1 w-full min-w-0 lg:ml-72 min-h-screen pt-20 lg:pt-0">
            <div class="max-w-[1200px] mx-auto p-4 sm:p-6 lg:p-10">
                <!-- Top Header -->
                <header class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-8 lg:mb-12">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                            Monitor <span class="gradient-text">Distribusi Driver.</span>
                        </h2>
                        <p class="text-slate-500 text-base font-medium">Ringkasan cepat operasi distribusi BBM Anda hari ini.</p>
                    </div>
                    <div class="glass-panel px-5 py-3 rounded-2xl shadow-glass flex items-center gap-4">
                        <div class="p-2 bg-slate-100 dark:bg-slate-800 rounded-xl">
                            <span class="material-symbols-outlined text-pertamina-blue">calendar_month</span>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Hari Ini</p>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">{{ now()->translatedFormat('l, d M Y') }}</p>
                        </div>
                    </div>
                </header>

                <!-- Status Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <!-- Card 1 -->
                    <div class="glass-panel rounded-3xl p-6 hover-lift relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 size-24 bg-pertamina-blue/5 rounded-full blur-xl group-hover:bg-pertamina-blue/10 transition-colors"></div>
                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div>
                                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">Total Pengiriman</p>
                                <p class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ $totalShipments }}</p>
                            </div>
                            <div class="size-12 rounded-2xl bg-pertamina-blue/10 flex items-center justify-center text-pertamina-blue">
                                <span class="material-symbols-outlined">receipt_long</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 relative z-10">
                            <span class="text-xs text-slate-500 font-medium">Total seluruh bongkar BBM selesai</span>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="glass-panel rounded-3xl p-6 hover-lift relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 size-24 bg-pertamina-red/5 rounded-full blur-xl group-hover:bg-pertamina-red/10 transition-colors"></div>
                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div>
                                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">Total Volume Bongkar</p>
                                <div class="flex items-baseline gap-1">
                                    <p class="text-4xl font-extrabold text-slate-900 dark:text-white">{{ number_format($totalVolume, 0, ',', '.') }}</p>
                                    <span class="text-slate-500 font-semibold">Liter</span>
                                </div>
                            </div>
                            <div class="size-12 rounded-2xl bg-pertamina-red/10 flex items-center justify-center text-pertamina-red">
                                <span class="material-symbols-outlined">water_drop</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 relative z-10">
                            <span class="text-xs text-slate-500 font-medium">Akumulasi volume BBM terkirim</span>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="glass-panel rounded-3xl p-6 hover-lift relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 size-24 bg-pertamina-green/5 rounded-full blur-xl group-hover:bg-pertamina-green/10 transition-colors"></div>
                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div>
                                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">Tugas Aktif</p>
                                @if($activeSuratJalan)
                                    <p class="text-xl font-extrabold text-pertamina-blue truncate">{{ $activeSuratJalan->kode_surat_jalan }}</p>
                                @else
                                    <p class="text-xl font-extrabold text-slate-400">Tidak Ada Tugas</p>
                                @endif
                            </div>
                            <div class="size-12 rounded-2xl bg-pertamina-green/10 flex items-center justify-center text-pertamina-green">
                                <span class="material-symbols-outlined">description</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 relative z-10">
                            @if($activeSuratJalan)
                                <span class="relative flex size-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full size-3 bg-amber-500"></span>
                                </span>
                                <span class="text-xs text-slate-500 font-medium">Status: {{ ucfirst($activeSuratJalan->status) }}</span>
                            @else
                                <span class="text-xs text-slate-500 font-medium">Semua tugas terselesaikan</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Call to Action Banner -->
                <div class="mb-12">
                    <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-slate-900 to-slate-800 shadow-xl p-1">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                        <!-- Glow effect -->
                        <div class="absolute -right-20 -bottom-20 size-64 bg-pertamina-red rounded-full blur-[80px] opacity-40 mix-blend-screen pointer-events-none"></div>
                        <div class="absolute -left-20 -top-20 size-64 bg-pertamina-blue rounded-full blur-[80px] opacity-40 mix-blend-screen pointer-events-none"></div>
                        
                        <div class="relative bg-slate-900/40 backdrop-blur-xl rounded-[1.8rem] p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-8 border border-white/10">
                            <div class="flex flex-col gap-4 max-w-xl">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-white text-xs font-bold uppercase tracking-widest w-fit border border-white/20">
                                    <span class="size-2 rounded-full bg-pertamina-blue animate-pulse"></span>
                                    Menu Utama
                                </span>
                                <h3 class="text-3xl font-bold text-white leading-tight">Kelola Surat Jalan & <span class="text-pertamina-blue">Scan QR Bongkar</span></h3>
                                <p class="text-slate-400 text-base leading-relaxed">
                                    Lihat rincian rute pengiriman, volume tangki, dan gunakan kamera handphone Anda untuk scan QR Code di SPBU sebagai tanda bukti pembongkaran BBM selesai.
                                </p>
                            </div>
                            <a href="{{ route('operator.surat-jalan') }}" class="group relative flex items-center justify-center gap-3 px-8 py-5 rounded-2xl bg-pertamina-blue text-white font-bold text-lg overflow-hidden shrink-0 hover:scale-105 transition-all shadow-glow-blue hover:shadow-none">
                                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                                <span class="material-symbols-outlined relative z-10 text-3xl group-hover:rotate-12 transition-transform">qr_code_scanner</span>
                                <span class="relative z-10">Buka Surat Jalan</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Logs Table -->
                <div class="glass-panel rounded-3xl overflow-hidden shadow-glass border border-white/40">
                    <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50 flex flex-wrap items-center justify-between gap-4 bg-white/40 dark:bg-slate-800/40">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white rounded-lg shadow-sm">
                                <span class="material-symbols-outlined text-pertamina-blue">history</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Riwayat Distribusi Terakhir</h3>
                        </div>
                        <a href="{{ route('operator.history') }}" class="text-sm font-bold text-pertamina-blue hover:text-blue-700 flex items-center gap-1 hover:gap-2 transition-all">
                            Lihat Semua <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 dark:bg-slate-800/30">
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Waktu</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">No. Polisi</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Produk BBM</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Volume (L)</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/50 dark:divide-slate-700/50">
                                @forelse($recentDistributions as $dist)
                                    @php
                                        $dotColor = 'bg-slate-500';
                                        if ($dist->fuelType->code === 'PLT') $dotColor = 'bg-emerald-500';
                                        elseif ($dist->fuelType->code === 'PMX') $dotColor = 'bg-blue-500';
                                        elseif ($dist->fuelType->code === 'SLR') $dotColor = 'bg-slate-700';
                                    @endphp
                                    <tr class="hover:bg-white/60 dark:hover:bg-slate-800/60 transition-colors group">
                                        <td class="px-6 py-4">
                                            <p class="text-sm font-bold text-slate-900 dark:text-white">{{ $dist->distributed_at->format('H:i') }}</p>
                                            <p class="text-xs text-slate-500">{{ $dist->distributed_at->format('d M Y') }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600">
                                                <span class="material-symbols-outlined text-[16px] text-slate-500">local_shipping</span>
                                                <span class="text-sm font-bold tracking-widest text-slate-800 dark:text-white">{{ $dist->vehicle_plate }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="size-2 rounded-full {{ $dotColor }}"></div>
                                                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $dist->fuelType->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm font-extrabold text-slate-900 dark:text-white">{{ number_format($dist->volume_liter, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-pertamina-green/10 text-pertamina-green text-xs font-bold border border-pertamina-green/20">
                                                <span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-10 text-slate-400 font-medium">Belum ada riwayat distribusi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
</body>
</html>