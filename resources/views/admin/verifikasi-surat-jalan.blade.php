@extends('layouts.admin')

@section('title', 'Verifikasi Surat Jalan')

@section('content')
    <div class="space-y-8">
        {{-- HEADER --}}
        <div class="flex flex-col gap-1">
            <h2 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                Verifikasi <span class="gradient-text">Surat Jalan</span>
            </h2>
            <p class="text-base font-medium text-slate-500 dark:text-slate-400">
                Periksa kelayakan dan verifikasi Surat Jalan Driver sebelum pengiriman BBM dimulai
            </p>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between border border-white/50 shadow-glass">
                <span class="material-symbols-outlined text-amber-500 text-3xl">hourglass_empty</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold block">{{ $stats['menunggu'] }}</span>
                    <span class="text-xs text-slate-500 font-medium">Menunggu Verifikasi</span>
                </div>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between border border-white/50 shadow-glass">
                <span class="material-symbols-outlined text-blue-500 text-3xl">verified</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold block">{{ $stats['terverifikasi'] }}</span>
                    <span class="text-xs text-slate-500 font-medium">Sudah Terverifikasi</span>
                </div>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between border border-white/50 shadow-glass">
                <span class="material-symbols-outlined text-purple-500 text-3xl">local_shipping</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold block">{{ $stats['dikirim'] }}</span>
                    <span class="text-xs text-slate-500 font-medium">Dalam Perjalanan</span>
                </div>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between border border-white/50 shadow-glass">
                <span class="material-symbols-outlined text-pertamina-green text-3xl">check_circle</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold block">{{ $stats['selesai'] }}</span>
                    <span class="text-xs text-slate-500 font-medium">Pengiriman Selesai</span>
                </div>
            </div>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div
                class="p-4 bg-pertamina-green/10 border border-pertamina-green/20 rounded-2xl flex items-center gap-3 text-pertamina-green font-semibold">
                <span class="material-symbols-outlined">check_circle</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div
                class="p-4 bg-pertamina-red/10 border border-pertamina-red/20 rounded-2xl flex items-center gap-3 text-pertamina-red font-semibold">
                <span class="material-symbols-outlined">error</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- FILTER --}}
        <div class="glass-panel p-6 rounded-3xl border border-white/50 shadow-glass bg-white/40">
            <form method="GET" action="{{ route('admin.verifikasi') }}" class="flex flex-wrap items-center gap-4">
                <a href="{{ route('admin.verifikasi') }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ !request('status') ? 'bg-pertamina-blue text-white shadow-glow-blue' : 'bg-white/50 hover:bg-white text-slate-600 border border-slate-200' }}">Semua</a>
                <a href="{{ route('admin.verifikasi', ['status' => 'menunggu']) }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request('status') === 'menunggu' ? 'bg-amber-500 text-white' : 'bg-white/50 hover:bg-white text-slate-600 border border-slate-200' }}">Menunggu
                    ({{ $stats['menunggu'] }})</a>
                <a href="{{ route('admin.verifikasi', ['status' => 'terverifikasi']) }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request('status') === 'terverifikasi' ? 'bg-blue-500 text-white' : 'bg-white/50 hover:bg-white text-slate-600 border border-slate-200' }}">Terverifikasi
                    ({{ $stats['terverifikasi'] }})</a>
                <a href="{{ route('admin.verifikasi', ['status' => 'dikirim']) }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request('status') === 'dikirim' ? 'bg-purple-500 text-white' : 'bg-white/50 hover:bg-white text-slate-600 border border-slate-200' }}">Dikirim
                    ({{ $stats['dikirim'] }})</a>
                <a href="{{ route('admin.verifikasi', ['status' => 'selesai']) }}"
                    class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all {{ request('status') === 'selesai' ? 'bg-pertamina-green text-white' : 'bg-white/50 hover:bg-white text-slate-600 border border-slate-200' }}">Selesai
                    ({{ $stats['selesai'] }})</a>
            </form>
        </div>

        {{-- TABEL VERIFIKASI --}}
        <div class="glass-panel overflow-hidden border border-white/50 shadow-glass rounded-3xl">
            <div class="p-6 border-b border-slate-200/50 bg-white/40">
                <h3 class="text-lg font-extrabold text-slate-900">Verifikasi Dokumen Surat Jalan</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-slate-50/80">
                        <tr>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Kode SJ</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Driver & Armada
                            </th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">BBM & Volume
                            </th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">SPBU Tujuan</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider text-center">
                                Status</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider text-right">Aksi
                                Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white/10">
                        @forelse($suratJalans as $sj)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-900">{{ $sj->kode_surat_jalan }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-950">{{ $sj->driver->name }}</div>
                                    <div class="text-xs font-mono text-slate-500">{{ $sj->vehicle_plate }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $sj->fuelType->name }}</div>
                                    <div class="text-xs text-slate-500">{{ number_format($sj->volume_liter) }} L</div>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-700">
                                    <div>{{ $sj->spbu->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $sj->spbu->location }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $color = $sj->statusColor();
                                        $label = $sj->statusLabel();
                                    @endphp
                                    <span class="px-3 py-1.5 rounded-full text-xs font-bold inline-flex items-center gap-1.5
                                            @if($color === 'amber') bg-amber-100 text-amber-800
                                            @elseif($color === 'blue') bg-blue-100 text-blue-800
                                            @elseif($color === 'purple') bg-purple-100 text-purple-800
                                            @elseif($color === 'green') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                        <span class="w-1.5 h-1.5 rounded-full
                                                @if($color === 'amber') bg-amber-500
                                                @elseif($color === 'blue') bg-blue-500
                                                @elseif($color === 'purple') bg-purple-500
                                                @elseif($color === 'green') bg-green-500
                                                @else bg-red-500
                                                @endif"></span>
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($sj->status === 'menunggu')
                                            <form method="POST" action="{{ route('admin.surat-jalan.verify', $sj->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-pertamina-blue hover:bg-blue-700 text-white font-bold text-xs px-4 py-2 rounded-xl transition-all shadow-sm flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[16px]">verified</span>
                                                    <span>Verifikasi Driver</span>
                                                </button>
                                            </form>
                                        @elseif($sj->status === 'terverifikasi')
                                            <form method="POST" action="{{ route('admin.surat-jalan.dikirim', $sj->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs px-4 py-2 rounded-xl transition-all shadow-sm flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[16px]">local_shipping</span>
                                                    <span>Lepas Kirim</span>
                                                </button>
                                            </form>
                                        @elseif($sj->status === 'dikirim')
                                            <span class="text-xs text-purple-600 font-bold flex items-center gap-1 justify-end">
                                                <span class="animate-pulse w-2 h-2 rounded-full bg-purple-500"></span>
                                                Driver OTR (On the Road)
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400 font-medium">Selesai / Selesai Pengiriman</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-slate-400 font-medium">Tidak ada Surat Jalan dalam
                                    kategori ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($suratJalans->hasPages())
                <div class="p-6 border-t border-slate-100">
                    {{ $suratJalans->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection