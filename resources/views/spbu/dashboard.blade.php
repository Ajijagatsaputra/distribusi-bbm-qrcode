@extends('layouts.spbu')

@section('title', 'Dashboard SPBU')

@section('content')
<div class="animate-slide-in">
    {{-- WELCOME BANNER --}}
    <div class="relative overflow-hidden mb-8 p-8 rounded-3xl bg-gradient-to-r from-pertamina-blue to-blue-800 text-white shadow-lg">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="px-3 py-1 text-xs font-bold uppercase tracking-widest bg-white/20 rounded-full">
                    Admin Portal SPBU
                </span>
                <h2 class="mt-3 text-3xl font-black tracking-tight md:text-4xl">
                    Selamat Datang, {{ auth()->user()->name }}!
                </h2>
                <p class="mt-2 text-sm text-blue-100 max-w-xl font-medium">
                    Panel kendali distribusi BBM untuk <span class="font-bold underline">{{ $spbu->name }}</span> (Kode: {{ $spbu->code }}). Anda dapat memantau status pesanan dan melakukan verifikasi kedatangan driver secara real-time.
                </p>
            </div>
            <div class="flex items-center gap-4 shrink-0 bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/10">
                <span class="material-symbols-outlined text-4xl text-pertamina-green">storefront</span>
                <div>
                    <p class="text-xs text-blue-100 font-bold uppercase tracking-wider">Lokasi SPBU</p>
                    <p class="text-lg font-black">{{ $spbu->name }}</p>
                    <p class="text-xs text-blue-200 font-semibold">{{ $spbu->address }}</p>
                </div>
            </div>
        </div>
        <!-- Decorative blob -->
        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    {{-- STATS GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        {{-- STAT 1 --}}
        <div class="p-6 transition-all duration-300 bg-white border border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md flex items-center gap-4">
            <div class="p-3.5 rounded-xl bg-pertamina-blue/10 text-pertamina-blue">
                <span class="material-symbols-outlined text-2xl">shopping_cart</span>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pesanan</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $ordersCount }}</h3>
            </div>
        </div>

        {{-- STAT 2 --}}
        <div class="p-6 transition-all duration-300 bg-white border border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md flex items-center gap-4">
            <div class="p-3.5 rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                <span class="material-symbols-outlined text-2xl">pending_actions</span>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Menunggu</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $pendingCount }}</h3>
            </div>
        </div>

        {{-- STAT 3 --}}
        <div class="p-6 transition-all duration-300 bg-white border border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md flex items-center gap-4">
            <div class="p-3.5 rounded-xl bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                <span class="material-symbols-outlined text-2xl">local_shipping</span>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Sedang Dikirim</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $deliveryCount }}</h3>
            </div>
        </div>

        {{-- STAT 4 --}}
        <div class="p-6 transition-all duration-300 bg-white border border-slate-200/60 rounded-2xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md flex items-center gap-4">
            <div class="p-3.5 rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                <span class="material-symbols-outlined text-2xl">check_circle</span>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Selesai</p>
                <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-1">{{ $completedCount }}</h3>
            </div>
        </div>
    </div>

    {{-- CONTENT SPLIT --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- LEFT COLUMN: RECENT ORDERS --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="p-6 bg-white border border-slate-200/50 rounded-2xl dark:bg-slate-900/70 dark:border-slate-800 shadow-glass">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white">Riwayat Pesanan Terbaru</h3>
                        <p class="text-xs text-slate-500 mt-1 font-medium">5 pengajuan pesanan BBM terakhir</p>
                    </div>
                    <a href="{{ route('spbu.orders.index') }}" class="flex items-center gap-1.5 text-sm font-bold text-pertamina-blue hover:underline">
                        Lihat Semua
                        <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="text-xs font-bold tracking-wider uppercase bg-slate-50 dark:bg-slate-800 text-slate-500 border-b border-slate-200 dark:border-slate-700">
                                <th class="px-4 py-3.5">Kode</th>
                                <th class="px-4 py-3.5">Jenis BBM</th>
                                <th class="px-4 py-3.5">Volume (L)</th>
                                <th class="px-4 py-3.5">Status</th>
                                <th class="px-4 py-3.5">Surat Jalan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-4 py-4 font-bold text-slate-900 dark:text-white">
                                        {{ $order->kode_pesanan }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="w-3 h-3 rounded-full" style="background-color: {{ $order->fuelType->color_code ?? '#ccc' }}"></span>
                                            <span class="font-bold text-slate-700 dark:text-slate-300">{{ $order->fuelType->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 font-semibold text-slate-700 dark:text-slate-300">
                                        {{ number_format($order->volume_liter, 0, ',', '.') }} L
                                    </td>
                                    <td class="px-4 py-4">
                                        @php
                                            $color = $order->statusColor();
                                            $label = $order->statusLabel();
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-{{ $color }}-100 text-{{ $color }}-700 dark:bg-{{ $color }}-900/30 dark:text-{{ $color }}-400 border border-{{ $color }}-200 dark:border-{{ $color }}-850">
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        @if($order->suratJalan)
                                            <span class="text-xs font-bold font-mono text-slate-500 bg-slate-100 dark:bg-slate-800 dark:text-slate-400 px-2 py-1 rounded">
                                                {{ $order->suratJalan->kode_surat_jalan }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400 font-semibold italic">Belum Diterbitkan</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-slate-500 font-semibold">
                                        Belum ada riwayat pesanan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: IN-TRANSIT SHIPMENTS & SCAN QUICK LINK --}}
        <div class="space-y-6">
            {{-- QUICK SCAN CARD --}}
            <div class="p-6 bg-gradient-to-br from-amber-50 to-orange-100 border border-amber-200/50 rounded-2xl dark:from-slate-800 dark:to-slate-800/40 dark:border-slate-700 shadow-md">
                <div class="flex items-center gap-3.5 mb-4">
                    <div class="p-3 rounded-xl bg-amber-500 text-white shrink-0 shadow-glow-blue">
                        <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 dark:text-white">Verifikasi Penerimaan</h4>
                        <p class="text-xs text-slate-500 font-medium">Scan barcode driver yang tiba</p>
                    </div>
                </div>
                <p class="text-xs text-slate-650 dark:text-slate-400 leading-relaxed mb-5">
                    Ketika driver pembawa BBM tiba di SPBU, scan barcode/QR code Surat Jalan yang ditunjukkan oleh driver untuk menyelesaikan proses pengiriman dan mencatat volume BBM masuk ke inventaris.
                </p>
                <a href="{{ route('spbu.verify.scan') }}" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-bold transition-all shadow-md hover:scale-105">
                    <span class="material-symbols-outlined text-[18px]">qr_code_scanner</span>
                    Buka Pemindai Barcode
                </a>
            </div>

            {{-- ACTIVE SHIPMENTS LIST --}}
            <div class="p-6 bg-white border border-slate-200/50 rounded-2xl dark:bg-slate-900/70 dark:border-slate-800 shadow-glass">
                <h4 class="font-black text-slate-900 dark:text-white mb-2">Pengiriman Sedang Jalan</h4>
                <p class="text-xs text-slate-500 font-medium mb-4">Daftar armada BBM yang sedang dalam perjalanan menuju SPBU Anda</p>

                <div class="space-y-4">
                    @forelse($activeDeliveries as $sj)
                        <div class="p-4 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/30 flex flex-col gap-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-mono font-bold text-pertamina-blue bg-blue-50 dark:bg-blue-900/20 px-2 py-0.5 rounded">
                                    {{ $sj->kode_surat_jalan }}
                                </span>
                                <span class="text-xs text-slate-400 font-semibold">{{ $sj->updated_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center justify-between mt-1">
                                <div>
                                    <p class="text-sm font-black text-slate-900 dark:text-white">{{ $sj->vehicle_plate }}</p>
                                    <p class="text-xs text-slate-500 font-semibold">Driver: {{ $sj->driver->name ?? '-' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-black text-slate-700 dark:text-slate-350">{{ $sj->fuelType->name }}</p>
                                    <p class="text-xs text-slate-500 font-semibold">{{ number_format($sj->volume_liter, 0, ',', '.') }} L</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-slate-400 text-xs font-semibold italic">
                            Tidak ada pengiriman yang sedang berjalan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
