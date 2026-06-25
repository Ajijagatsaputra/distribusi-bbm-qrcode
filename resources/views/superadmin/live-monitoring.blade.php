@extends('layouts.superadmin')

@section('title', 'Global Live Monitoring')

@section('content')
    <div class="animate-slide-in">
        <div class="flex flex-col flex-wrap items-center justify-between gap-4 mb-8 md:flex-row">
            <div>
                <h3 class="flex items-center gap-3 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                    <span class="relative flex h-4 w-4 mr-1">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pertamina-red opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-pertamina-red"></span>
                    </span>
                    Live <span class="text-pertamina-blue">Monitoring</span>
                </h3>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Pemantauan armada dan distribusi BBM di seluruh
                    wilayah secara real-time</p>
            </div>
            <div class="flex gap-2">
                <span
                    class="px-3 py-1.5 text-xs font-bold bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-sm">
                    Last Update: <span id="clock" class="text-pertamina-blue">00:00:00</span>
                </span>
            </div>
        </div>

        <!-- MAIN MONITORING GRID -->
        <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-3">

            <!-- MAP SIMULATION AREA (2/3 width) -->
            <div
                class="flex flex-col overflow-hidden transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 lg:col-span-2">
                <div
                    class="flex items-center justify-between p-4 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white"><span
                            class="material-symbols-outlined text-[18px] mr-1 align-bottom text-pertamina-blue">map</span>
                        Peta Persebaran Armada</h4>
                    <div class="flex gap-2">
                        <span class="flex items-center gap-1 text-[10px] font-bold uppercase text-slate-500"><span
                                class="size-2 bg-pertamina-green rounded-full"></span> On Route</span>
                        <span class="flex items-center gap-1 text-[10px] font-bold uppercase text-slate-500"><span
                                class="size-2 bg-orange-500 rounded-full"></span> Loading</span>
                        <span class="flex items-center gap-1 text-[10px] font-bold uppercase text-slate-500"><span
                                class="size-2 bg-pertamina-red rounded-full"></span> Issue</span>
                    </div>
                </div>

                <div class="relative w-full h-[400px] bg-slate-100 dark:bg-slate-800/50 flex py-1">
                    <!-- Map UI Simulation -->
                    <div class="absolute inset-0 z-0 opacity-20 dark:opacity-10"
                        style="background-image: radial-gradient(#195de6 1px, transparent 1px); background-size: 20px 20px;">
                    </div>

                    <!-- Radar Sweep Simulation -->
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 size-96 border border-pertamina-blue/20 rounded-full">
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 size-64 border border-pertamina-blue/20 rounded-full">
                    </div>
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 size-32 border border-pertamina-blue/20 rounded-full">
                    </div>

                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 opacity-30 origin-center animate-[spin_4s_linear_infinite]"
                        style="background: conic-gradient(from 0deg, transparent 70%, rgba(25, 93, 230, 0.8) 100%); border-radius: 50%;">
                    </div>

                    <!-- Map Pins -->
                    <!-- Pin 1 -->
                    <div class="absolute top-[30%] left-[40%] group cursor-pointer animate-bounce"
                        style="animation-duration: 2s;">
                        <span class="relative flex h-4 w-4">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pertamina-green opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-4 w-4 bg-pertamina-green border-2 border-white shadow-md"></span>
                        </span>
                        <div
                            class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 hidden group-hover:block w-32 bg-slate-900 text-white text-xs p-2 rounded-lg shadow-xl z-10">
                            <p class="font-bold">Truck B 1202</p>
                            <p class="text-slate-300">Status: On Route</p>
                            <p class="text-pertamina-green mt-1">Speed: 45 km/h</p>
                        </div>
                    </div>

                    <!-- Pin 2 -->
                    <div class="absolute top-[60%] left-[70%] group cursor-pointer">
                        <span class="relative flex h-4 w-4">
                            <span
                                class="relative inline-flex rounded-full h-4 w-4 bg-orange-500 border-2 border-white shadow-md"></span>
                        </span>
                        <div
                            class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 hidden group-hover:block w-32 bg-slate-900 text-white text-xs p-2 rounded-lg shadow-xl z-10">
                            <p class="font-bold">Truck D 8812</p>
                            <p class="text-slate-300">Status: Loading</p>
                            <p class="text-orange-400 mt-1">Terminal Plumpang</p>
                        </div>
                    </div>

                    <!-- Pin 3 Alert -->
                    <div class="absolute top-[45%] left-[20%] group cursor-pointer animate-pulse">
                        <span class="relative flex h-4 w-4">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pertamina-red opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-4 w-4 bg-pertamina-red border-2 border-white shadow-md"></span>
                        </span>
                        <div
                            class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 hidden group-hover:block w-32 bg-slate-900 text-white text-xs p-2 rounded-lg shadow-xl z-10">
                            <p class="font-bold">Truck H 9122</p>
                            <p class="text-slate-300">Status: Issue</p>
                            <p class="text-pertamina-red mt-1">Traffic Delay</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REAL TIME LOGS (1/3 width) -->
            <div
                class="flex flex-col overflow-hidden transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="p-4 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white"><span
                            class="material-symbols-outlined text-[18px] mr-1 align-bottom text-pertamina-blue">rss_feed</span>
                        Live Activity Feed</h4>
                </div>

                <div class="flex-1 p-4 overflow-y-auto max-h-[400px]">
                    <div class="relative pl-4 space-y-6 border-l-2 border-slate-100 dark:border-slate-700">
                        @forelse($recentDistributions as $dist)
                            <div class="relative">
                                <div class="absolute -left-[21px] p-1 bg-white dark:bg-slate-900 rounded-full">
                                    <span class="flex block size-2.5 rounded-full bg-pertamina-green"></span>
                                </div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-200">QR Validated:
                                    {{ $dist->distribution_code }}</p>
                                <p class="text-[11px] text-slate-500 mt-0.5">{{ $dist->spbu->name ?? 'SPBU' }} •
                                    {{ number_format($dist->volume_liter, 0, ',', '.') }}L {{ $dist->fuelType->name ?? 'BBM' }}
                                </p>
                                <p class="text-[10px] font-semibold text-slate-400 mt-1">
                                    {{ $dist->distributed_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <div class="text-xs text-slate-400 font-medium py-4 text-center">Belum ada aktifitas distribusi
                                terbaru.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM METRICS -->
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
            <div
                class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
                <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">Transaksi Hari Ini</p>
                <h4 class="text-2xl font-black text-pertamina-blue">{{ $stats['total_today'] ?? 0 }}</h4>
                <p class="text-[10px] text-slate-400 mt-1">Selesai hari ini</p>
            </div>
            <div
                class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
                <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">Total Volume Salur</p>
                <h4 class="text-2xl font-black text-slate-900 dark:text-white">
                    {{ number_format(($stats['total_volume'] ?? 0) / 1000, 1, ',', '.') }} <span class="text-sm">KL</span>
                </h4>
                <p class="text-[10px] text-slate-400 mt-1">Total volume disalurkan</p>
            </div>
            <div
                class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
                <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">QR Code Aktif</p>
                <h4 class="text-2xl font-black text-orange-500">{{ $stats['active_qr'] ?? 0 }}</h4>
                <p class="text-[10px] text-slate-400 mt-1">Menunggu pemindaian</p>
            </div>
            <div
                class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
                <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">SPBU Terkoneksi</p>
                <h4 class="text-2xl font-black text-pertamina-green">{{ $stats['active_spbu'] ?? 0 }}</h4>
                <p class="text-[10px] text-slate-400 mt-1">Aktif di sistem</p>
            </div>
        </div>
    </div>

    <script>
        // Live Clock
        function updateClock() {
            const now = new Date();
            document.getElementById('clock').textContent = now.toLocaleTimeString('id-ID');
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
@endsection