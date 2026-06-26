@extends('layouts.admin')

@section('title', 'Peramalan Kebutuhan BBM')

@section('content')
    <div class="animate-slide-in">

        {{-- ===== HEADER SECTION ===== --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="mb-2 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                    Peramalan <span class="text-pertamina-blue">Kebutuhan BBM</span>
                </h1>
                <p class="text-sm text-slate-600 dark:text-slate-400">
                    Modul Analitik & Prediksi Distribusi BBM Menggunakan Algoritma SMA (Single Moving Average) & SLR (Simple
                    Linear Regression)
                </p>
            </div>
            <div
                class="flex items-center gap-2 bg-white/70 dark:bg-slate-800/70 border border-slate-200/50 dark:border-slate-700/50 rounded-xl px-4 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined text-[18px] text-pertamina-green animate-pulse">analytics</span>
                <span>Evaluasi Akurasi via MAPE</span>
            </div>
        </div>

        {{-- ===== FILTER PANEL ===== --}}
        <div
            class="mb-8 p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
            <form method="GET" action="" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                <div>
                    <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-slate-500">Stasiun SPBU</label>
                    <select name="spbu_id"
                        class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20">
                        <option value="">-- Semua SPBU --</option>
                        @foreach($spbus as $sp)
                            <option value="{{ $sp->id }}" {{ $spbuId == $sp->id ? 'selected' : '' }}>
                                {{ $sp->code }} - {{ $sp->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-xs font-bold uppercase tracking-wider text-slate-500">Varian BBM</label>
                    <select name="fuel_type_id"
                        class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20">
                        <option value="">-- Semua BBM --</option>
                        @foreach($fuelTypes as $ft)
                            <option value="{{ $ft->id }}" {{ $fuelTypeId == $ft->id ? 'selected' : '' }}>
                                {{ $ft->name }} ({{ $ft->code }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:scale-105 shadow-glow-blue">
                        <span class="material-symbols-outlined text-[18px]">filter_alt</span>
                        Terapkan Filter
                    </button>
                    @if($spbuId || $fuelTypeId)
                        <a href="{{ request()->url() }}"
                            class="flex items-center justify-center p-2.5 text-slate-500 hover:text-pertamina-red hover:bg-slate-100 dark:hover:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl transition-all"
                            title="Reset Filter">
                            <span class="material-symbols-outlined">restart_alt</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- ===== METRIC CARDS ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- SMA CARD --}}
            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Prediksi SMA (N=3) -
                        {{ $nextPeriodLabel }}</p>
                    <div class="flex items-center justify-center rounded-lg size-10 bg-orange-500/10">
                        <span class="text-xl text-orange-500 material-symbols-outlined">timeline</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white">
                    {{ number_format($nextSmaForecast, 0, ',', '.') }} <span
                        class="text-sm font-medium text-slate-500">Liter</span>
                </h4>
                <div class="flex items-center mt-3 text-xs">
                    <span class="font-bold text-orange-500 mr-1">MAPE: {{ number_format($smaMape, 2, ',', '.') }}%</span>
                    <span class="text-slate-400">uji historis</span>
                </div>
            </div>

            {{-- SLR CARD --}}
            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Prediksi SLR -
                        {{ $nextPeriodLabel }}</p>
                    <div class="flex items-center justify-center rounded-lg size-10 bg-pertamina-blue/10">
                        <span class="text-xl text-pertamina-blue material-symbols-outlined">trending_up</span>
                    </div>
                </div>
                <h4 class="text-3xl font-black text-slate-900 dark:text-white">
                    {{ number_format($nextSlrForecast, 0, ',', '.') }} <span
                        class="text-sm font-medium text-slate-500">Liter</span>
                </h4>
                <div class="flex items-center mt-3 text-xs">
                    <span class="font-bold text-pertamina-blue mr-1">MAPE:
                        {{ number_format($slrMape, 2, ',', '.') }}%</span>
                    <span class="text-slate-400">uji historis</span>
                </div>
            </div>

            {{-- REKOMENDASI MODEL --}}
            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                @php
                    $isSmaBetter = $smaMape < $slrMape;
                    $betterModelName = $isSmaBetter ? 'Moving Average (SMA)' : 'Linear Regression (SLR)';
                    $betterMape = $isSmaBetter ? $smaMape : $slrMape;
                    $betterForecast = $isSmaBetter ? $nextSmaForecast : $nextSlrForecast;
                @endphp
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Model Rekomendasi (Akurasi
                        Terbaik)</p>
                    <div class="flex items-center justify-center rounded-lg size-10 bg-pertamina-green/10">
                        <span class="text-xl text-pertamina-green material-symbols-outlined">stars</span>
                    </div>
                </div>
                <h4 class="text-lg font-bold text-slate-900 dark:text-white truncate">
                    {{ $betterModelName }}
                </h4>
                <p class="text-xs text-slate-500 mt-1">
                    Volume Rekomendasi: <span
                        class="font-bold text-slate-800 dark:text-slate-200">{{ number_format($betterForecast, 0, ',', '.') }}
                        L</span>
                </p>
                <div class="flex items-center mt-3 text-xs text-pertamina-green">
                    <span class="material-symbols-outlined text-[14px] mr-1">check_circle</span>
                    <span class="font-bold">Error Terkecil (MAPE: {{ number_format($betterMape, 2, ',', '.') }}%)</span>
                </div>
            </div>
        </div>

        {{-- ===== GRAPH SECTION ===== --}}
        <div class="grid grid-cols-1 gap-6 mb-8">
            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">Tren Distribusi & Proyeksi Bulan
                            Depan</h3>
                        <p class="text-xs text-slate-500">Visualisasi data aktual disandingkan dengan kurva prediksi</p>
                    </div>
                    <div class="flex items-center gap-4 text-xs font-semibold">
                        <span class="inline-flex items-center gap-1"><span
                                class="w-3 h-1 bg-slate-400 rounded-full inline-block"></span> Aktual</span>
                        <span class="inline-flex items-center gap-1"><span
                                class="w-3 h-1 bg-orange-500 rounded-full inline-block"></span> SMA</span>
                        <span class="inline-flex items-center gap-1"><span
                                class="w-3 h-1 bg-pertamina-blue rounded-full inline-block"></span> SLR</span>
                    </div>
                </div>
                <div class="relative h-96 w-full">
                    <canvas id="forecastingChart"></canvas>
                </div>
            </div>
        </div>

        {{-- ===== TABEL PERHITUNGAN DETAIL ===== --}}
        <div class="grid grid-cols-1 gap-6">
            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2">Tabel Simulasi & Uji Akurasi Historis
                </h3>
                <p class="text-xs text-slate-500 mb-6">Breakdown perbandingan nilai aktual, prediksi, dan persentase error
                    model analitik</p>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                            <tr>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                    Periode</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800 text-right">
                                    Data Aktual (Y)</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800 text-right">
                                    SMA Forecast</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800 text-right">
                                    SMA Error (%)</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800 text-right">
                                    SLR Forecast</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800 text-right">
                                    SLR Error (%)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @foreach($tableData as $data)
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-5 py-4 font-semibold text-slate-700 dark:text-slate-300">{{ $data['period'] }}
                                    </td>
                                    <td class="px-5 py-4 text-right font-mono font-bold text-slate-900 dark:text-white">
                                        {{ number_format($data['actual'], 0, ',', '.') }} L</td>
                                    <td class="px-5 py-4 text-right font-mono text-orange-600 dark:text-orange-400">
                                        {{ $data['sma'] ? number_format($data['sma'], 0, ',', '.') . ' L' : '-' }}
                                    </td>
                                    <td class="px-5 py-4 text-right font-mono text-xs">
                                        @if($data['sma_err'] !== null)
                                            <span
                                                class="px-2 py-0.5 rounded-full font-bold bg-orange-500/10 text-orange-600 dark:text-orange-400">
                                                {{ number_format($data['sma_err'], 2, ',', '.') }}%
                                            </span>
                                        @else
                                            <span class="text-slate-400 font-medium">N/A (t<4)< /span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-right font-mono text-pertamina-blue">
                                        {{ number_format($data['slr'], 0, ',', '.') }} L
                                    </td>
                                    <td class="px-5 py-4 text-right font-mono text-xs">
                                        <span
                                            class="px-2 py-0.5 rounded-full font-bold bg-pertamina-blue/10 text-pertamina-blue">
                                            {{ number_format($data['slr_err'], 2, ',', '.') }}%
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- FORECAST LINE -->
                            <tr class="bg-pertamina-blue/5 border-t-2 border-pertamina-blue/20">
                                <td class="px-5 py-4 font-bold text-pertamina-blue flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-[18px]">online_prediction</span>
                                    {{ $nextPeriodLabel }} (Forecast)
                                </td>
                                <td class="px-5 py-4 text-right text-slate-400 font-medium italic">Bulan Depan</td>
                                <td class="px-5 py-4 text-right font-mono font-bold text-orange-600 dark:text-orange-400">
                                    {{ number_format($nextSmaForecast, 0, ',', '.') }} L
                                </td>
                                <td class="px-5 py-4 text-right font-semibold text-slate-500 text-xs">Model SMA</td>
                                <td class="px-5 py-4 text-right font-mono font-bold text-pertamina-blue">
                                    {{ number_format($nextSlrForecast, 0, ',', '.') }} L
                                </td>
                                <td class="px-5 py-4 text-right font-semibold text-slate-500 text-xs">Model SLR</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- MATH EXPLANATION FOR THESIS PANEL --}}
                <div
                    class="mt-8 p-6 bg-slate-50 dark:bg-slate-800/40 rounded-2xl border border-slate-200/50 dark:border-slate-700/50">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-pertamina-blue">functions</span>
                        <h4 class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">Metodologi &
                            Perhitungan Rumus (Skripsi Helper)</h4>
                    </div>
                    <div
                        class="grid grid-cols-1 md:grid-cols-2 gap-8 text-xs leading-relaxed text-slate-600 dark:text-slate-400">
                        <div>
                            <h5 class="font-bold text-slate-800 dark:text-slate-200 mb-2">1. Single Moving Average (SMA -
                                N=3)</h5>
                            <p class="mb-3">Memprediksi nilai periode berikutnya berdasarkan rata-rata $N$ periode
                                sebelumnya:</p>
                            <div
                                class="bg-white dark:bg-slate-800 p-3 rounded-lg border dark:border-slate-750 font-mono text-[11px] mb-3 text-center">
                                F<sub>t+1</sub> = ( Y<sub>t</sub> + Y<sub>t-1</sub> + Y<sub>t-2</sub> ) / 3
                            </div>
                            <p>Untuk periode <span
                                    class="font-bold text-slate-800 dark:text-slate-300">{{ $nextPeriodLabel }}</span>:</p>
                            <p class="font-mono text-[11px] text-orange-600 dark:text-orange-400 mt-1">
                                F = ({{ number_format($tableData[5]['actual'], 0, ',', '.') }} +
                                {{ number_format($tableData[4]['actual'], 0, ',', '.') }} +
                                {{ number_format($tableData[3]['actual'], 0, ',', '.') }}) / 3 =
                                <strong>{{ number_format($nextSmaForecast, 0, ',', '.') }} L</strong>
                            </p>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-800 dark:text-slate-200 mb-2">2. Simple Linear Regression (SLR)
                            </h5>
                            <p class="mb-3">Menghitung hubungan linier antara waktu (X) dan volume (Y) dengan persamaan
                                garis:</p>
                            <div
                                class="bg-white dark:bg-slate-800 p-3 rounded-lg border dark:border-slate-750 font-mono text-[11px] mb-3 text-center">
                                Y' = aX + b
                            </div>
                            <p class="mb-1">Berdasarkan data historis, diperoleh konstanta persamaan:</p>
                            <ul class="list-disc pl-4 space-y-1 mb-2 font-mono text-[11px]">
                                <li>Kemiringan/Slope (a) = {{ number_format($slope, 2, ',', '.') }}</li>
                                <li>Konstanta/Intercept (b) = {{ number_format($intercept, 2, ',', '.') }}</li>
                            </ul>
                            <p>Proyeksi periode ke-7 (<span class="font-bold text-slate-800 dark:text-slate-300">X =
                                    7</span>):</p>
                            <p class="font-mono text-[11px] text-pertamina-blue mt-1">
                                Y' = ({{ number_format($slope, 2, ',', '.') }} &times; 7) +
                                {{ number_format($intercept, 2, ',', '.') }} =
                                <strong>{{ number_format($nextSlrForecast, 0, ',', '.') }} L</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('forecastingChart').getContext('2d');

            const chartData = @json($chartData);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                            label: 'Data Aktual (Y)',
                            data: chartData.actual,
                            borderColor: '#94a3b8',
                            backgroundColor: 'rgba(148, 163, 184, 0.1)',
                            borderWidth: 3,
                            pointBackgroundColor: '#64748b',
                            pointRadius: 6,
                            tension: 0.15,
                            fill: true
                        },
                        {
                            label: 'Single Moving Average (SMA)',
                            data: chartData.sma,
                            borderColor: '#f97316',
                            borderWidth: 2.5,
                            borderDash: [5, 5],
                            pointBackgroundColor: '#ea580c',
                            pointRadius: 5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: 'Simple Linear Regression (SLR)',
                            data: chartData.slr,
                            borderColor: '#005eb8',
                            borderWidth: 2.5,
                            borderDash: [8, 4],
                            pointBackgroundColor: '#004b93',
                            pointRadius: 5,
                            tension: 0.05,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            padding: 12,
                            cornerRadius: 12,
                            bodyFont: {
                                family: 'Outfit'
                            },
                            titleFont: {
                                family: 'Outfit',
                                weight: 'bold'
                            }
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                color: 'rgba(148, 163, 184, 0.1)'
                            },
                            ticks: {
                                font: {
                                    family: 'Outfit'
                                },
                                callback: function (value) {
                                    return (value / 1000) + ' KL';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: 'Outfit'
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection