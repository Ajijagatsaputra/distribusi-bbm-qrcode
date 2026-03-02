<!DOCTYPE html>
<html class="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pertamina - Riwayat Distribusi</title>
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
                    fontFamily: { "sans": ["Outfit", "sans-serif"] },
                    boxShadow: { 'glass': '0 8px 32px 0 rgba(0, 94, 184, 0.05)' },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-panel { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .input-glass { background: rgba(255, 255, 255, 0.8); border: 1px solid rgba(203, 213, 225, 0.8); }
        .input-glass:focus { border-color: #005eb8; box-shadow: 0 0 0 3px rgba(0, 94, 184, 0.1); outline: none; }
        .gradient-text { background: linear-gradient(135deg, #005eb8, #0099ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark min-h-screen text-slate-800 dark:text-slate-100 overflow-x-hidden">
    <div class="fixed top-0 right-0 w-[50%] h-[50%] rounded-bl-full bg-pertamina-blue/5 blur-[100px] pointer-events-none -z-10"></div>
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-72 glass-panel border-r border-slate-200/50 flex flex-col fixed h-full z-20">
            <div class="flex flex-col h-full px-6 py-8">
                <!-- Brand -->
                <div class="flex items-center gap-4 mb-12 px-2">
                    <div class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 size-12 shrink-0">
                        <span class="material-symbols-outlined text-2xl">local_gas_station</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900">BBM<span class="text-pertamina-red">Distribusi</span></h1>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5">Operator Portal</p>
                    </div>
                </div>

                <!-- Nav -->
                <nav class="flex flex-col flex-1 gap-2">
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 font-medium transition-all group" href="{{ route('operator.dashboard') ?? '#' }}">
                        <span class="material-symbols-outlined group-hover:scale-110 transition-transform">dashboard</span><span class="text-sm">Dashboard Overview</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 font-medium transition-all group" href="{{ route('operator.input-distribution') ?? '#' }}">
                        <span class="material-symbols-outlined group-hover:scale-110 transition-transform">qr_code_scanner</span><span class="text-sm">Scan &amp; Input Data</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-pertamina-blue/10 text-pertamina-blue font-bold transition-all relative group" href="{{ route('operator.history') ?? '#' }}">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full"></div>
                        <span class="material-symbols-outlined">history</span><span class="text-sm">Distribution Log</span>
                    </a>
                </nav>

                <!-- Profile -->
                <div class="mt-auto pt-8">
                    <div class="glass-panel rounded-2xl p-4 flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&amp;background=005eb8&amp;color=fff" class="rounded-full size-10 border-2 border-white" />
                            <div class="flex flex-col overflow-hidden">
                                <p class="text-sm font-bold text-slate-900 truncate">Ahmad Fauzi</p>
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
                <div class="flex items-end justify-between mb-10">
                    <div>
                        <h2 class="text-4xl font-extrabold tracking-tight text-slate-900 mb-2">Riwayat <span class="gradient-text">Log Distribusi</span></h2>
                        <p class="text-slate-500 font-medium text-lg">Laporan detail seluruh aktivitas pengiriman BBM dari stasiun operator.</p>
                    </div>
                    <button class="flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 hover:border-pertamina-blue hover:text-pertamina-blue rounded-xl font-bold text-slate-600 transition-all shadow-sm">
                        <span class="material-symbols-outlined">download</span> Ekspor Laporan
                    </button>
                </div>

                <!-- Filters -->
                <div class="glass-panel p-6 rounded-3xl shadow-glass mb-8 flex flex-wrap gap-4 items-center justify-between">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="relative w-full max-w-sm">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400">search</span>
                            <input type="text" placeholder="Cari No. Polisi atau Tujuan..." class="w-full h-12 pl-12 pr-4 rounded-xl bg-white border border-slate-200 outline-none focus:border-pertamina-blue focus:ring-4 focus:ring-pertamina-blue/10 transition-all" />
                        </div>
                        <div class="flex items-center gap-3 bg-white border border-slate-200 rounded-xl px-4 h-12">
                            <span class="material-symbols-outlined text-slate-400">calendar_month</span>
                            <span class="text-slate-600 font-medium text-sm">Hari ini, 23 Okt</span>
                            <span class="material-symbols-outlined text-slate-400 cursor-pointer hover:text-pertamina-blue transition-colors">arrow_drop_down</span>
                        </div>
                    </div>
                    <button class="flex items-center gap-2 px-5 py-2.5 rounded-xl text-slate-600 hover:bg-slate-100 font-bold transition-colors">
                        <span class="material-symbols-outlined">filter_list</span> Filter Lanjutan
                    </button>
                </div>

                <!-- Table -->
                <div class="glass-panel rounded-3xl shadow-glass overflow-hidden border border-white/50">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/80">
                                <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Tanggal &amp; Waktu</th>
                                <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">No. Polisi</th>
                                <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Produk BBM</th>
                                <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Volume (L)</th>
                                <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Tujuan</th>
                                <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200/50 bg-white/40">
                            <tr class="hover:bg-white/80 transition-colors">
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-slate-900">23 Okt 2023</p>
                                    <p class="text-xs text-slate-500 mt-0.5">14:45 WIB</p>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 border border-slate-200">
                                        <span class="text-sm font-bold tracking-widest text-slate-800">D 1234 ABC</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-semibold text-slate-700">Pertalite</td>
                                <td class="px-6 py-5 font-extrabold text-slate-900">250.00</td>
                                <td class="px-6 py-5 font-medium text-slate-600">Depot Siliwangi</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pertamina-green/10 text-pertamina-green text-xs font-bold border border-pertamina-green/20">
                                        <span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-white/80 transition-colors">
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-slate-900">23 Okt 2023</p>
                                    <p class="text-xs text-slate-500 mt-0.5">11:55 WIB</p>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 border border-slate-200">
                                        <span class="text-sm font-bold tracking-widest text-slate-800">D 4455 DEF</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-semibold text-slate-700">Biosolar</td>
                                <td class="px-6 py-5 font-extrabold text-slate-900">16,000.00</td>
                                <td class="px-6 py-5 font-medium text-slate-600">Logistics Center A</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/10 text-amber-600 text-xs font-bold border border-amber-500/20">
                                        <span class="material-symbols-outlined text-[14px] animate-spin">sync</span> Dalam Proses
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-white/80 transition-colors">
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-slate-900">23 Okt 2023</p>
                                    <p class="text-xs text-slate-500 mt-0.5">09:15 WIB</p>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 border border-slate-200">
                                        <span class="text-sm font-bold tracking-widest text-slate-800">F 5566 JKL</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 font-semibold text-slate-700">Pertamax Turbo</td>
                                <td class="px-6 py-5 font-extrabold text-slate-900">120.00</td>
                                <td class="px-6 py-5 font-medium text-slate-600">Emergency Services</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pertamina-red/10 text-pertamina-red text-xs font-bold border border-pertamina-red/20">
                                        <span class="material-symbols-outlined text-[14px]">error</span> Dibatalkan
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <div class="px-6 py-4 bg-slate-50/80 border-t border-slate-200/50 flex items-center justify-between">
                        <p class="text-sm text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-900">1-3</span> dari <span class="font-bold text-slate-900">124</span> data</p>
                        <div class="flex gap-2">
                            <button class="size-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400 bg-white" disabled><span class="material-symbols-outlined">chevron_left</span></button>
                            <button class="size-9 flex items-center justify-center rounded-lg bg-pertamina-blue text-white font-bold shadow-glow-blue">1</button>
                            <button class="size-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 bg-white hover:bg-slate-50 font-bold transition-colors">2</button>
                            <button class="size-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 bg-white hover:bg-slate-50 font-bold transition-colors">3</button>
                            <button class="size-9 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 bg-white hover:bg-slate-50 transition-colors"><span class="material-symbols-outlined">chevron_right</span></button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>