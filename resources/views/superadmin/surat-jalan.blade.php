@extends('layouts.superadmin')

@section('title', 'Manajemen Surat Jalan')

@section('content')
    <div class="space-y-8">
        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex flex-col gap-1">
                <h2 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                    Manajemen <span class="gradient-text">Surat Jalan</span>
                </h2>
                <p class="text-base font-medium text-slate-500 dark:text-slate-400">
                    Buat dan kelola surat penugasan pengiriman BBM ke SPBU
                </p>
            </div>
            <a href="{{ route('superadmin.surat-jalan.create') }}"
                class="inline-flex items-center justify-center gap-2 bg-pertamina-blue hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-2xl shadow-glow-blue transition-all">
                <span class="material-symbols-outlined text-[20px]">add_circle</span>
                <span>Buat Surat Jalan</span>
            </a>
        </div>

        {{-- STATS --}}
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between border border-white/50 shadow-glass">
                <span class="material-symbols-outlined text-slate-400 text-3xl">list_alt</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold block">{{ $stats['total'] }}</span>
                    <span class="text-xs text-slate-500 font-medium">Total Surat</span>
                </div>
            </div>
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
                    <span class="text-xs text-slate-500 font-medium">Terverifikasi</span>
                </div>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between border border-white/50 shadow-glass">
                <span class="material-symbols-outlined text-purple-500 text-3xl">local_shipping</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold block">{{ $stats['dikirim'] }}</span>
                    <span class="text-xs text-slate-500 font-medium">Sedang Dikirim</span>
                </div>
            </div>
            <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between border border-white/50 shadow-glass">
                <span class="material-symbols-outlined text-pertamina-green text-3xl">check_circle</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold block">{{ $stats['selesai'] }}</span>
                    <span class="text-xs text-slate-500 font-medium">Selesai</span>
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

        {{-- FILTER & CARI --}}
        <div class="glass-panel p-6 rounded-3xl border border-white/50 shadow-glass">
            <form method="GET" action="{{ route('superadmin.surat-jalan.index') }}"
                class="flex flex-col md:flex-row items-center gap-4">
                <div class="relative w-full md:flex-1">
                    <span
                        class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari Kode, Nopol, atau nama Driver..."
                        class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800" />
                </div>
                <div class="w-full md:w-48">
                    <select name="status"
                        class="w-full py-3 px-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu Verifikasi
                        </option>
                        <option value="terverifikasi" {{ request('status') === 'terverifikasi' ? 'selected' : '' }}>
                            Terverifikasi</option>
                        <option value="dikirim" {{ request('status') === 'dikirim' ? 'selected' : '' }}>Sedang Dikirim
                        </option>
                        <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>
                </div>
                <button type="submit"
                    class="w-full md:w-auto bg-slate-900 text-white hover:bg-slate-800 font-bold px-6 py-3 rounded-2xl transition-all">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'status']))
                    <a href="{{ route('superadmin.surat-jalan.index') }}"
                        class="w-full md:w-auto text-slate-500 hover:text-slate-800 text-center font-bold px-4 py-3">Reset</a>
                @endif
            </form>
        </div>

        {{-- TABEL SURAT JALAN --}}
        <div class="glass-panel overflow-hidden border border-white/50 shadow-glass rounded-3xl">
            <div class="p-6 border-b border-slate-200/50 bg-white/40">
                <h3 class="text-lg font-extrabold text-slate-900">Data Surat Jalan</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-slate-50/80">
                        <tr>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Driver</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">SPBU Tujuan</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">BBM & Volume
                            </th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Nopol</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Tgl Kirim</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider text-center">
                                Status</th>
                            <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider text-right">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white/10">
                        @forelse($suratJalans as $sj)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 font-bold text-slate-900">{{ $sj->kode_surat_jalan }}</td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-950">{{ $sj->driver->name }}</div>
                                    <div class="text-xs text-slate-400">{{ $sj->driver->email }}</div>
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-700">{{ $sj->spbu->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-slate-800">{{ $sj->fuelType->name }}</span>
                                    <div class="text-xs text-slate-500">{{ number_format($sj->volume_liter) }} Liter</div>
                                </td>
                                <td class="px-6 py-4 font-mono text-slate-600 font-semibold">{{ $sj->vehicle_plate }}</td>
                                <td class="px-6 py-4 text-slate-600 font-medium">{{ $sj->tanggal_kirim->format('d M Y') }}</td>
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
                                    @if($sj->status === 'menunggu')
                                        <form method="POST" action="{{ route('superadmin.surat-jalan.cancel', $sj->id) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan Surat Jalan ini?')"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="text-pertamina-red hover:text-red-800 font-bold text-xs flex items-center justify-end gap-1">
                                                <span class="material-symbols-outlined text-[16px]">cancel</span>
                                                <span>Batalkan</span>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-slate-400 font-medium">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-12 text-slate-400 font-medium">Belum ada data Surat Jalan.
                                </td>
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