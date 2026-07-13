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
                                    @if($sj->driver)
                                        <div class="font-semibold text-slate-950">{{ $sj->driver->name }}</div>
                                    @else
                                        <div class="font-semibold text-slate-400 italic">Belum Ditugaskan</div>
                                    @endif
                                    @if($sj->vehicle_plate)
                                        <div class="text-xs font-mono text-slate-500">{{ $sj->vehicle_plate }}</div>
                                    @else
                                        <div class="text-xs font-mono text-slate-400 italic">No Plat: -</div>
                                    @endif
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
                                            <button type="button"
                                                onclick="openVerifyModal('{{ $sj->id }}', '{{ $sj->driver ? $sj->driver->name : 'Tidak Ada Driver' }}', '{{ $sj->vehicle_plate }}', '{{ $sj->kode_surat_jalan }}')"
                                                class="bg-pertamina-blue hover:bg-blue-700 text-white font-bold text-xs px-4 py-2 rounded-xl transition-all shadow-sm flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[16px]">verified</span>
                                                <span>Verifikasi</span>
                                            </button>
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
                                            <button type="button"
                                                onclick="openBarcodeModal('{{ $sj->kode_surat_jalan }}', '{{ $sj->driver ? $sj->driver->name : 'Driver' }}', '{{ $sj->vehicle_plate }}', '{{ $sj->fuelType->name }}', '{{ $sj->volume_liter }}', '{{ $sj->spbu->name }}')"
                                                class="bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs px-4 py-2 rounded-xl transition-all shadow-sm flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[16px]">qr_code_2</span>
                                                <span>Cetak Barcode</span>
                                            </button>
                                        @elseif($sj->status === 'dikirim')
                                            <span class="text-xs text-purple-600 font-bold flex items-center gap-1 justify-end">
                                                <span class="animate-pulse w-2 h-2 rounded-full bg-purple-500"></span>
                                                Driver OTR
                                            </span>
                                            <button type="button"
                                                onclick="openBarcodeModal('{{ $sj->kode_surat_jalan }}', '{{ $sj->driver ? $sj->driver->name : 'Driver' }}', '{{ $sj->vehicle_plate }}', '{{ $sj->fuelType->name }}', '{{ $sj->volume_liter }}', '{{ $sj->spbu->name }}')"
                                                class="bg-amber-500 hover:bg-amber-605 text-white font-bold text-xs px-3 py-1.5 rounded-lg transition-all shadow-sm flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">qr_code_2</span>
                                                <span>Barcode</span>
                                            </button>
                                        @else
                                            <span class="text-xs text-slate-400 font-medium">Selesai</span>
                                            <button type="button"
                                                onclick="openBarcodeModal('{{ $sj->kode_surat_jalan }}', '{{ $sj->driver ? $sj->driver->name : 'Driver' }}', '{{ $sj->vehicle_plate }}', '{{ $sj->fuelType->name }}', '{{ $sj->volume_liter }}', '{{ $sj->spbu->name }}')"
                                                class="bg-amber-500 hover:bg-amber-605 text-white font-bold text-xs px-3 py-1.5 rounded-lg transition-all shadow-sm flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[14px]">qr_code_2</span>
                                                <span>Barcode</span>
                                            </button>
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

    {{-- VERIFY INPUT MODAL --}}
    <div id="verifyModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeVerifyModal()">
            </div>
            <div
                class="relative w-full max-w-lg overflow-hidden text-left align-bottom transition-all transform border border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl shadow-glass dark:bg-slate-900/90 rounded-3xl sm:my-8 sm:align-middle">
                <div
                    class="px-6 py-5 border-b border-slate-200/50 dark:border-slate-800 bg-gradient-to-r from-pertamina-blue/10 to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-pertamina-blue text-white">
                                <span class="material-symbols-outlined">verified</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Verifikasi & Tugaskan Driver
                                </h3>
                                <p class="text-xs text-slate-500 font-mono" id="verifySjCode"></p>
                            </div>
                        </div>
                        <button type="button" onclick="closeVerifyModal()"
                            class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <span class="material-symbols-outlined text-slate-500">close</span>
                        </button>
                    </div>
                </div>

                <form id="verifyForm" method="POST" action="" class="space-y-4 px-6 py-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-350">Driver
                            (Operator)</label>
                        <div class="w-full px-4 py-2.5 text-sm font-bold bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-850 dark:text-slate-250"
                            id="verifyDriverName">-</div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-350">Nomor Polisi
                            Armada</label>
                        <input type="text" name="vehicle_plate" id="verifyPlate" required placeholder="Contoh: B 1234 ABC"
                            class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 focus:ring-2 focus:ring-pertamina-blue/20" />
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-200/50">
                        <button type="button" onclick="closeVerifyModal()"
                            class="px-5 py-2.5 text-sm font-bold text-slate-650 bg-white border border-slate-250 rounded-xl">Batal</button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-pertamina-blue hover:bg-blue-700 rounded-xl shadow-glow-blue transition-all">Simpan
                            & Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- BARCODE / QR PRINT PREVIEW MODAL --}}
    <div id="barcodeModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeBarcodeModal()">
            </div>
            <div
                class="relative w-full max-w-md overflow-hidden text-left align-bottom transition-all transform border border-white/50 dark:border-slate-700 bg-white dark:bg-slate-900 rounded-3xl sm:my-8 sm:align-middle">

                {{-- Print Area --}}
                <div id="printArea" class="p-8 bg-white text-slate-900 flex flex-col items-center">
                    <!-- Brand Header for print -->
                    <div class="flex items-center gap-2 mb-6 w-full pb-4 border-b border-dashed border-slate-300">
                        <div
                            class="size-8 rounded bg-gradient-to-br from-pertamina-blue to-blue-700 flex items-center justify-center text-white font-bold text-xs shrink-0">
                            P</div>
                        <div class="text-left">
                            <h5 class="text-sm font-black leading-tight text-slate-900">PERTAMINA</h5>
                            <p class="text-[9px] text-slate-500 font-bold uppercase tracking-wider">Depo Distribution Ticket
                            </p>
                        </div>
                    </div>

                    <!-- QR code container -->
                    <div id="barcodeCanvasContainer"
                        class="flex items-center justify-center p-3 bg-white border-2 border-slate-200 size-48 rounded-2xl shadow-sm mb-4">
                    </div>

                    <h4 class="font-mono font-black text-lg tracking-wider text-slate-800" id="printSjCode">SJ-CODE</h4>

                    <div class="w-full mt-6 space-y-2.5 text-xs border-t border-dashed border-slate-300 pt-4 text-left">
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">Driver</span><span
                                class="font-bold text-slate-800" id="printDriver">-</span></div>
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">No.
                                Kendaraan</span><span class="font-bold text-slate-800" id="printPlate">-</span></div>
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">Jenis BBM</span><span
                                class="font-bold text-slate-800" id="printFuel">-</span></div>
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">Volume</span><span
                                class="font-bold text-slate-800" id="printVolume">-</span></div>
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">SPBU Tujuan</span><span
                                class="font-bold text-slate-800" id="printSpbu">-</span></div>
                    </div>
                </div>

                {{-- Action panel --}}
                <div
                    class="flex justify-end gap-3 px-6 py-4 border-t bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800">
                    <button type="button" onclick="closeBarcodeModal()"
                        class="px-4 py-2 text-sm font-bold text-slate-650 bg-white border border-slate-250 dark:bg-slate-800 dark:text-slate-350 dark:border-slate-700 rounded-xl">Tutup</button>
                    <button type="button" onclick="printTicket()"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-pertamina-blue hover:bg-blue-700 rounded-xl shadow-glow-blue transition-all flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px]">print</span>
                        Cetak Tiket Barcode
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Script support --}}
    <!-- Load QRCode Library with Fallbacks -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode/1.5.1/qrcode.min.js"></script>
    <script>
        if (typeof QRCode === 'undefined') {
            document.write('<script src="https://unpkg.com/qrcode@1.5.1/build/qrcode.min.js"><\/script>');
        }
    </script>
    <script>
        if (typeof QRCode === 'undefined') {
            document.write('<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"><\/script>');
        }
    </script>
    <script>
        function openVerifyModal(id, driverName, plate, codeSJ) {
            document.getElementById('verifyForm').action = `/admin/surat-jalan/${id}/verify`;
            document.getElementById('verifySjCode').textContent = codeSJ;
            document.getElementById('verifyDriverName').textContent = driverName;
            document.getElementById('verifyPlate').value = plate || '';

            const el = document.getElementById('verifyModal');
            el.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeVerifyModal() {
            const el = document.getElementById('verifyModal');
            el.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openBarcodeModal(codeSJ, driver, plate, fuel, volume, spbu) {
            document.getElementById('printSjCode').textContent = codeSJ;
            document.getElementById('printDriver').textContent = driver;
            document.getElementById('printPlate').textContent = plate;
            document.getElementById('printFuel').textContent = fuel;
            document.getElementById('printVolume').textContent = Number(volume).toLocaleString('id-ID') + ' Liter';
            document.getElementById('printSpbu').textContent = spbu;

            // Render QR Code inside barcodeCanvasContainer
            const container = document.getElementById('barcodeCanvasContainer');
            container.innerHTML = '';

            QRCode.toDataURL(
                codeSJ,
                { width: 160, margin: 1, color: { dark: '#005eb8', light: '#ffffff' } },
                function (err, url) {
                    if (!err) {
                        const img = document.createElement('img');
                        img.src = url;
                        img.className = 'w-40 h-40';
                        img.alt = 'QR Code';
                        container.appendChild(img);
                    }
                }
            );

            const el = document.getElementById('barcodeModal');
            el.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeBarcodeModal() {
            const el = document.getElementById('barcodeModal');
            el.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function printTicket() {
            window.print();
        }
    </script>

    @push('styles')
        <style>
            @media print {

                /* Hide sidebar, layout background, other sections of main, verify modal, and backdrop / actions of barcode modal */
                aside,
                main>div> :not(#barcodeModal),
                .fixed,
                #verifyModal,
                #barcodeModal .backdrop-blur-sm,
                #barcodeModal .fixed,
                #barcodeModal button,
                #barcodeModal .border-t {
                    display: none !important;
                }

                /* Override main content margins/padding for printing */
                main {
                    margin-left: 0 !important;
                    padding: 0 !important;
                }

                main>div {
                    padding: 0 !important;
                    margin: 0 !important;
                    max-width: none !important;
                }

                /* Display the print container */
                #barcodeModal {
                    display: block !important;
                    position: static !important;
                    background: transparent !important;
                    box-shadow: none !important;
                    border: none !important;
                    overflow: visible !important;
                }

                #barcodeModal>div {
                    display: block !important;
                    padding: 0 !important;
                    min-height: auto !important;
                }

                #barcodeModal>div>div {
                    box-shadow: none !important;
                    border: none !important;
                    background: transparent !important;
                    padding: 0 !important;
                    margin: 0 !important;
                    max-width: none !important;
                }

                #printArea {
                    display: flex !important;
                    flex-direction: column !important;
                    align-items: center !important;
                    width: 80mm !important;
                    margin: 0 auto !important;
                    padding: 20px !important;
                    background: white !important;
                    color: black !important;
                }

                /* Force color/background resets to ensure all texts print correctly */
                #printArea,
                #printArea * {
                    color: black !important;
                    background: white !important;
                    border-color: black !important;
                }
            }
        </style>
    @endpush
@endsection