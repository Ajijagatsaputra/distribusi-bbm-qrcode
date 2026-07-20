@extends('layouts.superadmin')

@section('title', 'Global Live Monitoring')

@php
    // Precompute feed items di PHP dulu agar @json() tidak perlu inline closure
    $feedItemsData = $recentDistributions->map(fn($d) => [
        'distribution_code' => $d->distribution_code,
        'spbu_name'         => $d->spbu->name ?? '-',
        'fuel_name'         => $d->fuelType->name ?? '-',
        'volume_liter'      => $d->volume_liter,
        'status'            => $d->status,
        'distributed_at'    => $d->distributed_at?->diffForHumans(),
    ])->values()->all();
@endphp

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<style>
    #monitoring-map { height: 420px; width: 100%; border-radius: 0 0 .5rem .5rem; z-index: 1; }
    .leaflet-popup-content-wrapper { border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,.15); font-family: inherit; }
    .map-popup-title { font-weight: 700; font-size: 13px; color: #0f3460; margin-bottom: 4px; }
    .map-popup-row   { font-size: 11px; color: #555; margin: 2px 0; }
    .map-popup-vol   { font-weight: 700; color: #195de6; }
    #feed-container  { max-height: 420px; overflow-y: auto; }
    .feed-item { opacity: 0; animation: fadeIn 0.35s ease forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: none; } }
    .pulse-dot { animation: pulse 2s infinite; }
    @keyframes pulse { 0%,100% { opacity:1; } 50% { opacity:.4; } }
</style>
@endpush

@section('content')
<div class="animate-slide-in">

    {{-- HEADER --}}
    <div class="flex flex-col flex-wrap items-center justify-between gap-4 mb-8 md:flex-row">
        <div>
            <h3 class="flex items-center gap-3 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                <span class="relative flex h-4 w-4 mr-1">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pertamina-red opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-4 w-4 bg-pertamina-red"></span>
                </span>
                Live <span class="text-pertamina-blue">Monitoring</span>
            </h3>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                Pemantauan distribusi BBM secara real-time via WebSocket
            </p>
        </div>
        <div class="flex items-center gap-3">
            <span id="ws-status" class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                <span class="size-2 rounded-full bg-slate-300 inline-block"></span>
                Menghubungkan...
            </span>
            <span class="px-3 py-1.5 text-xs font-bold bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg shadow-sm">
                Update: <span id="last-update" class="text-pertamina-blue">--:--:--</span>
            </span>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4 mb-6">
        <div class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
            <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">Transaksi Hari Ini</p>
            <h4 id="stat-today" class="text-2xl font-black text-pertamina-blue">{{ $stats['total_today'] ?? 0 }}</h4>
            <p class="text-[10px] text-slate-400 mt-1">Selesai hari ini</p>
        </div>
        <div class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
            <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">Total Volume Salur</p>
            <h4 class="text-2xl font-black text-slate-900 dark:text-white">
                <span id="stat-volume">{{ number_format(($stats['total_volume'] ?? 0) / 1000, 1, ',', '.') }}</span>
                <span class="text-sm">KL</span>
            </h4>
            <p class="text-[10px] text-slate-400 mt-1">Total volume disalurkan</p>
        </div>
        <div class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
            <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">QR Code Aktif</p>
            <h4 id="stat-qr" class="text-2xl font-black text-orange-500">{{ $stats['active_qr'] ?? 0 }}</h4>
            <p class="text-[10px] text-slate-400 mt-1">Menunggu pemindaian</p>
        </div>
        <div class="p-4 transition-all bg-white border shadow-sm rounded-xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:shadow-md">
            <p class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1">SPBU Terkoneksi</p>
            <h4 id="stat-spbu" class="text-2xl font-black text-pertamina-green">{{ $stats['active_spbu'] ?? 0 }}</h4>
            <p class="text-[10px] text-slate-400 mt-1">Aktif di sistem</p>
        </div>
    </div>

    {{-- MAIN GRID --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- PETA LEAFLET --}}
        <div class="flex flex-col overflow-hidden bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 lg:col-span-2">
            <div class="flex items-center justify-between p-4 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <h4 class="text-sm font-bold text-slate-900 dark:text-white">
                    <span class="material-symbols-outlined text-[18px] mr-1 align-bottom text-pertamina-blue">map</span>
                    Peta Persebaran SPBU
                </h4>
                <div class="flex gap-3">
                    <span class="flex items-center gap-1 text-[10px] font-bold uppercase text-slate-500">
                        <span class="size-2.5 bg-pertamina-blue rounded-full inline-block"></span> SPBU Aktif
                    </span>
                    <span class="flex items-center gap-1 text-[10px] font-bold uppercase text-slate-500">
                        <span class="size-2.5 bg-emerald-500 rounded-full inline-block"></span> Ada distribusi hari ini
                    </span>
                </div>
            </div>
            <div id="monitoring-map"></div>
            <div id="map-no-coords" class="hidden p-6 text-center text-sm text-slate-400">
                <span class="material-symbols-outlined text-3xl block mb-2">location_off</span>
                Belum ada SPBU dengan data koordinat. Tambahkan latitude &amp; longitude pada Master Data SPBU.
            </div>
        </div>

        {{-- ACTIVITY FEED --}}
        <div class="flex flex-col overflow-hidden bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
            <div class="p-4 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20 flex items-center justify-between">
                <h4 class="text-sm font-bold text-slate-900 dark:text-white">
                    <span class="material-symbols-outlined text-[18px] mr-1 align-bottom text-pertamina-blue">rss_feed</span>
                    Live Activity Feed
                </h4>
                <span class="text-[10px] text-slate-400">Real-time WebSocket</span>
            </div>
            <div id="feed-container" class="flex-1 p-4 overflow-y-auto">
                <div class="relative pl-4 space-y-5 border-l-2 border-slate-100 dark:border-slate-700" id="feed-list">
                    @forelse($recentDistributions as $dist)
                        <div class="relative feed-item">
                            <div class="absolute -left-[21px] p-1 bg-white dark:bg-slate-900 rounded-full">
                                <span class="flex block size-2.5 rounded-full
                                    {{ $dist->status === 'selesai' ? 'bg-pertamina-green' : ($dist->status === 'pending' ? 'bg-orange-400' : 'bg-slate-400') }}">
                                </span>
                            </div>
                            <p class="text-xs font-bold text-slate-800 dark:text-slate-200">
                                {{ $dist->distribution_code }}
                            </p>
                            <p class="text-[11px] text-slate-500 mt-0.5">
                                {{ $dist->spbu->name ?? 'SPBU' }} &bull;
                                {{ number_format($dist->volume_liter, 0, ',', '.') }}L {{ $dist->fuelType->name ?? 'BBM' }}
                            </p>
                            <p class="text-[10px] font-semibold text-slate-400 mt-1">
                                {{ $dist->distributed_at->diffForHumans() }}
                            </p>
                        </div>
                    @empty
                        <div class="text-xs text-slate-400 font-medium py-4 text-center">
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
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
@vite(['resources/js/app.js'])
<script>
// ─── STATE ────────────────────────────────────────────────────────────────────
const initialSpbus = @json($spbu ?? []);
const POLLING_URL  = "{{ route('superadmin.live-monitoring.data') }}";
let feedItems      = @json($feedItemsData);

// ─── MAP ──────────────────────────────────────────────────────────────────────
let map = null, markerGroup = null;

function initMap(spbus) {
    const ok = spbus.length > 0;
    document.getElementById('map-no-coords').classList.toggle('hidden', ok);
    document.getElementById('monitoring-map').classList.toggle('hidden', !ok);
    if (!ok) return;
    if (!map) {
        const lat = spbus.reduce((s, sp) => s + sp.latitude,  0) / spbus.length;
        const lng = spbus.reduce((s, sp) => s + sp.longitude, 0) / spbus.length;
        map = L.map('monitoring-map').setView([lat || -6.2, lng || 106.8], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 18,
        }).addTo(map);
        markerGroup = L.layerGroup().addTo(map);
    }
    updateMarkers(spbus);
}

function buildIcon(hasActivity) {
    const c = hasActivity ? '#10b981' : '#195de6';
    const b = hasActivity ? '#059669' : '#0f3460';
    const svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 42" width="32" height="42">'
        + '<ellipse cx="16" cy="40" rx="7" ry="2.5" fill="rgba(0,0,0,0.15)"/>'
        + '<path d="M16 0C9.37 0 4 5.37 4 12c0 9 12 28 12 28S28 21 28 12C28 5.37 22.63 0 16 0z" fill="' + c + '" stroke="' + b + '" stroke-width="1.5"/>'
        + '<circle cx="16" cy="12" r="6" fill="white" opacity="0.9"/>'
        + '<circle cx="16" cy="12" r="3.5" fill="' + c + '"/>'
        + '</svg>';
    return L.divIcon({ html: svg, className: '', iconSize: [32,42], iconAnchor: [16,42], popupAnchor: [0,-44] });
}

function updateMarkers(spbus) {
    if (!markerGroup) return;
    markerGroup.clearLayers();
    spbus.forEach(function(sp) {
        var m   = L.marker([sp.latitude, sp.longitude], { icon: buildIcon(sp.today_vol > 0) });
        var vol = sp.today_vol ? Number(sp.today_vol).toLocaleString('id-ID') + ' L' : '\u2014';
        m.bindPopup('<div style="min-width:170px">'
            + '<p class="map-popup-title">\u26fd ' + sp.name + '</p>'
            + '<p class="map-popup-row">Kode: <strong>' + sp.code + '</strong></p>'
            + '<p class="map-popup-row">Kota: ' + (sp.city || '\u2014') + '</p>'
            + '<hr style="margin:6px 0;border-color:#eee">'
            + '<p class="map-popup-row">Volume hari ini: <span class="map-popup-vol">' + vol + '</span></p>'
            + '<p class="map-popup-row">Distribusi terakhir: ' + sp.last_dist + '</p>'
            + '</div>');
        markerGroup.addLayer(m);
    });
}

// ─── FEED ─────────────────────────────────────────────────────────────────────
function renderFeed(items) {
    var list = document.getElementById('feed-list');
    if (!items || !items.length) {
        list.innerHTML = '<div class="text-xs text-slate-400 font-medium py-4 text-center">Belum ada aktivitas distribusi.</div>';
        return;
    }
    list.innerHTML = items.slice(0, 20).map(function(d, i) {
        var dot = d.status === 'selesai' ? '#10b981' : (d.status === 'pending' ? '#fb923c' : '#94a3b8');
        var vol = Number(d.volume_liter).toLocaleString('id-ID');
        return '<div class="relative feed-item" style="animation-delay:' + (i * 35) + 'ms">'
            + '<div class="absolute -left-[21px] p-1 bg-white rounded-full">'
            + '<span class="flex block size-2.5 rounded-full" style="background:' + dot + '"></span>'
            + '</div>'
            + '<p class="text-xs font-bold text-slate-800">' + d.distribution_code + '</p>'
            + '<p class="text-[11px] text-slate-500 mt-0.5">' + d.spbu_name + ' &bull; ' + vol + 'L ' + d.fuel_name + '</p>'
            + '<p class="text-[10px] font-semibold text-slate-400 mt-1">' + (d.distributed_at || 'Baru saja') + '</p>'
            + '</div>';
    }).join('');
}

function prependItem(d) {
    feedItems.unshift(d);
    if (feedItems.length > 20) feedItems.pop();
    renderFeed(feedItems);
}

// ─── STATS ────────────────────────────────────────────────────────────────────
function updateStats(stats) {
    document.getElementById('stat-today').textContent  = stats.total_today  || 0;
    var kl = ((stats.total_volume || 0) / 1000).toLocaleString('id-ID', { minimumFractionDigits:1, maximumFractionDigits:1 });
    document.getElementById('stat-volume').textContent = kl;
    document.getElementById('stat-qr').textContent     = stats.active_qr   || 0;
    document.getElementById('stat-spbu').textContent   = stats.active_spbu || 0;
    document.getElementById('last-update').textContent = new Date().toLocaleTimeString('id-ID');
}

// ─── TOAST ────────────────────────────────────────────────────────────────────
function showToast(event) {
    var t = document.createElement('div');
    t.className = 'fixed top-5 right-5 z-[999] flex items-center gap-3 px-4 py-3 bg-white border border-emerald-300 shadow-xl rounded-2xl text-sm';
    t.innerHTML = '<span class="flex size-3 relative">'
        + '<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>'
        + '<span class="relative inline-flex rounded-full size-3 bg-emerald-500"></span>'
        + '</span>'
        + '<div>'
        + '<p class="font-bold text-xs text-emerald-600">Distribusi Baru Masuk!</p>'
        + '<p class="text-xs text-slate-500">' + event.distribution_code + ' &bull; '
        + Number(event.volume_liter).toLocaleString('id-ID') + 'L &bull; ' + event.spbu_name + '</p>'
        + '</div>';
    document.body.appendChild(t);
    setTimeout(function() { t.remove(); }, 5000);
}

// ─── POLLING FALLBACK ──────────────────────────────────────────────────────────
function pollFallback() {
    fetch(POLLING_URL, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            feedItems = data.recent_distributions;
            updateStats(data.stats);
            renderFeed(feedItems);
            updateMarkers(data.spbus);
        })
        .catch(function(e) { console.warn('Polling error:', e); });
}

// ─── WEBSOCKET via Echo + Reverb ─────────────────────────────────────────────
function setWsStatus(ok) {
    document.getElementById('ws-status').innerHTML = ok
        ? '<span class="pulse-dot size-2 rounded-full bg-emerald-500 inline-block"></span> <span class="text-emerald-600">WebSocket Live</span>'
        : '<span class="size-2 rounded-full bg-yellow-400 inline-block"></span> <span class="text-slate-500">Polling aktif</span>';
}

function initWebSocket() {
    if (typeof window.Echo === 'undefined') {
        console.warn('[WS] Echo belum tersedia.');
        setWsStatus(false);
        return;
    }

    window.Echo.channel('distributions')
        .listen('.distribution.created', function(event) {
            if (event.stats) updateStats(event.stats);
            prependItem({
                distribution_code: event.distribution_code,
                spbu_name:         event.spbu_name,
                fuel_name:         event.fuel_name,
                volume_liter:      event.volume_liter,
                status:            event.status,
                distributed_at:    event.distributed_at,
            });
            showToast(event);
        });

    var conn = window.Echo.connector.pusher.connection;
    conn.bind('connected',    function() { setWsStatus(true); });
    conn.bind('disconnected', function() { setWsStatus(false); });
}

// ─── INIT ─────────────────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', function() {
    initMap(initialSpbus);
    renderFeed(feedItems);
    initWebSocket();
    pollFallback();
    setInterval(pollFallback, 60000);
});
</script>
@endpush