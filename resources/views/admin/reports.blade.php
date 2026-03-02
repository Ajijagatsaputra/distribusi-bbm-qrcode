@extends('layouts.admin')

@section('title', 'Reports Management')

@section('content')
    <div class="animate-slide-in">
        <h3 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">System Reports</h3>
        <p class="mt-1 text-base text-slate-500 dark:text-slate-400">Generate and export fuel distribution analytics and operational reports.</p>
    </div>
    
    <div class="p-6 transition-all border shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl animate-slide-in">
        <div class="flex items-center gap-3 mb-6">
            <span class="material-symbols-outlined text-pertamina-blue">filter_list</span>
            <h4 class="font-bold text-slate-900 dark:text-white">Global Report Filters</h4>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div>
                <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Date Range</label>
                <div class="flex items-center gap-2">
                    <input class="w-full text-sm transition-all bg-white border rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass" type="date" />
                    <span class="text-slate-400">to</span>
                    <input class="w-full text-sm transition-all bg-white border rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass" type="date" />
                </div>
            </div>
            <div>
                <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">SPBU Location</label>
                <select class="w-full text-sm transition-all bg-white border rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass">
                    <option value="">All SPBU Locations</option>
                    <option>SPBU 31.114.03 - Jakarta Barat</option>
                    <option>SPBU 34.125.01 - Jakarta Selatan</option>
                    <option>Terminal Pelabuhan Tanjung Priok</option>
                    <option>Industrial Area Cikupa</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="flex items-center justify-center w-full gap-2 px-6 text-sm font-bold text-white transition-all rounded-lg shadow-lg h-11 bg-gradient-to-r from-pertamina-blue to-blue-600 hover:to-blue-500 shadow-glow-blue hover:scale-105">
                    <span class="text-lg material-symbols-outlined">refresh</span>
                    Apply Filters to All
                </button>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
        <div class="overflow-hidden transition-all border group shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl hover:shadow-xl hover:-translate-y-1">
            <div class="p-8">
                <div class="flex items-center justify-center mb-6 text-white transition-transform size-14 bg-gradient-to-br from-pertamina-blue to-blue-600 rounded-2xl group-hover:scale-110 shadow-glow-blue">
                    <span class="text-3xl material-symbols-outlined">summarize</span>
                </div>
                <h4 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Daily Distribution Summary</h4>
                <p class="mb-8 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                    Detailed overview of all fuel distributions completed within the selected period, including truck IDs, volumes, and timestamps.
                </p>
                <div class="flex flex-wrap gap-3">
                    <button class="flex items-center justify-center flex-1 gap-2 text-sm font-bold text-white transition-all rounded-lg shadow-md h-11 bg-pertamina-blue hover:bg-blue-700 shadow-pertamina-blue/30 hover:-translate-y-0.5">
                        <span class="text-lg material-symbols-outlined">analytics</span> Generate
                    </button>
                    <button class="flex items-center justify-center gap-2 px-5 text-sm font-bold transition-all border rounded-lg h-11 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-800 bg-white/50">
                        <span class="text-lg material-symbols-outlined">picture_as_pdf</span> Download PDF
                    </button>
                </div>
            </div>
        </div>
        
        <div class="overflow-hidden transition-all border group shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl hover:shadow-xl hover:-translate-y-1">
            <div class="p-8">
                <div class="flex items-center justify-center mb-6 text-white transition-transform size-14 bg-gradient-to-br from-pertamina-green to-green-600 rounded-2xl group-hover:scale-110 shadow-glow-green">
                    <span class="text-3xl material-symbols-outlined">oil_barrel</span>
                </div>
                <h4 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Fuel Type Volume Report</h4>
                <p class="mb-8 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                    Categorized analysis of distributed volumes by fuel type (Pertalite, Pertamax, Solar Dex) to monitor inventory consumption.
                </p>
                <div class="flex flex-wrap gap-3">
                    <button class="flex items-center justify-center flex-1 gap-2 text-sm font-bold text-white transition-all rounded-lg shadow-md h-11 bg-pertamina-blue hover:bg-blue-700 shadow-pertamina-blue/30 hover:-translate-y-0.5">
                        <span class="text-lg material-symbols-outlined">analytics</span> Generate
                    </button>
                    <button class="flex items-center justify-center gap-2 px-5 text-sm font-bold transition-all border rounded-lg h-11 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-800 bg-white/50">
                        <span class="text-lg material-symbols-outlined">picture_as_pdf</span> Download PDF
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-hidden transition-all border group shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl hover:shadow-xl hover:-translate-y-1">
            <div class="p-8">
                <div class="flex items-center justify-center mb-6 text-white transition-transform shadow-lg size-14 bg-gradient-to-br from-orange-500 to-amber-600 rounded-2xl group-hover:scale-110 shadow-orange-500/30">
                    <span class="text-3xl material-symbols-outlined">badge</span>
                </div>
                <h4 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Operator Performance</h4>
                <p class="mb-8 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                    Efficiency metrics for logistics operators and drivers, tracking delivery times, incident records, and task completion rates.
                </p>
                <div class="flex flex-wrap gap-3">
                    <button class="flex items-center justify-center flex-1 gap-2 text-sm font-bold text-white transition-all rounded-lg shadow-md h-11 bg-pertamina-blue hover:bg-blue-700 shadow-pertamina-blue/30 hover:-translate-y-0.5">
                        <span class="text-lg material-symbols-outlined">analytics</span> Generate
                    </button>
                    <button class="flex items-center justify-center gap-2 px-5 text-sm font-bold transition-all border rounded-lg h-11 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-800 bg-white/50">
                        <span class="text-lg material-symbols-outlined">picture_as_pdf</span> Download PDF
                    </button>
                </div>
            </div>
        </div>

        <div class="overflow-hidden transition-all border group shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl hover:shadow-xl hover:-translate-y-1">
            <div class="p-8">
                <div class="flex items-center justify-center mb-6 text-white transition-transform shadow-lg size-14 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl group-hover:scale-110 shadow-indigo-500/30">
                    <span class="text-3xl material-symbols-outlined">map</span>
                </div>
                <h4 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Destination-wise Analysis</h4>
                <p class="mb-8 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                    Geographical breakdown of distribution volume across different SPBU locations and industrial hubs for demand forecasting.
                </p>
                <div class="flex flex-wrap gap-3">
                    <button class="flex items-center justify-center flex-1 gap-2 text-sm font-bold text-white transition-all rounded-lg shadow-md h-11 bg-pertamina-blue hover:bg-blue-700 shadow-pertamina-blue/30 hover:-translate-y-0.5">
                        <span class="text-lg material-symbols-outlined">analytics</span> Generate
                    </button>
                    <button class="flex items-center justify-center gap-2 px-5 text-sm font-bold transition-all border rounded-lg h-11 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-800 bg-white/50">
                        <span class="text-lg material-symbols-outlined">picture_as_pdf</span> Download PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="flex justify-between py-6 mt-6 border-t border-slate-200/50 flex-col md:flex-row md:items-center">
        <div class="flex items-center gap-4 text-slate-500 dark:text-slate-400 mb-4 md:mb-0">
            <span class="material-symbols-outlined">history</span>
            <span class="text-sm">Last report generated: <strong class="text-slate-800 dark:text-slate-200">Today, 09:42 AM</strong> (Daily Summary)</span>
        </div>
        <button class="text-sm font-bold transition-colors text-pertamina-blue hover:text-blue-700 hover:underline">View All Export History</button>
    </div>
@endsection
