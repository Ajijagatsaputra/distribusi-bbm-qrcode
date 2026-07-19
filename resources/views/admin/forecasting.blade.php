@extends('layouts.admin')

@section('title', 'Peramalan Kebutuhan BBM')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
    <div class="animate-slide-in">

        {{-- ===== HEADER ===== --}}
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="mb-1 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                    Peramalan <span class="text-pertamina-blue">Kebutuhan BBM</span>
                </h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    Prediksi distribusi bulan depan didukung Kecerdasan Buatan (AI) berbasis data historis 6 bulan terakhir
                </p>
            </div>
            <div
                class="flex items-center gap-2 bg-white/70 dark:bg-slate-800/70 border border-slate-200/50 dark:border-slate-700/50 rounded-xl px-4 py-2 text-xs font-semibold text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined text-[18px] text-pertamina-green animate-pulse">auto_awesome</span>
                <span>AI-Powered Forecasting</span>
            </div>
        </div>

        {{-- ===== FILTER PANEL ===== --}}
        <div
            class="mb-8 p-5 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
            <form method="GET" action="" class="grid grid-cols-1 md:grid-cols-3 gap-5 items-end">
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
                        <span class="material-symbols-outlined text-[18px]">search</span>
                        Tampilkan Prediksi
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

        {{-- ===== PREDIKSI HASIL — 3 KARTU UTAMA ===== --}}
        @php
            $isSmaBetter = $smaMape < $slrMape;
            $bestModel = $isSmaBetter ? 'SMA' : 'SLR';
            $bestForecast = $isSmaBetter ? $nextSmaForecast : $nextSlrForecast;
            $bestMape = $isSmaBetter ? $smaMape : $slrMape;
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

            {{-- Kartu: Rekomendasi Terbaik --}}
            <div
                class="md:col-span-1 p-6 rounded-2xl bg-gradient-to-br from-pertamina-blue to-blue-700 shadow-glow-blue text-white relative overflow-hidden">
                <div class="absolute -top-6 -right-6 size-32 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-8 -left-4 size-24 rounded-full bg-white/5"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-[11px] font-bold tracking-widest uppercase opacity-80">Rekomendasi AI</p>
                        <span class="material-symbols-outlined text-[22px] opacity-90">stars</span>
                    </div>
                    <p class="text-xs font-semibold opacity-75 mb-1">Prediksi Kebutuhan — {{ $nextPeriodLabel }}</p>
                    <h2 class="text-4xl font-black leading-none mb-1">
                        {{ number_format($bestForecast / 1000, 1, ',', '.') }}
                        <span class="text-xl font-semibold opacity-80">KL</span>
                    </h2>
                    <p class="text-xs opacity-60 mb-4">≈ {{ number_format($bestForecast, 0, ',', '.') }} Liter</p>
                    <div class="flex items-center gap-2 text-xs font-semibold bg-white/15 rounded-xl px-3 py-1.5 w-fit">
                        <span class="material-symbols-outlined text-[14px]">check_circle</span>
                        Model Terbaik: {{ $bestModel }} (MAPE {{ number_format($bestMape, 2, ',', '.') }}%)
                    </div>
                </div>
            </div>

            {{-- Kartu: Grafik Tren --}}
            <div
                class="md:col-span-2 p-6 bg-white border shadow-glass rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Tren Distribusi & Proyeksi Bulan Depan
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Data aktual 6 bulan terakhir disandingkan hasil prediksi
                        </p>
                    </div>
                    <div class="flex items-center gap-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                        <span class="flex items-center gap-1"><span
                                class="w-4 h-1 bg-slate-400 rounded-full inline-block"></span>Aktual</span>
                        <span class="flex items-center gap-1"><span
                                class="w-4 h-1 bg-pertamina-blue rounded-full inline-block"></span>Prediksi</span>
                    </div>
                </div>
                <div class="relative h-48">
                    <canvas id="forecastChart"></canvas>
                </div>
            </div>
        </div>

        {{-- ===== RINGKASAN CEPAT ===== --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div
                class="p-4 bg-white border rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 shadow-sm">
                <p class="text-[10px] font-bold tracking-widest text-slate-400 uppercase mb-1">SPBU / Filter</p>
                <p class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate">
                    {{ $spbuId ? ($spbus->firstWhere('id', $spbuId)?->name ?? 'SPBU #' . $spbuId) : 'Semua SPBU' }}
                </p>
            </div>
            <div
                class="p-4 bg-white border rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 shadow-sm">
                <p class="text-[10px] font-bold tracking-widest text-slate-400 uppercase mb-1">Jenis BBM</p>
                <p class="text-sm font-bold text-slate-800 dark:text-slate-200 truncate">
                    {{ $fuelTypeId ? ($fuelTypes->firstWhere('id', $fuelTypeId)?->name ?? 'BBM #' . $fuelTypeId) : 'Semua Varian' }}
                </p>
            </div>
            <div
                class="p-4 bg-white border rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 shadow-sm">
                <p class="text-[10px] font-bold tracking-widest text-slate-400 uppercase mb-1">Akurasi Model SMA</p>
                <p
                    class="text-sm font-bold {{ $isSmaBetter ? 'text-pertamina-green' : 'text-slate-800 dark:text-slate-200' }}">
                    {{ number_format(100 - $smaMape, 1, ',', '.') }}%
                    @if($isSmaBetter) <span class="text-[10px]">✓ Terpilih</span> @endif
                </p>
            </div>
            <div
                class="p-4 bg-white border rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 shadow-sm">
                <p class="text-[10px] font-bold tracking-widest text-slate-400 uppercase mb-1">Akurasi Model SLR</p>
                <p
                    class="text-sm font-bold {{ !$isSmaBetter ? 'text-pertamina-green' : 'text-slate-800 dark:text-slate-200' }}">
                    {{ number_format(100 - $slrMape, 1, ',', '.') }}%
                    @if(!$isSmaBetter) <span class="text-[10px]">✓ Terpilih</span> @endif
                </p>
            </div>
        </div>

        {{-- ===== AI ANALYSIS PANEL ===== --}}
        <div
            class="p-6 bg-gradient-to-br from-white to-blue-50/30 border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 dark:from-slate-900 dark:to-slate-950/30">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="flex items-center justify-center rounded-xl size-12 bg-pertamina-blue/10 text-pertamina-blue dark:bg-pertamina-blue/20 shrink-0">
                        <span class="material-symbols-outlined text-[26px]">psychology</span>
                    </div>
                    <div>
                        <h3 class="text-base font-black text-slate-900 dark:text-white">Analisis & Rekomendasi AI</h3>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Interpretasi tren, rekomendasi volume pasokan, dan mitigasi risiko oleh Generative AI
                        </p>
                    </div>
                </div>
                <button id="btn-generate-ai"
                    class="flex items-center justify-center gap-2 px-5 py-2.5 text-xs font-bold text-white transition-all shadow-md rounded-xl bg-gradient-to-r from-slate-900 to-slate-800 hover:from-pertamina-blue hover:to-blue-600 dark:from-slate-700 dark:to-slate-600 hover:scale-[102%] shrink-0">
                    <span class="material-symbols-outlined text-[16px]">auto_awesome</span>
                    Hasilkan Analisis AI
                </button>
            </div>

            <div id="ai-response-container"
                class="p-5 bg-slate-50/60 dark:bg-slate-800/20 border border-slate-200/40 dark:border-slate-800/40 rounded-xl min-h-[120px] text-sm text-slate-600 dark:text-slate-400 transition-all">
                <div class="flex flex-col items-center justify-center py-8 text-center text-slate-400 dark:text-slate-500">
                    <span
                        class="material-symbols-outlined text-[44px] mb-3 text-slate-300 dark:text-slate-700">chat_bubble</span>
                    <p class="text-xs font-medium max-w-xs">
                        Klik <strong class="text-slate-600 dark:text-slate-300">"Hasilkan Analisis AI"</strong> untuk
                        mendapatkan rekomendasi distribusi berbasis kecerdasan buatan.
                    </p>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartData = @json($chartData);
            const isSma = {{ ($smaMape < $slrMape) ? 'true' : 'false' }};
            const bestData = isSma ? chartData.sma : chartData.slr;
            const bestColor = isSma ? '#f97316' : '#005eb8';
            const bestLabel = isSma ? 'Prediksi SMA' : 'Prediksi SLR';

            new Chart(document.getElementById('forecastChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: chartData.labels,
                    datasets: [
                        {
                            label: 'Data Aktual',
                            data: chartData.actual,
                            borderColor: '#94a3b8',
                            backgroundColor: 'rgba(148,163,184,0.08)',
                            borderWidth: 2.5,
                            pointBackgroundColor: '#64748b',
                            pointRadius: 4,
                            tension: 0.2,
                            fill: true
                        },
                        {
                            label: bestLabel,
                            data: bestData,
                            borderColor: bestColor,
                            backgroundColor: 'transparent',
                            borderWidth: 2.5,
                            borderDash: [6, 4],
                            pointBackgroundColor: bestColor,
                            pointRadius: 4,
                            tension: 0.1,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            padding: 10,
                            cornerRadius: 10,
                            bodyFont: { family: 'Outfit' },
                            titleFont: { family: 'Outfit', weight: 'bold' },
                            callbacks: { label: ctx => ` ${Number(ctx.raw).toLocaleString('id-ID')} L` }
                        }
                    },
                    scales: {
                        y: {
                            grid: { color: 'rgba(148,163,184,0.08)' },
                            ticks: { font: { family: 'Outfit', size: 10 }, callback: v => (v / 1000).toFixed(1) + ' KL' }
                        },
                        x: { grid: { display: false }, ticks: { font: { family: 'Outfit', size: 10 } } }
                    }
                }
            });

            const btn = document.getElementById('btn-generate-ai');
            const box = document.getElementById('ai-response-container');

            btn.addEventListener('click', function () {
                btn.disabled = true;
                const orig = btn.innerHTML;
                btn.innerHTML = `<span class="material-symbols-outlined text-[16px] animate-spin">sync</span> Menganalisis...`;
                box.innerHTML = `
                <div class="animate-pulse space-y-3 py-4">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-pertamina-blue animate-spin text-[18px]">sync</span>
                        <span class="text-xs font-semibold text-slate-500">Menghubungi AI Service, mohon tunggu...</span>
                    </div>
                    <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded-full w-11/12"></div>
                    <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded-full w-full"></div>
                    <div class="h-3 bg-slate-200 dark:bg-slate-700 rounded-full w-4/5"></div>
                </div>`;

                fetch('{{ route(auth()->user()->role === "admin_pusat" ? "superadmin.forecasting.ai-analysis" : "admin.forecasting.ai-analysis") }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ spbu_id: '{{ $spbuId }}', fuel_type_id: '{{ $fuelTypeId }}', sma_n: '{{ $smaN }}' })
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success && data.analysis) {
                            box.innerHTML = `
                        <div class="prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 leading-relaxed text-sm">
                            ${formatMarkdown(data.analysis)}
                        </div>
                        <div class="mt-5 pt-3 border-t border-slate-200/50 dark:border-slate-800/50 flex justify-between items-center text-[10px] text-slate-400">
                            <span>Didukung oleh: <span class="font-semibold capitalize text-pertamina-blue">${data.provider}</span></span>
                            <span>Analisis Real-time · ${new Date().toLocaleTimeString('id-ID')}</span>
                        </div>`;
                        } else { throw new Error(data.message || 'Respons tidak valid.'); }
                    })
                    .catch(err => {
                        box.innerHTML = `
                    <div class="flex items-start gap-3 text-pertamina-red py-2">
                        <span class="material-symbols-outlined text-[22px] shrink-0">error</span>
                        <div>
                            <p class="font-bold text-sm">Gagal Menghasilkan Analisis</p>
                            <p class="text-xs mt-0.5 text-slate-500">${err.message || 'Terjadi kesalahan jaringan atau server.'}</p>
                        </div>
                    </div>`;
                    })
                    .finally(() => { btn.disabled = false; btn.innerHTML = orig; });
            });

            function formatMarkdown(text) {
                let h = text.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                h = h.replace(/^### (.*$)/gim, '<h5 class="text-xs font-bold text-slate-900 dark:text-white mt-4 mb-1.5 uppercase tracking-wider">$1</h5>');
                h = h.replace(/^## (.*$)/gim, '<h4 class="text-sm font-bold text-slate-900 dark:text-white mt-5 mb-2 border-b border-slate-100 dark:border-slate-800 pb-1">$1</h4>');
                h = h.replace(/^# (.*$)/gim, '<h3 class="text-base font-black text-pertamina-blue mt-6 mb-2">$1</h3>');
                h = h.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-slate-900 dark:text-white">$1</strong>');
                h = h.replace(/^\s*-\s+(.*$)/gim, '<li class="ml-4 list-disc my-1">$1</li>');
                h = h.replace(/\n/g, '<br>');
                return h;
            }
        });
    </script>
@endpush