@extends('layouts.superadmin')

@section('title', 'QR Code Management')

@section('content')
<div class="p-8 space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <div class="flex items-center gap-2 mb-2">
                <div class="p-2 bg-blue-100 rounded-lg dark:bg-blue-500/20">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[24px]">qr_code_2</span>
                </div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                    QR Code Management
                </h2>
            </div>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">
                Manajemen QR Code untuk pendataan dan validasi distribusi BBM di SPBU.
            </p>
        </div>

        <button onclick="openGenerateModal()"
            class="flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white rounded-xl shadow-lg shadow-blue-500/30 bg-gradient-to-r from-blue-500 to-blue-600 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-300 hover:scale-105 active:scale-95">
            <span class="material-symbols-outlined text-[18px]">add</span>
            Generate QR Code
        </button>
    </div>

    {{-- FILTER & SEARCH BAR --}}
    <div class="flex flex-col gap-4 p-5 bg-white border shadow-sm md:flex-row md:items-center md:justify-between dark:bg-slate-800 rounded-xl border-slate-200 dark:border-slate-700/50">
        <div class="relative flex-1">
            <span class="absolute -translate-y-1/2 material-symbols-outlined left-3 top-1/2 text-slate-400">search</span>
            <input type="text" placeholder="Cari QR Code, SPBU, atau Jenis BBM..."
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder:text-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
        </div>
        <div class="flex gap-3">
            <select class="px-4 py-2.5 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <option>Semua Status</option>
                <option>Aktif</option>
                <option>Digunakan</option>
                <option>Expired</option>
            </select>
            <button class="px-4 py-2.5 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-900 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">filter_list</span>
                Filter
            </button>
        </div>
    </div>

    {{-- STATISTIC --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
        <div class="p-5 transition-all duration-300 bg-white border shadow-sm cursor-pointer border-slate-200/60 rounded-xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium tracking-wide uppercase text-slate-500 dark:text-slate-400">Total QR Dibuat</p>
                    <h3 class="mt-2 text-3xl font-bold text-slate-900 dark:text-white">4.532</h3>
                    <p class="mt-1 text-xs text-slate-500">+12% dari bulan lalu</p>
                </div>
                <div class="p-3 transition-transform duration-300 bg-blue-50 dark:bg-blue-500/10 rounded-xl group-hover:scale-110">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[28px]">qr_code_2</span>
                </div>
            </div>
        </div>

        <div class="p-5 transition-all duration-300 bg-white border shadow-sm cursor-pointer border-emerald-200/60 rounded-xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium tracking-wide uppercase text-slate-500 dark:text-slate-400">QR Aktif</p>
                    <h3 class="mt-2 text-3xl font-bold text-emerald-600 dark:text-emerald-400">3.210</h3>
                    <p class="mt-1 text-xs text-emerald-600">Siap digunakan</p>
                </div>
                <div class="p-3 transition-transform duration-300 bg-emerald-50 dark:bg-emerald-500/10 rounded-xl group-hover:scale-110">
                    <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-[28px]">check_circle</span>
                </div>
            </div>
        </div>

        <div class="p-5 transition-all duration-300 bg-white border shadow-sm cursor-pointer border-blue-200/60 rounded-xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium tracking-wide uppercase text-slate-500 dark:text-slate-400">QR Digunakan</p>
                    <h3 class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">1.102</h3>
                    <p class="mt-1 text-xs text-blue-600">Sedang berlangsung</p>
                </div>
                <div class="p-3 transition-transform duration-300 bg-blue-50 dark:bg-blue-500/10 rounded-xl group-hover:scale-110">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[28px]">verified</span>
                </div>
            </div>
        </div>

        <div class="p-5 transition-all duration-300 bg-white border shadow-sm cursor-pointer border-red-200/60 rounded-xl dark:bg-slate-800 dark:border-slate-700/50 hover:shadow-md group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium tracking-wide uppercase text-slate-500 dark:text-slate-400">QR Expired</p>
                    <h3 class="mt-2 text-3xl font-bold text-red-500 dark:text-red-400">220</h3>
                    <p class="mt-1 text-xs text-red-500">Perlu regenerasi</p>
                </div>
                <div class="p-3 transition-transform duration-300 bg-red-50 dark:bg-red-500/10 rounded-xl group-hover:scale-110">
                    <span class="material-symbols-outlined text-red-500 dark:text-red-400 text-[28px]">cancel</span>
                </div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-hidden bg-white border shadow-lg border-slate-200/60 rounded-xl dark:bg-slate-800 dark:border-slate-700/50">
        <div class="p-5 border-b border-slate-200 dark:border-slate-700/50 bg-gradient-to-r from-slate-50 to-white dark:from-slate-800 dark:to-slate-800">
            <div class="flex items-center justify-between">
                <h4 class="flex items-center gap-2 text-lg font-bold text-slate-900 dark:text-white">
                    <span class="text-blue-600 material-symbols-outlined">list_alt</span>
                    Daftar QR Code Distribusi BBM
                </h4>
                <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                    <span>Menampilkan 1-10 dari 4.532 data</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b bg-gradient-to-r from-slate-100 to-slate-50 dark:from-slate-900 dark:to-slate-800 border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider text-left uppercase text-slate-700 dark:text-slate-300">QR Code</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider text-left uppercase text-slate-700 dark:text-slate-300">SPBU</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider text-left uppercase text-slate-700 dark:text-slate-300">Jenis BBM</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider text-left uppercase text-slate-700 dark:text-slate-300">Kuota</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider text-left uppercase text-slate-700 dark:text-slate-300">Periode</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider text-center uppercase text-slate-700 dark:text-slate-300">Status</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider text-right uppercase text-slate-700 dark:text-slate-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">

                    {{-- AKTIF --}}
                    <tr class="transition-colors duration-200 hover:bg-slate-50 dark:hover:bg-slate-700/30">
                        <td class="px-6 py-4 font-mono text-xs font-semibold text-slate-900 dark:text-white bg-slate-50 dark:bg-slate-900/50">QR-PLT-20260207-001</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">SPBU 34.123.01</td>
                        <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                            <span class="inline-flex items-center gap-1.5">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                Pertalite
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">8.000 Liter</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">07–08 Feb 2026</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full text-emerald-700 bg-emerald-100 dark:bg-emerald-500/20 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <button onclick="viewQRDetail('QR-PLT-20260207-001')" class="p-2 transition-colors rounded-lg hover:bg-blue-50 dark:hover:bg-blue-500/10 group" title="Lihat Detail">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200 text-[20px]">visibility</span>
                                </button>
                                <button onclick="downloadQR('QR-PLT-20260207-001')" class="p-2 transition-colors rounded-lg hover:bg-green-50 dark:hover:bg-green-500/10 group" title="Download QR">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200 text-[20px]">download</span>
                                </button>
                                <button onclick="deactivateQR('QR-PLT-20260207-001')" class="p-2 transition-colors rounded-lg hover:bg-red-50 dark:hover:bg-red-500/10 group" title="Nonaktifkan">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-red-500 dark:group-hover:text-red-400 transition-colors duration-200 text-[20px]">cancel</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- DIGUNAKAN --}}
                    <tr class="transition-colors duration-200 hover:bg-slate-50 dark:hover:bg-slate-700/30">
                        <td class="px-6 py-4 font-mono text-xs font-semibold text-slate-900 dark:text-white bg-slate-50 dark:bg-slate-900/50">QR-PMX-20260207-002</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">SPBU 34.123.01</td>
                        <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                            <span class="inline-flex items-center gap-1.5">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                Pertamax
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">8.000 Liter</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">07 Feb 2026</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-blue-700 bg-blue-100 dark:bg-blue-500/20 dark:text-blue-400 rounded-full border border-blue-200 dark:border-blue-500/30">
                                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                Digunakan
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <button onclick="viewQRDetail('QR-PMX-20260207-002')" class="p-2 transition-colors rounded-lg hover:bg-blue-50 dark:hover:bg-blue-500/10 group" title="Lihat Detail">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200 text-[20px]">visibility</span>
                                </button>
                                <button onclick="downloadQR('QR-PMX-20260207-002')" class="p-2 transition-colors rounded-lg hover:bg-green-50 dark:hover:bg-green-500/10 group" title="Download QR">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200 text-[20px]">download</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- EXPIRED --}}
                    <tr class="transition-colors duration-200 hover:bg-slate-50 dark:hover:bg-slate-700/30">
                        <td class="px-6 py-4 font-mono text-xs font-semibold text-slate-900 dark:text-white bg-slate-50 dark:bg-slate-900/50">QR-SLR-20260205-003</td>
                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">SPBU 34.121.05</td>
                        <td class="px-6 py-4 text-slate-700 dark:text-slate-300">
                            <span class="inline-flex items-center gap-1.5">
                                <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                                Solar
                            </span>
                        </td>
                        <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">6.000 Liter</td>
                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">05 Feb 2026</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-red-700 bg-red-100 dark:bg-red-500/20 dark:text-red-400 rounded-full border border-red-200 dark:border-red-500/30">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                Expired
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">
                                <button onclick="viewQRDetail('QR-SLR-20260205-003')" class="p-2 transition-colors rounded-lg hover:bg-blue-50 dark:hover:bg-blue-500/10 group" title="Lihat Detail">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200 text-[20px]">visibility</span>
                                </button>
                                <button onclick="regenerateQR('QR-SLR-20260205-003')" class="p-2 transition-colors rounded-lg hover:bg-orange-50 dark:hover:bg-orange-500/10 group" title="Regenerate QR">
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors duration-200 text-[20px]">refresh</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50">
            <div class="flex items-center justify-between">
                <button class="px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-lg text-slate-700 dark:text-slate-300 dark:bg-slate-800 border-slate-300 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    Previous
                </button>
                <div class="flex gap-2">
                    <button class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg">1</button>
                    <button class="px-3 py-2 text-sm font-medium transition-colors bg-white border rounded-lg text-slate-700 dark:text-slate-300 dark:bg-slate-800 border-slate-300 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700">2</button>
                    <button class="px-3 py-2 text-sm font-medium transition-colors bg-white border rounded-lg text-slate-700 dark:text-slate-300 dark:bg-slate-800 border-slate-300 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700">3</button>
                    <span class="px-3 py-2 text-sm text-slate-500">...</span>
                    <button class="px-3 py-2 text-sm font-medium transition-colors bg-white border rounded-lg text-slate-700 dark:text-slate-300 dark:bg-slate-800 border-slate-300 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700">454</button>
                </div>
                <button class="px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-lg text-slate-700 dark:text-slate-300 dark:bg-slate-800 border-slate-300 dark:border-slate-600 hover:bg-slate-50 dark:hover:bg-slate-700">
                    Next
                </button>
            </div>
        </div>
    </div>

</div>

{{-- MODAL GENERATE QR CODE --}}
<div id="generateModal" class="fixed inset-0 z-50 items-center justify-center hidden p-4 bg-black/60 backdrop-blur-sm">
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all">
        {{-- Modal Header --}}
        <div class="sticky top-0 p-6 bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 rounded-lg bg-white/20">
                        <span class="material-symbols-outlined text-white text-[24px]">qr_code_2</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">Generate QR Code Baru</h3>
                        <p class="text-sm text-blue-100">Buat QR Code untuk distribusi BBM</p>
                    </div>
                </div>
                <button onclick="closeGenerateModal()" class="p-2 transition-colors rounded-lg hover:bg-white/20">
                    <span class="text-white material-symbols-outlined">close</span>
                </button>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 space-y-4">
            {{-- SPBU Selection --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">SPBU</label>
                <select id="spbuSelect" class="w-full px-4 py-3 transition-all bg-white border rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih SPBU</option>
                    <option value="34.123.01">SPBU 34.123.01 - Semarang Timur</option>
                    <option value="34.123.02">SPBU 34.123.02 - Semarang Barat</option>
                    <option value="34.121.05">SPBU 34.121.05 - Semarang Selatan</option>
                </select>
            </div>

            {{-- Jenis BBM --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Jenis BBM</label>
                <select id="bbmSelect" class="w-full px-4 py-3 transition-all bg-white border rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Pilih Jenis BBM</option>
                    <option value="Pertalite">Pertalite</option>
                    <option value="Pertamax">Pertamax</option>
                    <option value="Solar">Solar</option>
                    <option value="Dexlite">Dexlite</option>
                </select>
            </div>

            {{-- Kuota --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kuota (Liter)</label>
                <input type="number" id="kuotaInput" placeholder="Contoh: 8000" class="w-full px-4 py-3 transition-all bg-white border rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            {{-- Periode --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Tanggal Mulai</label>
                    <input type="date" id="startDateInput" class="w-full px-4 py-3 transition-all bg-white border rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Tanggal Selesai</label>
                    <input type="date" id="endDateInput" class="w-full px-4 py-3 transition-all bg-white border rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            {{-- Preview QR (Hidden initially) --}}
            <div id="qrPreview" class="hidden p-6 mt-6 border-2 border-blue-200 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-slate-900 dark:to-slate-800 rounded-xl dark:border-blue-500/30">
                <div class="text-center">
                    <div class="inline-block p-4 bg-white shadow-lg rounded-xl">
                        <div id="qrcode" class="flex items-center justify-center"></div>
                    </div>
                    <div class="mt-4">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">QR Code ID:</p>
                        <p id="qrCodeId" class="mt-1 font-mono text-lg font-bold text-blue-600 dark:text-blue-400"></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="sticky bottom-0 p-6 border-t bg-slate-50 dark:bg-slate-900 rounded-b-2xl border-slate-200 dark:border-slate-700">
            <div class="flex justify-end gap-3">
                <button onclick="closeGenerateModal()" class="px-6 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                    Batal
                </button>
                <button onclick="generateQRCode()" class="px-6 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40 transition-all hover:scale-105 active:scale-95">
                    <span class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Generate QR Code
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- QR Code Library (CDN) --}}
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>

<script>
function openGenerateModal() {
    document.getElementById('generateModal').classList.remove('hidden');
    document.getElementById('generateModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeGenerateModal() {
    document.getElementById('generateModal').classList.add('hidden');
    document.getElementById('generateModal').classList.remove('flex');
    document.body.style.overflow = 'auto';

    // Reset form
    document.getElementById('spbuSelect').value = '';
    document.getElementById('bbmSelect').value = '';
    document.getElementById('kuotaInput').value = '';
    document.getElementById('startDateInput').value = '';
    document.getElementById('endDateInput').value = '';
    document.getElementById('qrPreview').classList.add('hidden');
    document.getElementById('qrcode').innerHTML = '';
}

function generateQRCode() {
    const spbu = document.getElementById('spbuSelect').value;
    const bbm = document.getElementById('bbmSelect').value;
    const kuota = document.getElementById('kuotaInput').value;
    const startDate = document.getElementById('startDateInput').value;
    const endDate = document.getElementById('endDateInput').value;

    // Validation
    if (!spbu || !bbm || !kuota || !startDate || !endDate) {
        alert('Mohon lengkapi semua field!');
        return;
    }

    // Generate QR Code ID
    const bbmCode = bbm.substring(0, 3).toUpperCase();
    const today = new Date().toISOString().split('T')[0].replace(/-/g, '');
    const randomNum = Math.floor(Math.random() * 1000).toString().padStart(3, '0');
    const qrCodeId = `QR-${bbmCode}-${today}-${randomNum}`;

    // QR Code Data
    const qrData = JSON.stringify({
        id: qrCodeId,
        spbu: spbu,
        jenis_bbm: bbm,
        kuota: kuota,
        periode: `${startDate} - ${endDate}`,
        generated_at: new Date().toISOString()
    });

    // Clear previous QR
    document.getElementById('qrcode').innerHTML = '';

    // Generate QR Code
    QRCode.toCanvas(qrData, {
        width: 200,
        margin: 2,
        color: {
            dark: '#1e40af',
            light: '#ffffff'
        }
    }, function (error, canvas) {
        if (error) {
            console.error(error);
            alert('Gagal generate QR Code!');
        } else {
            document.getElementById('qrcode').appendChild(canvas);
            document.getElementById('qrCodeId').textContent = qrCodeId;
            document.getElementById('qrPreview').classList.remove('hidden');

            // Success notification
            setTimeout(() => {
                alert(`✅ QR Code berhasil dibuat!\n\nID: ${qrCodeId}\nSPBU: ${spbu}\nBBM: ${bbm}\nKuota: ${kuota} Liter`);
            }, 300);
        }
    });
}

function downloadQR(qrId) {
    alert(`Download QR Code: ${qrId}`);
    // Implement download logic here
}

function viewQRDetail(qrId) {
    alert(`Melihat detail QR Code: ${qrId}`);
    // Implement view detail logic here
}

function deactivateQR(qrId) {
    if (confirm(`Apakah Anda yakin ingin menonaktifkan QR Code: ${qrId}?`)) {
        alert(`QR Code ${qrId} telah dinonaktifkan!`);
        // Implement deactivate logic here
    }
}

function regenerateQR(qrId) {
    if (confirm(`Regenerate QR Code: ${qrId}?`)) {
        alert(`QR Code baru sedang dibuat untuk menggantikan ${qrId}!`);
        // Implement regenerate logic here
    }
}

// Close modal when clicking outside
document.getElementById('generateModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeGenerateModal();
    }
});
</script>
@endsection
