@extends('layouts.superadmin')

@section('title', 'Pemesanan SPBU')

@section('content')
    <div class="space-y-8 animate-slide-in">
        {{-- HEADER --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center justify-between">
            <div>
                <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                    Manajemen <span class="gradient-text">Pemesanan BBM SPBU</span>
                </h2>
                <p class="text-sm font-medium text-slate-500">
                    Verifikasi, tolak, atau terbitkan Surat Jalan untuk pesanan BBM yang diajukan oleh masing-masing SPBU
                </p>
            </div>
        </div>

        {{-- FEEDBACK MESSAGE --}}
        @if(session('success'))
            <div
                class="flex items-center gap-3 px-4 py-3 bg-pertamina-green/10 border border-pertamina-green/30 rounded-xl text-pertamina-green font-semibold text-sm">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div
                class="flex items-center gap-3 px-4 py-3 bg-pertamina-red/10 border border-pertamina-red/30 rounded-xl text-pertamina-red font-semibold text-sm">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif

        {{-- STATS GRID --}}
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            <div class="glass-panel p-6 rounded-2xl flex flex-col gap-1">
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pesanan</span>
                <span class="text-3xl font-black text-slate-900 dark:text-white">{{ $stats['total'] }}</span>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col gap-1 border-amber-250 bg-amber-50/10">
                <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">Menunggu</span>
                <span class="text-3xl font-black text-amber-600">{{ $stats['menunggu'] }}</span>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col gap-1 border-blue-250 bg-blue-50/10">
                <span class="text-xs font-bold text-pertamina-blue uppercase tracking-wider">Disetujui</span>
                <span class="text-3xl font-black text-pertamina-blue">{{ $stats['disetujui'] }}</span>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col gap-1 border-emerald-250 bg-emerald-50/10">
                <span class="text-xs font-bold text-pertamina-green uppercase tracking-wider">Selesai</span>
                <span class="text-3xl font-black text-pertamina-green">{{ $stats['selesai'] }}</span>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col gap-1 border-red-250 bg-red-50/10">
                <span class="text-xs font-bold text-pertamina-red uppercase tracking-wider">Ditolak</span>
                <span class="text-3xl font-black text-pertamina-red">{{ $stats['ditolak'] }}</span>
            </div>
        </div>

        {{-- ORDERS TABLE --}}
        <div class="glass-panel rounded-3xl border border-white/50 shadow-glass bg-white/60 overflow-hidden">
            <div
                class="p-6 border-b border-slate-200/50 dark:border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h3 class="font-bold text-slate-800 dark:text-white">Daftar Pengajuan Pesanan</h3>

                <div class="flex items-center gap-2">
                    <a href="{{ route('superadmin.orders.index') }}"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all {{ !request('status') ? 'bg-pertamina-blue text-white shadow-sm' : 'bg-slate-100 text-slate-650 hover:bg-slate-200' }}">Semua</a>
                    <a href="{{ route('superadmin.orders.index', ['status' => 'menunggu']) }}"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all {{ request('status') === 'menunggu' ? 'bg-amber-500 text-white shadow-sm' : 'bg-slate-100 text-slate-650 hover:bg-slate-200' }}">Menunggu</a>
                    <a href="{{ route('superadmin.orders.index', ['status' => 'disetujui']) }}"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all {{ request('status') === 'disetujui' ? 'bg-blue-600 text-white shadow-sm' : 'bg-slate-100 text-slate-650 hover:bg-slate-200' }}">Disetujui</a>
                    <a href="{{ route('superadmin.orders.index', ['status' => 'selesai']) }}"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all {{ request('status') === 'selesai' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-slate-100 text-slate-650 hover:bg-slate-200' }}">Selesai</a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr
                            class="text-xs font-bold tracking-wider uppercase bg-slate-50/50 dark:bg-slate-800/50 text-slate-500 border-b border-slate-200 dark:border-slate-700">
                            <th class="px-6 py-4">Kode</th>
                            <th class="px-6 py-4">SPBU Pengaju</th>
                            <th class="px-6 py-4">Jenis BBM</th>
                            <th class="px-6 py-4">Volume</th>
                            <th class="px-6 py-4">Tanggal Pengajuan</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($orders as $order)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                                    {{ $order->kode_pesanan }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-slate-800 dark:text-slate-200">{{ $order->spbu->name }}</span>
                                        <span class="text-xs text-slate-400 font-semibold">{{ $order->spbu->address }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="w-3 h-3 rounded-full"
                                            style="background-color: {{ $order->fuelType->color_code ?? '#ccc' }}"></span>
                                        <span
                                            class="font-bold text-slate-700 dark:text-slate-300">{{ $order->fuelType->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                                    {{ number_format($order->volume_liter, 0, ',', '.') }} L
                                </td>
                                <td class="px-6 py-4 text-slate-500 font-semibold">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $color = $order->statusColor();
                                        $label = $order->statusLabel();
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-{{ $color }}-100 text-{{ $color }}-700 dark:bg-{{ $color }}-900/30 dark:text-{{ $color }}-400 border border-{{ $color }}-200 dark:border-{{ $color }}-850">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($order->status === 'menunggu')
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('superadmin.surat-jalan.create', ['pesanan_id' => $order->id]) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-bold text-white bg-pertamina-blue hover:bg-blue-700 rounded-lg shadow-sm transition-all hover:scale-105">
                                                <span class="material-symbols-outlined text-[14px]">local_shipping</span>
                                                Buat Surat Jalan
                                            </a>

                                            <form action="{{ route('superadmin.orders.reject', $order->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menolak pesanan ini?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-bold text-pertamina-red bg-pertamina-red/10 hover:bg-pertamina-red hover:text-white rounded-lg transition-all">
                                                    <span class="material-symbols-outlined text-[14px]">close</span>
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($order->suratJalan)
                                        <div class="flex flex-col items-end">
                                            <span class="text-xs font-bold text-slate-400">Surat Jalan Terbit</span>
                                            <span
                                                class="text-xs font-mono font-bold text-pertamina-blue mt-0.5 bg-blue-50 dark:bg-blue-900/20 px-1.5 py-0.5 rounded">
                                                {{ $order->suratJalan->kode_surat_jalan }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 font-semibold italic">Tidak Ada Aksi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500 font-semibold">
                                    Tidak ada data pemesanan BBM yang cocok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/10">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection