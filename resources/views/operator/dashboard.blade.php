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
    
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-72 glass-panel border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col fixed h-full z-20">
            <div class="flex flex-col h-full px-6 py-8">
                <!-- Brand -->
                <div class="flex items-center gap-4 mb-12 px-2">
                    <div class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 shadow-glow-blue size-12 shrink-0 animate-float">
                        <span class="material-symbols-outlined text-2xl">local_gas_station</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white">BBM<span class="text-pertamina-red">Distribusi</span></h1>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5">Operator Portal</p>
                    </div>
                </div>

                <!-- Nav -->
                <nav class="flex flex-col flex-1 gap-2">
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-pertamina-blue/10 text-pertamina-blue font-bold transition-all relative group" href="{{ route('operator.dashboard') ?? '#' }}">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="text-sm">Dashboard Overview</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group" href="{{ route('operator.input-distribution') ?? '#' }}">
                        <span class="material-symbols-outlined group-hover:scale-110 transition-transform">qr_code_scanner</span>
                        <span class="text-sm">Scan & Input Data</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group" href="{{ route('operator.history') ?? '#' }}">
                        <span class="material-symbols-outlined group-hover:scale-110 transition-transform">history</span>
                        <span class="text-sm">Distribution Log</span>
                    </a>
                </nav>

                <!-- Profile -->
                <div class="mt-auto pt-8">
                    <div class="glass-panel rounded-2xl p-4 flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=005eb8&color=fff" alt="User" class="rounded-full size-10 border-2 border-white shadow-sm" />
                                <div class="absolute bottom-0 right-0 size-3 bg-pertamina-green rounded-full border-2 border-white"></div>
                            </div>
                            <div class="flex flex-col overflow-hidden">
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">Ahmad Fauzi</p>
                                <p class="text-xs text-slate-500 font-medium">SPBU 04 - Bandung</p>
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

        <!-- Main Content -->
        <main class="flex-1 ml-72">
            <div class="max-w-[1200px] mx-auto p-10">
                <!-- Top Header -->
                <header class="flex flex-wrap items-end justify-between gap-6 mb-12">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                            Monitor <span class="gradient-text">Distribusi.</span>
                        </h2>
                        <p class="text-slate-500 text-base font-medium">Quick overview of today's BBM distribution operations.</p>
                    </div>
                    <div class="glass-panel px-5 py-3 rounded-2xl shadow-glass flex items-center gap-4">
                        <div class="p-2 bg-slate-100 dark:bg-slate-800 rounded-xl">
                            <span class="material-symbols-outlined text-pertamina-blue">calendar_month</span>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Current Shift</p>
                            <p class="text-sm font-bold text-slate-900 dark:text-white">Senin, 23 Okt • 08:00 - 16:00</p>
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
                                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">Total Entries</p>
                                <p class="text-4xl font-extrabold text-slate-900 dark:text-white">124</p>
                            </div>
                            <div class="size-12 rounded-2xl bg-pertamina-blue/10 flex items-center justify-center text-pertamina-blue">
                                <span class="material-symbols-outlined">receipt_long</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 relative z-10">
                            <span class="flex items-center gap-1 text-xs font-bold text-pertamina-green bg-pertamina-green/10 px-2 py-1 rounded-md">
                                <span class="material-symbols-outlined text-[14px]">trending_up</span> +12%
                            </span>
                            <span class="text-xs text-slate-500 font-medium">vs relative to yesterday</span>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="glass-panel rounded-3xl p-6 hover-lift relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 size-24 bg-pertamina-red/5 rounded-full blur-xl group-hover:bg-pertamina-red/10 transition-colors"></div>
                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div>
                                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">Total Volume</p>
                                <div class="flex items-baseline gap-1">
                                    <p class="text-4xl font-extrabold text-slate-900 dark:text-white">45.2</p>
                                    <span class="text-slate-500 font-semibold">KL</span>
                                </div>
                            </div>
                            <div class="size-12 rounded-2xl bg-pertamina-red/10 flex items-center justify-center text-pertamina-red">
                                <span class="material-symbols-outlined">water_drop</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 relative z-10">
                            <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-gradient-to-r from-pertamina-red to-orange-500 h-1.5 rounded-full" style="width: 75%"></div>
                            </div>
                            <span class="text-xs text-slate-500 font-bold whitespace-nowrap">75% Capacity</span>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="glass-panel rounded-3xl p-6 hover-lift relative overflow-hidden group">
                        <div class="absolute -right-6 -top-6 size-24 bg-pertamina-green/5 rounded-full blur-xl group-hover:bg-pertamina-green/10 transition-colors"></div>
                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div>
                                <p class="text-slate-500 text-sm font-bold uppercase tracking-wider mb-1">System Status</p>
                                <p class="text-3xl font-extrabold text-pertamina-green">Online &amp; Active</p>
                            </div>
                            <div class="size-12 rounded-2xl bg-pertamina-green/10 flex items-center justify-center text-pertamina-green">
                                <span class="material-symbols-outlined">check_circle</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 relative z-10">
                            <span class="relative flex size-3">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pertamina-green opacity-75"></span>
                                <span class="relative inline-flex rounded-full size-3 bg-pertamina-green"></span>
                            </span>
                            <span class="text-xs text-slate-500 font-medium">All APIs operational</span>
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
                                    <span class="size-2 rounded-full bg-pertamina-red animate-pulse"></span>
                                    Priority Action
                                </span>
                                <h3 class="text-3xl font-bold text-white leading-tight">Mulai Scanner <span class="text-pertamina-blue">QR Code</span></h3>
                                <p class="text-slate-400 text-base leading-relaxed">
                                    Pindai QR Code pada armada kendaraan untuk mencatat distribusi BBM baru secara instan, akurat, dan terintegrasi langsung dengan database pusat.
                                </p>
                            </div>
                            <a href="{{ route('operator.input-distribution') ?? '#' }}" class="group relative flex items-center justify-center gap-3 px-8 py-5 rounded-2xl bg-pertamina-red text-white font-bold text-lg overflow-hidden shrink-0 hover:scale-105 transition-all shadow-glow-red hover:shadow-none">
                                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                                <span class="material-symbols-outlined relative z-10 text-3xl group-hover:rotate-12 transition-transform">qr_code_scanner</span>
                                <span class="relative z-10">Scan Sekarang</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Logs Table -->
                <div class="glass-panel rounded-3xl overflow-hidden shadow-glass border border-white/40">
                    <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50 flex flex-wrap items-center justify-between gap-4 bg-white/40 dark:bg-slate-800/40">
                        <div class="flex items-center gap-3">
                            <div class="p-2bg-white rounded-lg shadow-sm">
                                <span class="material-symbols-outlined text-pertamina-blue">history</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Riwayat Distribusi Terakhir</h3>
                        </div>
                        <a href="{{ route('operator.history') ?? '#' }}" class="text-sm font-bold text-pertamina-blue hover:text-blue-700 flex items-center gap-1 hover:gap-2 transition-all">
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
                                <!-- Row 1 -->
                                <tr class="hover:bg-white/60 dark:hover:bg-slate-800/60 transition-colors group">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white">14:45</p>
                                        <p class="text-xs text-slate-500">23 Okt 2023</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600">
                                            <span class="material-symbols-outlined text-[16px] text-slate-500">local_shipping</span>
                                            <span class="text-sm font-bold tracking-widest text-slate-800 dark:text-white">D 1234 ABC</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="size-2 rounded-full bg-[#198754]"></div>
                                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Pertalite</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-extrabold text-slate-900 dark:text-white">250.00</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-pertamina-green/10 text-pertamina-green text-xs font-bold border border-pertamina-green/20">
                                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai
                                        </span>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr class="hover:bg-white/60 dark:hover:bg-slate-800/60 transition-colors group">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white">13:10</p>
                                        <p class="text-xs text-slate-500">23 Okt 2023</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600">
                                            <span class="material-symbols-outlined text-[16px] text-slate-500">local_shipping</span>
                                            <span class="text-sm font-bold tracking-widest text-slate-800 dark:text-white">B 9876 XYZ</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="size-2 rounded-full bg-[#0d6efd]"></div>
                                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Pertamax</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-extrabold text-slate-900 dark:text-white">8,000.00</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-pertamina-green/10 text-pertamina-green text-xs font-bold border border-pertamina-green/20">
                                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai
                                        </span>
                                    </td>
                                </tr>
                                 <!-- Row 3 -->
                                <tr class="hover:bg-white/60 dark:hover:bg-slate-800/60 transition-colors group">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white">11:55</p>
                                        <p class="text-xs text-slate-500">23 Okt 2023</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600">
                                            <span class="material-symbols-outlined text-[16px] text-slate-500">local_shipping</span>
                                            <span class="text-sm font-bold tracking-widest text-slate-800 dark:text-white">D 4455 DEF</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="size-2 rounded-full bg-[#6c757d]"></div>
                                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Biosolar</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-extrabold text-slate-900 dark:text-white">16,000.00</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-orange-500/10 text-orange-600 text-xs font-bold border border-orange-500/20">
                                            <span class="material-symbols-outlined text-[14px] animate-spin">sync</span> Proses
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>