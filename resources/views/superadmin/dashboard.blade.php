@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')

@section('content')
    <div class="space-y-8">

        {{-- RINGKASAN UTAMA DISTRIBUSI BBM --}}
        <div class="flex flex-col gap-2 mb-8">
            <h2 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                Ringkasan <span class="gradient-text">Distribusi BBM</span>
            </h2>
            <p class="text-base font-medium text-slate-500 dark:text-slate-400">
                Monitoring distribusi BBM berbasis QR Code secara realtime
            </p>
        </div>

        {{-- STATISTIK --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 mb-10">
            <x-superadmin.stat-card title="Total SPBU Terdaftar" value="{{ number_format($totalSpbu, 0, ',', '.') }}"
                icon="local_gas_station" color="pertamina-blue" />

            <x-superadmin.stat-card title="Distribusi Hari Ini" value="{{ number_format($todayVolumeKl, 1, ',', '.') }} KL"
                icon="local_shipping" color="pertamina-green" />

            <x-superadmin.stat-card title="QR Aktif" value="{{ number_format($activeQr, 0, ',', '.') }}" icon="qr_code"
                color="orange" />
        </div>

        {{-- AKTIVITAS DISTRIBUSI TERBARU --}}
        <div class="glass-panel overflow-hidden border border-white/50 shadow-glass rounded-3xl">
            <div class="p-6 border-b border-slate-200/50 bg-white/40">
                <h3 class="text-lg font-extrabold text-slate-900">
                    Aktivitas Distribusi Terbaru
                </h3>
                <p class="text-sm font-medium text-slate-500">
                    Data distribusi BBM berdasarkan pemindaian QR Code dan input manual
                </p>
            </div>

            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-slate-50/80">
                    <tr>
                        <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">SPBU</th>
                        <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Jenis BBM</th>
                        <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Status QR</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200/50 bg-white/40">
                    @forelse($recentDistributions as $dist)
                        <tr class="hover:bg-white/80 transition-colors">
                            <td class="px-6 py-5 font-bold text-slate-900">{{ $dist->spbu->name }}</td>
                            <td class="px-6 py-5 font-semibold text-slate-700">{{ $dist->fuelType->name }}</td>
                            <td class="px-6 py-5 font-extrabold text-slate-900">
                                {{ number_format($dist->volume_liter, 0, ',', '.') }} Liter</td>
                            <td class="px-6 py-5 text-slate-500">{{ $dist->distributed_at->format('d M Y') }}</td>
                            <td class="px-6 py-5">
                                @if($dist->qrCode)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pertamina-green/10 text-pertamina-green text-xs font-bold border border-pertamina-green/20">
                                        Valid (QR)
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">
                                        Manual
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500 font-medium">
                                Belum ada aktivitas distribusi hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection