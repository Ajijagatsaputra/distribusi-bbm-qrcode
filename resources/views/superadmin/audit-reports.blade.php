@extends('layouts.superadmin')

@section('title', 'Audit Reports')

@section('content')
<div class="animate-slide-in">
    <div class="flex flex-col justify-between gap-4 mb-8 md:flex-row md:items-center">
        <div>
            <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Audit Reports</h2>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Generate and export fuel distribution audit logs.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition-colors bg-white border rounded-xl shadow-sm dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-pertamina-red hover:bg-red-50 dark:hover:bg-red-900/10">
                <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
                Export to PDF
            </button>
            <button class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-colors shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 shadow-glow-blue hover:scale-105">
                <span class="material-symbols-outlined text-[20px]">table_view</span>
                Export to Excel
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="p-6 mb-8 transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
        <div class="flex items-center gap-2 mb-6 font-semibold text-slate-700 dark:text-slate-200">
            <span class="material-symbols-outlined text-pertamina-blue">filter_alt</span>
            <h3>Report Parameters</h3>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="space-y-2">
                <label class="text-xs font-bold tracking-wider uppercase text-slate-500">Date Range</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">calendar_today</span>
                    <input class="w-full py-2.5 pl-10 pr-4 text-sm bg-white dark:bg-slate-800 border rounded-xl border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass transition-all" readonly="" type="text" value="Jun 01, 2024 - Jun 12, 2024" />
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold tracking-wider uppercase text-slate-500">SPBU / Location</label>
                <select class="w-full px-4 py-2.5 text-sm bg-white dark:bg-slate-800 border rounded-xl border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass transition-all">
                    <option>All Stations</option>
                    <option>SPBU 31.12101 - Jakarta South</option>
                    <option>SPBU 31.12105 - Jakarta West</option>
                    <option>Depot Bekasi Main</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold tracking-wider uppercase text-slate-500">Fuel Type</label>
                <select class="w-full px-4 py-2.5 text-sm bg-white dark:bg-slate-800 border rounded-xl border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass transition-all">
                    <option>All Fuel Types</option>
                    <option>Bio Solar</option>
                    <option>Pertalite</option>
                    <option>Dexlite</option>
                    <option>Pertamax Turbo</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold tracking-wider uppercase text-slate-500">Operator</label>
                <select class="w-full px-4 py-2.5 text-sm bg-white dark:bg-slate-800 border rounded-xl border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass transition-all">
                    <option>All Operators</option>
                    <option>Budi Santoso</option>
                    <option>Siti Aminah</option>
                    <option>Rudi Hermawan</option>
                </select>
            </div>
        </div>
        <div class="flex justify-end pt-6 mt-6 border-t border-slate-200/50 dark:border-slate-800">
            <button class="px-6 py-2.5 mr-3 text-sm font-semibold transition-colors bg-slate-100 rounded-xl dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 border border-transparent">Reset Filters</button>
            <button class="px-8 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 shadow-glow-blue hover:scale-105">Apply Filters</button>
        </div>
    </div>

    <div class="mb-8 overflow-hidden transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
        <div class="flex items-center justify-between p-6 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Report Preview (Showing 250 records)</h3>
            <div class="flex items-center gap-4 text-xs font-medium text-slate-500">
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-pertamina-blue"></span> Bio Solar</span>
                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-pertamina-green"></span> Pertalite</span>
            </div>
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
                    <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-slate-900 dark:text-white">TRX-20240612-001</td>
                        <td class="px-6 py-4 text-slate-500">12/06/2024 14:22:10</td>
                        <td class="px-6 py-4 font-medium text-pertamina-blue">QR-TX-98012</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">SPBU 31.12101</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-pertamina-blue/10 text-pertamina-blue border border-pertamina-blue/20 rounded-full text-[11px] font-bold">Bio Solar</span></td>
                        <td class="px-6 py-4 font-bold text-right text-slate-900 dark:text-white">125.00</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">Budi Santoso</td>
                        <td class="px-6 py-4"><span class="font-bold text-pertamina-green">SUCCESS</span></td>
                    </tr>
                    <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-slate-900 dark:text-white">TRX-20240612-002</td>
                        <td class="px-6 py-4 text-slate-500">12/06/2024 14:15:45</td>
                        <td class="px-6 py-4 font-medium text-pertamina-blue">QR-TX-98015</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">SPBU 31.12105</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-pertamina-green/10 text-pertamina-green border border-pertamina-green/20 rounded-full text-[11px] font-bold">Pertalite</span></td>
                        <td class="px-6 py-4 font-bold text-right text-slate-900 dark:text-white">24.50</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">Siti Aminah</td>
                        <td class="px-6 py-4"><span class="font-bold text-pertamina-green">SUCCESS</span></td>
                    </tr>
                    <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-slate-900 dark:text-white">TRX-20240612-003</td>
                        <td class="px-6 py-4 text-slate-500">12/06/2024 14:10:02</td>
                        <td class="px-6 py-4 font-medium text-pertamina-blue">QR-TX-98018</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">SPBU 31.12101</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300 rounded-full text-[11px] font-bold border border-slate-200/50">Dexlite</span></td>
                        <td class="px-6 py-4 font-bold text-right text-slate-900 dark:text-white">88.25</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">Budi Santoso</td>
                        <td class="px-6 py-4"><span class="font-bold text-pertamina-red">FAILED</span></td>
                    </tr>
                    <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-slate-900 dark:text-white">TRX-20240612-004</td>
                        <td class="px-6 py-4 text-slate-500">12/06/2024 13:58:33</td>
                        <td class="px-6 py-4 font-medium text-pertamina-blue">QR-TX-98020</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">Depot Bekasi Main</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-pertamina-blue/10 text-pertamina-blue border border-pertamina-blue/20 rounded-full text-[11px] font-bold">Bio Solar</span></td>
                        <td class="px-6 py-4 font-bold text-right text-slate-900 dark:text-white">500.00</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">Rudi Hermawan</td>
                        <td class="px-6 py-4"><span class="font-bold text-pertamina-green">SUCCESS</span></td>
                    </tr>
                    <tr class="transition-colors hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-slate-900 dark:text-white">TRX-20240612-005</td>
                        <td class="px-6 py-4 text-slate-500">12/06/2024 13:45:12</td>
                        <td class="px-6 py-4 font-medium text-pertamina-blue">QR-TX-98022</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">SPBU 31.12101</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-pertamina-green/10 text-pertamina-green border border-pertamina-green/20 rounded-full text-[11px] font-bold">Pertalite</span></td>
                        <td class="px-6 py-4 font-bold text-right text-slate-900 dark:text-white">15.00</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">Budi Santoso</td>
                        <td class="px-6 py-4"><span class="font-bold text-pertamina-green">SUCCESS</span></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="font-bold bg-slate-50/50 dark:bg-slate-800/50">
                        <td class="px-6 py-4 text-xs tracking-wider text-right uppercase text-slate-900 dark:text-white" colspan="5">Total Distribution (Preview)</td>
                        <td class="px-6 py-4 text-right text-pertamina-blue">752.75 L</td>
                        <td class="px-6 py-4" colspan="2"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="flex items-center justify-between px-6 py-4 bg-white border-t rounded-b-2xl border-slate-200/50 dark:border-slate-800 dark:bg-slate-900/70">
            <p class="text-xs font-medium text-slate-500">Showing records 1 to 5 of 250 found</p>
            <div class="flex gap-2">
                <button class="px-4 py-2 text-sm font-semibold transition-colors bg-white border rounded-xl dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50" disabled="">Previous</button>
                <button class="px-4 py-2 text-sm font-semibold transition-colors bg-white border rounded-xl dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">Next</button>
            </div>
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
                <p class="text-2xl font-black text-slate-900 dark:text-white">1,248 <span class="text-sm font-semibold text-slate-500">Scans</span></p>
            </div>
        </div>
        
        <div class="flex items-center gap-4 p-6 transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-pertamina-green/10 text-pertamina-green">
                <span class="text-2xl material-symbols-outlined">oil_barrel</span>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest uppercase text-slate-500">Vol. Distributed</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white">45,820.5 <span class="text-sm font-semibold text-slate-500">L</span></p>
            </div>
        </div>
        
        <div class="flex items-center gap-4 p-6 transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-orange-500/10 text-orange-600">
                <span class="text-2xl material-symbols-outlined">verified_user</span>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-widest uppercase text-slate-500">Accuracy</p>
                <p class="text-2xl font-black text-slate-900 dark:text-white">99.2%</p>
            </div>
        </div>
    </div>
</div>
@endsection
