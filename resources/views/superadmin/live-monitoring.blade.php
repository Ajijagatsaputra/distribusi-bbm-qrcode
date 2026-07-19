@extends('layouts.superadmin')

@section('title', 'Global Live Monitoring')

{{-- Leaflet CSS --}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        #monitoring-map {
            height: 420px;
            width: 100%;
            border-radius: 0 0 0.5rem 0.5rem;
            z-index: 1;
        }

        .leaflet-popup-content-wrapper {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            font-family: inherit;
        }

        .map-popup-title {
            font-weight: 700;
            font-size: 13px;
            color: #0f3460;
            margin-bottom: 4px;
        }

        .map-popup-row {
            font-size: 11px;
            color: #555;
            margin: 2px 0;
        }

        .map-popup-vol {
            font-weight: 700;
            color: #195de6;
        }

        #feed-container {
            max-height: 420px;
            overflow-y: auto;
        }

        .feed-item {
            opacity: 0;
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: none;
            }
        }

        .pulse-dot {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }
        }
    </style>
@endpush

@section('content')
    <div class="animate-slide-in">

        {{-- HEADER --}}
        <div class="flex flex-col flex-wrap items-center justify-between gap-4 mb-8 md:flex-row">
            <div>
                <h3 class="flex items-center gap-3 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                    <span class="relative flex h-4 w-4 mr-1">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pertamina-red opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-pertamina-red"></span>
                    </span>
                    Live <span class="text-pertamina-blue">Monitoring</span>
                </h3>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                    Pemantauan armada dan distribusi BBM di seluruh wilayah secara real-time
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span id="polling-status"
                    class="flex items-center gap-1.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                    <span class="pulse-dot size-2 rounded-full bg-emerald-500 inline-block"></span>
                    Live
                </span>
                <span
                    class="px-3 py-1.5 text-xs font-bold bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-sm">
                    Update: <span id="last-update" class="text-pertamina-blue">--:--:--</span>
                </span>
            </div>
        </div>

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 mb-6">
            <div
                class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
                <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">Transaksi Hari Ini</p>
                <h4 id="stat-today" class="text-2xl font-black text-pertamina-blue">{{ $stats['total_today'] ?? 0 }}</h4>
                <p class="text-[10px] text-slate-400 mt-1">Selesai hari ini</p>
            </div>
            <div
                class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
                <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">Total Volume Salur</p>
                <h4 class="text-2xl font-black text-slate-900 dark:text-white">
                    <span id="stat-volume">{{ number_format(($stats['total_volume'] ?? 0) / 1000, 1, ',', '.') }}</span>
                    <span class="text-sm">KL</span>
                </h4>
                <p class="text-[10px] text-slate-400 mt-1">Total volume disalurkan</p>
            </div>
            <div
                class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
                <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">QR Code Aktif</p>
                <h4 id="stat-qr" class="text-2xl font-black text-orange-500">{{ $stats['active_qr'] ?? 0 }}</h4>
                <p class="text-[10px] text-slate-400 mt-1">Menunggu pemindaian</p>
            </div>
            <div
                class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
                <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">SPBU Terkoneksi</p>
                <h4 id="stat-spbu" class="text-2xl font-black text-pertamina-green">{{ $stats['active_spbu'] ?? 0 }}</h4>
                <p class="text-[10px] text-slate-400 mt-1">Aktif di sistem</p>
            </div>
        </div>

        {{-- MAIN GRID: MAP + FEED --}}
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            {{-- PETA LEAFLET (2/3) --}}
            <div
                class="flex flex-col overflow-hidden bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 lg:col-span-2">
                <div
                    class="flex items-center justify-between p-4 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">
                        <span class="material-symbols-outlined text-[18px] mr-1 align-bottom text-pertamina-blue">map</span>
                        Peta Persebaran SPBU
                    </h4>
                    <div class="flex gap-3">
                        <span class="flex items-center gap-1 text-[10px] font-bold uppercase text-slate-500">
                            <span class="size-2.5 bg-pertamina-blue rounded-full inline-block"></span>
                            SPBU Aktif
                        </span>
                        <span class="flex items-center gap-1 text-[10px] font-bold uppercase text-slate-500">
                            <span class="size-2.5 bg-emerald-500 rounded-full inline-block"></span>
                            Ada distribusi hari ini
                        </span>
                    </div>
                </div>
                {{-- Map container --}}
                <div id="monitoring-map"></div>
                {{-- Fallback jika tidak ada SPBU berkoordinat --}}
                <div id="map-no-coords" class="hidden p-6 text-center text-sm text-slate-400">
                    <span class="material-symbols-outlined text-3xl block mb-2">location_off</span>
                    Belum ada SPBU dengan data koordinat. Tambahkan latitude & longitude pada Master Data SPBU.
                </div>
            </div>

            {{-- ACTIVITY FEED (1/3) --}}
            <div
                class="flex flex-col overflow-hidden bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div
                    class="p-4 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 flex items-center justify-between">
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">
                        <span
                            class="material-symbols-outlined text-[18px] mr-1 align-bottom text-pertamina-blue">rss_feed</span>
                        Live Activity Feed
                    </h4>
                    <span class="text-[10px] text-slate-400">Auto-refresh 15s</span>
                </div>
                <div id="feed-container" class="flex-1 p-4 overflow-y-auto">
                    <div class="relative pl-4 space-y-5 border-l-2 border-slate-100 dark:border-slate-700" id="feed-list">
                        @forelse($recentDistributions as $dist)
                            <div class="relative feed-item">
                                <div class="absolute -left-[21px] p-1 bg-white dark:bg-slate-900 rounded-full">
                                    <span
                                        class="flex block size-2.5 rounded-full
                                            {{ $dist->status === 'selesai' ? 'bg-pertamina-green' : ($dist->status === 'pending' ? 'bg-orange-400' : 'bg-slate-400') }}">
                                    </span>
                                </div>
                                <p class="text-xs font-bold text-slate-800 dark:text-slate-200">
                                    QR Validated: {{ $dist->distribution_code }}
                                </p>
                                <p class="text-[11px] text-slate-500 mt-0.5">
                                    {{ $dist->spbu->name ?? 'SPBU' }} •
                                    {{ number_format($dist->volume_liter, 0, ',', '.') }}L {{ $dist->fuelType->name ?? 'BBM' }}
                                </p>
                                <p class="text-[10px] font-semibold text-slate-400 mt-1">
                                    {{ $dist->distributed_at->diffForHumans() }}
                                </p>
                            </div>
                        @empty
                            <div class="text-xs text-slate-400 font-medium py-4 text-center" id="feed-empty">
                                Belum ada aktivitas distribusi terbaru.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV/XN/WPeE=" crossorigin=""></script>
    <script>
        // ─── DATA AWAL dari server (untuk render pertama tanpa delay) ──────────────
        const initialSpbus = @json($spbus ?? []);
        const POLLING_URL = "{{ route('superadmin.live-monitoring.data') }}";
        const POLL_INTERVAL = 15000; // 15 detik

        // ─── INISIALISASI PETA ───────────────────────────────────────────────────────
        let map = null;
        let markerGroup = null;

        function initMap(spbus) {
            const hasCoords = spbus.length > 0;
            document.getElementById('map-no-coords').classList.toggle('hidden', hasCoords);
            document.getElementById('monitoring-map').classList.toggle('hidden', !hasCoords);

            if (!hasCoords) return;

            if (!map) {
                // Tentukan center awal dari rata-rata koordinat SPBU
                const avgLat = spbus.reduce((s, sp) => s + sp.latitude, 0) / spbus.length;
                const avgLng = spbus.reduce((s, sp) => s + sp.longitude, 0) / spbus.length;

                map = L.map('monitoring-map', { zoomControl: true, scrollWheelZoom: true })
                    .setView([avgLat || -6.2, avgLng || 106.8], 12);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    maxZoom: 18,
                }).addTo(map);

                markerGroup = L.layerGroup().addTo(map);
            }

            updateMarkers(spbus);
        }

        function buildIcon(hasActivity) {
            const color = hasActivity ? '#10b981' : '#195de6';
            const border = hasActivity ? '#059669' : '#0f3460';
            const svg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 42" width="32" height="42">
            <ellipse cx="16" cy="40" rx="7" ry="2.5" fill="rgba(0,0,0,0.15)"/>
            <path d="M16 0C9.37 0 4 5.37 4 12c0 9 12 28 12 28S28 21 28 12C28 5.37 22.63 0 16 0z"
                  fill="${color}" stroke="${border}" stroke-width="1.5"/>
            <circle cx="16" cy="12" r="6" fill="white" opacity="0.9"/>
            <circle cx="16" cy="12" r="3.5" fill="${color}"/>
        </svg>`;
            return L.divIcon({
                html: svg,
                className: '',
                iconSize: [32, 42],
                iconAnchor: [16, 42],
                popupAnchor: [0, -44],
            });
        }

        function updateMarkers(spbus) {
            if (!markerGroup) return;
            markerGroup.clearLayers();

            spbus.forEach(sp => {
                const hasActivity = sp.today_vol > 0;
                const icon = buildIcon(hasActivity);
                const marker = L.marker([sp.latitude, sp.longitude], { icon });

                const volFormatted = sp.today_vol
                    ? Number(sp.today_vol).toLocaleString('id-ID') + ' L'
                    : '—';

                marker.bindPopup(`
                <div style="min-width:170px">
                    <p class="map-popup-title">⛽ ${sp.name}</p>
                    <p class="map-popup-row">Kode: <strong>${sp.code}</strong></p>
                    <p class="map-popup-row">Kota: ${sp.city ?? '—'}</p>
                    <hr style="margin:6px 0; border-color:#eee">
                    <p class="map-popup-row">Volume hari ini: <span class="map-popup-vol">${volFormatted}</span></p>
                    <p class="map-popup-row">Distribusi terakhir: ${sp.last_dist}</p>
                </div>
            `);

                markerGroup.addLayer(marker);
            });
        }

        // ─── RENDER FEED ────────────────────────────────────────────────────────────
        function renderFeed(items) {
            const list = document.getElementById('feed-list');
            if (!items || items.length === 0) {
                list.innerHTML = `<div class="text-xs text-slate-400 font-medium py-4 text-center">Belum ada aktivitas distribusi terbaru.</div>`;
                return;
            }

            list.innerHTML = items.map((d, i) => {
                const dotColor = d.status === 'selesai'
                    ? '#10b981'
                    : d.status === 'pending' ? '#fb923c' : '#94a3b8';
                const vol = Number(d.volume_liter).toLocaleString('id-ID');
                return `
            <div class="relative feed-item" style="animation-delay:${i * 40}ms">
                <div class="absolute -left-[21px] p-1 bg-white rounded-full">
                    <span class="flex block size-2.5 rounded-full" style="background:${dotColor}"></span>
                </div>
                <p class="text-xs font-bold text-slate-800">QR Validated: ${d.distribution_code}</p>
                <p class="text-[11px] text-slate-500 mt-0.5">${d.spbu_name} • ${vol}L ${d.fuel_name}</p>
                <p class="text-[10px] font-semibold text-slate-400 mt-1">${d.distributed_at ?? '—'}</p>
            </div>`;
            }).join('');
        }

        // ─── UPDATE STATS CARDS ───────────────────────────────────────────────────────
        function updateStats(stats) {
            document.getElementById('stat-today').textContent = stats.total_today ?? 0;
            const volKl = ((stats.total_volume ?? 0) / 1000).toLocaleString('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 });
            document.getElementById('stat-volume').textContent = volKl;
            document.getElementById('stat-qr').textContent = stats.active_qr ?? 0;
            document.getElementById('stat-spbu').textContent = stats.active_spbu ?? 0;
        }

        // ─── POLLING ─────────────────────────────────────────────────────────────────
        async function pollData() {
            try {
                const res = await fetch(POLLING_URL, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } });
                if (!res.ok) throw new Error('HTTP ' + res.status);
                const data = await res.json();

                updateStats(data.stats);
                renderFeed(data.recent_distributions);
                updateMarkers(data.spbus);
                document.getElementById('last-update').textContent = data.timestamp;
                document.getElementById('polling-status').innerHTML =
                    `<span class="pulse-dot size-2 rounded-full bg-emerald-500 inline-block"></span> Live`;
            } catch (e) {
                console.error('Polling error:', e);
                document.getElementById('polling-status').innerHTML =
                    `<span class="size-2 rounded-full bg-red-400 inline-block"></span> Reconnecting...`;
            }
        }

        // ─── INIT ─────────────────────────────────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', () => {
            initMap(initialSpbus);
            pollData();                               // fetch langsung saat pertama load
            setInterval(pollData, POLL_INTERVAL);     // lalu tiap 15 detik
        });
    </script>
@endpush