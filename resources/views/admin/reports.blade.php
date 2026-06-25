@extends('layouts.admin')

@section('title', 'System Reports')

@section('content')
<div class="animate-slide-in">
    <div class="flex flex-col justify-between gap-4 mb-8 md:flex-row md:items-center">
        <div>
            <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">System Reports</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Generate and export fuel distribution logs for your region.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition-colors bg-white border rounded-xl shadow-sm dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-pertamina-red hover:bg-red-50 dark:hover:bg-red-900/10">
                <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
                Print Report
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-6 mb-8 transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
        <div class="flex items-center gap-2 mb-6 font-semibold text-slate-700 dark:text-slate-200">
            <span class="material-symbols-outlined text-pertamina-blue">filter_alt</span>
            <h3>Report Parameters</h3>
        </div>
        <form method="GET" action="" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4 items-end">
            <div class="space-y-2">
                <label class="text-xs font-bold tracking-wider uppercase text-slate-500">Pilih Bulan</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">calendar_today</span>
                    <input name="month" type="month" value="{{ $month }}" class="w-full py-2.5 pl-10 pr-4 text-sm bg-white dark:bg-slate-800 border rounded-xl border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass transition-all" required />
                </div>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-8 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 shadow-glow-blue hover:scale-105">Apply Filter</button>
                <a href="{{ request()->url() }}" class="px-6 py-2.5 text-sm font-semibold transition-colors bg-slate-100 rounded-xl dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 border border-transparent flex items-center justify-center">Reset</a>
            </div>
        </form>
    </div>

    <div class="mb-8 overflow-hidden transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
        <div class="flex items-center justify-between p-6 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Report Preview (Showing {{ $distributions->count() }} records)</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/50">
                        <th class="px-6 py-4 font-bold tracking-wider uppercase text-slate-500 text-xs text-slate-900 dark:text-slate-400">Transaction ID</th>
                        <th class="px-6 py-4 font-bold tracking-wider uppercase text-slate-500 text-xs text-slate-900 dark:text-slate-400">Timestamp</th>
                        <th class="px-6 py-4 font-bold tracking-wider uppercase text-slate-500 text-xs text-slate-900 dark:text-slate-400">QR Code</th>
                        <th class="px-6 py-4 font-bold tracking-wider uppercase text-slate-500 text-xs text-slate-900 dark:text-slate-400">Location</th>
                        <th class="px-6 py-4 font-bold tracking-wider uppercase text-slate-500 text-xs text-slate-900 dark:text-slate-400">Fuel Type</th>
                        <th class="px-6 py-4 font-bold tracking-wider uppercase text-slate-500 text-xs text-right text-slate-900 dark:text-slate-400">Volume (L)</th>
                        <th class="px-6 py-4 font-bold tracking-wider uppercase text-slate-500 text-xs text-slate-900 dark:text-slate-400">Operator</th>
                        <th class="px-6 py-4 font-bold tracking-wider uppercase text-slate-500 text-xs text-slate-900 dark:text-slate-400">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($distributions as $dist)
                        <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                            <td class="px-6 py-4 font-mono text-xs font-bold text-slate-900 dark:text-white">{{ $dist->distribution_code }}</td>
                            <td class="px-6 py-4 text-slate-500">{{ $dist->distributed_at ? $dist->distributed_at->format('d/m/Y H:i:s') : '-' }}</td>
                            <td class="px-6 py-4 font-medium text-pertamina-blue">{{ $dist->qrCode->code ?? '-' }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $dist->spbu->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-pertamina-blue/10 text-pertamina-blue border border-pertamina-blue/20 rounded-full text-[11px] font-bold">
                                    {{ $dist->fuelType->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-right text-slate-900 dark:text-white">{{ number_format($dist->volume_liter, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $dist->operator->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($dist->status === 'selesai')
                                    <span class="font-bold text-pertamina-green">SUCCESS</span>
                                @else
                                    <span class="font-bold text-pertamina-red">FAILED</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-slate-500 font-medium">Belum ada data distribusi untuk bulan terpilih.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($distributions->isNotEmpty())
                    <tfoot>
                        <tr class="font-bold bg-slate-50/50 dark:bg-slate-800/50">
                            <td class="px-6 py-4 text-xs tracking-wider text-right uppercase text-slate-900 dark:text-white" colspan="5">Total Distribution (Preview)</td>
                            <td class="px-6 py-4 text-right text-pertamina-blue">{{ number_format($stats['total_volume'], 0, ',', '.') }} L</td>
                            <td class="px-6 py-4" colspan="2"></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

    <!-- Metrics -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div class="flex items-center gap-4 p-6 transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-pertamina-blue/10 text-pertamina-blue">
                <span class="text-2xl material-symbols-outlined">local_shipping</span>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest uppercase text-slate-500">Total Fleet Scans</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white">{{ number_format($stats['total'], 0, ',', '.') }} <span class="text-sm font-semibold text-slate-500">Scans</span></p>
            </div>
        </div>
        
        <div class="flex items-center gap-4 p-6 transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-pertamina-green/10 text-pertamina-green">
                <span class="text-2xl material-symbols-outlined">oil_barrel</span>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest uppercase text-slate-500">Vol. Distributed</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white">{{ number_format($stats['total_volume'], 0, ',', '.') }} <span class="text-sm font-semibold text-slate-500">L</span></p>
            </div>
        </div>
        
        <div class="flex items-center gap-4 p-6 transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-orange-500/10 text-orange-600">
                <span class="text-2xl material-symbols-outlined">verified_user</span>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest uppercase text-slate-500">Accuracy</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white">100%</p>
            </div>
        </div>
    </div>
</div>
@endsection
