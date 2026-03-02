@extends('layouts.superadmin')

@section('title', 'Master Data Management')

@section('content')
<div class="animate-slide-in">

    {{-- ===== HEADER SECTION ===== --}}
    <div class="mb-8">
        <h1 class="mb-2 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
            Master Data <span class="text-pertamina-blue">Manajemen</span>
        </h1>
        <p class="text-sm text-slate-600 dark:text-slate-400">Pusat kontrol data utama sistem distribusi BBM (BBM, SPBU, dan Armada)</p>
    </div>

    {{-- ===== STATISTIK ===== --}}
    <div class="grid grid-cols-1 gap-4 mb-10 sm:grid-cols-2 lg:grid-cols-4 md:gap-6">
        <div class="p-6 transition-all duration-300 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Total Transaksi Selesai</p>
                <div class="flex items-center justify-center rounded-lg size-10 bg-pertamina-blue/10">
                    <span class="text-xl material-symbols-outlined text-pertamina-blue">receipt_long</span>
                </div>
            </div>
            <h4 class="text-4xl font-black text-slate-900 dark:text-white">1.248</h4>
            <div class="flex items-center mt-3 text-xs text-pertamina-green">
                <span class="text-[14px] material-symbols-outlined mr-1">trending_up</span>
                <span class="font-bold">+12.5%</span>
                <span class="ml-1 text-slate-400">vs kemarin</span>
            </div>
        </div>

        <div class="p-6 transition-all duration-300 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">SPBU Aktif/Terdaftar</p>
                <div class="flex items-center justify-center rounded-lg size-10 bg-pertamina-green/10">
                    <span class="text-xl material-symbols-outlined text-pertamina-green">local_gas_station</span>
                </div>
            </div>
            <h4 class="text-4xl font-black text-slate-900 dark:text-white">986</h4>
            <div class="flex items-center mt-3 text-xs text-slate-500">
                <span class="text-[14px] material-symbols-outlined mr-1 text-pertamina-green">verified</span>
                <span class="font-bold text-slate-600 dark:text-slate-300">100%</span>
                <span class="ml-1">Coverage Nasional</span>
            </div>
        </div>

         <div class="p-6 transition-all duration-300 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Jenis BBM Disalurkan</p>
                <div class="flex items-center justify-center rounded-lg size-10 bg-orange-500/10">
                    <span class="text-xl text-orange-500 material-symbols-outlined">water_drop</span>
                </div>
            </div>
            <h4 class="text-4xl font-black text-slate-900 dark:text-white">5</h4>
            <div class="flex items-center mt-3 text-xs text-slate-500">
                <span class="text-[14px] material-symbols-outlined mr-1 text-orange-500">category</span>
                <span class="ml-1">Varian produk standar aktif</span>
            </div>
        </div>

         <div class="p-6 transition-all duration-300 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Armada Terdaftar</p>
                <div class="flex items-center justify-center rounded-lg size-10 bg-slate-100 dark:bg-slate-800">
                    <span class="text-xl text-slate-700 dark:text-slate-300 material-symbols-outlined">local_shipping</span>
                </div>
            </div>
            <h4 class="text-4xl font-black text-slate-900 dark:text-white">6</h4>
            <div class="flex items-center mt-3 text-xs text-slate-500">
                <span class="text-[14px] material-symbols-outlined mr-1">speed</span>
                <span class="ml-1">Kategori armada distribusi</span>
            </div>
        </div>
    </div>

    {{-- ===== DATA TABLES ===== --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- MASTER BBM (1/3 Width) --}}
        <div class="flex flex-col overflow-hidden transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
            <div class="flex items-center justify-between p-5 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <h4 class="text-base font-bold text-slate-900 dark:text-white"><span class="material-symbols-outlined text-[18px] mr-1 align-bottom text-orange-500">water_drop</span> Master BBM</h4>
                <button type="button" onclick="openModal('modalBBM')" class="flex items-center gap-1 px-3 py-1.5 text-xs font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 hover:scale-105 shadow-glow-amber">
                    <span class="text-[16px] material-symbols-outlined">add</span>
                    Tambah
                </button>
            </div>
            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                        <tr>
                            <th class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">BBM</th>
                            <th class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">Kode</th>
                            <th class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-3 font-bold text-slate-900 dark:text-white">Pertalite</td>
                            <td class="px-5 py-3"><span class="px-2 py-1 text-[10px] font-bold uppercase rounded-lg bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">PRTL</span></td>
                            <td class="px-5 py-3"><span class="inline-flex items-center gap-1.5 px-2 py-0.5 text-[10px] font-bold uppercase rounded-full bg-pertamina-green/10 text-pertamina-green"><span class="w-1.5 h-1.5 bg-pertamina-green rounded-full"></span>Aktif</span></td>
                        </tr>
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-3 font-bold text-slate-900 dark:text-white">Pertamax</td>
                            <td class="px-5 py-3"><span class="px-2 py-1 text-[10px] font-bold uppercase rounded-lg bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">PRTX</span></td>
                            <td class="px-5 py-3"><span class="inline-flex items-center gap-1.5 px-2 py-0.5 text-[10px] font-bold uppercase rounded-full bg-slate-100 text-slate-500 dark:bg-slate-800"><span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>NonAktif</span></td>
                        </tr>
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-3 font-bold text-slate-900 dark:text-white">Bio Solar</td>
                            <td class="px-5 py-3"><span class="px-2 py-1 text-[10px] font-bold uppercase rounded-lg bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300">BSLR</span></td>
                            <td class="px-5 py-3"><span class="inline-flex items-center gap-1.5 px-2 py-0.5 text-[10px] font-bold uppercase rounded-full bg-pertamina-green/10 text-pertamina-green"><span class="w-1.5 h-1.5 bg-pertamina-green rounded-full"></span>Aktif</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t bg-slate-50/50 dark:bg-slate-800/20 border-slate-200/50 dark:border-slate-800">
                <p class="text-xs font-semibold text-slate-500">Total: <span class="text-slate-900 dark:text-white">3</span> Data Tersimpan</p>
            </div>
        </div>

        {{-- MASTER ARMADA / KENDARAAN (2/3 Width) --}}
        <div class="flex flex-col overflow-hidden transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 lg:col-span-2">
            <div class="flex items-center justify-between p-5 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                <div class="flex flex-col">
                    <h4 class="text-base font-bold text-slate-900 dark:text-white"><span class="material-symbols-outlined text-[18px] mr-1 align-bottom text-slate-700 dark:text-slate-300">local_shipping</span> Master Kapasitas & Jenis Armada</h4>
                    <p class="text-xs text-slate-500">Spesifikasi dimensi armada angkut distribusi BBM Pertamina</p>
                </div>
                <button type="button" onclick="openModal('modalKendaraan')" class="flex items-center gap-1 px-3 py-1.5 text-xs font-bold text-slate-700 dark:text-slate-300 transition-all shadow-sm rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">
                    <span class="text-[16px] material-symbols-outlined">add</span>
                    Tambah Klasifikasi
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                        <tr>
                            <th class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">Kapasitas Total</th>
                            <th class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">Jml Kompartemen</th>
                            <th class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">Jenis Kendaraan</th>
                            <th class="px-5 py-3 text-xs font-bold tracking-wider hidden md:table-cell text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">Peruntukan Utama</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        <!-- 5KL -->
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-4 font-bold text-slate-900 dark:text-white">5.000 Liter (5 KL)</td>
                            <td class="px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">1 - 2 Sekat</td>
                            <td class="px-5 py-4"><span class="inline-flex items-center px-2 py-1 text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg">Rigid Truck (4 Roda)</span></td>
                            <td class="px-5 py-4 text-xs hidden md:table-cell text-slate-500">Pertashop, SPBU di gang sempit, atau daerah terpencil.</td>
                        </tr>
                        <!-- 8KL -->
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-4 font-bold text-slate-900 dark:text-white">8.000 Liter (8 KL)</td>
                            <td class="px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">1 - 2 Sekat</td>
                            <td class="px-5 py-4"><span class="inline-flex items-center px-2 py-1 text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg">Rigid Truck (6 Roda)</span></td>
                            <td class="px-5 py-4 text-xs hidden md:table-cell text-slate-500">SPBU menengah, wilayah perkotaan dengan akses standar.</td>
                        </tr>
                        <!-- 16KL -->
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-4 font-bold text-slate-900 dark:text-white">16.000 Liter (16 KL)</td>
                            <td class="px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">2 - 3 Sekat</td>
                            <td class="px-5 py-4"><span class="inline-flex items-center px-2 py-1 text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg">Rigid Truck (10 Roda)</span></td>
                            <td class="px-5 py-4 text-xs hidden md:table-cell text-slate-500">SPBU besar dengan volume penjualan tinggi.</td>
                        </tr>
                        <!-- 24KL -->
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-4 font-bold text-slate-900 dark:text-white">24.000 Liter (24 KL)</td>
                            <td class="px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">3 - 4 Sekat</td>
                            <td class="px-5 py-4"><span class="inline-flex items-center px-2 py-1 text-xs font-bold bg-pertamina-blue/10 text-pertamina-blue dark:bg-blue-900/30 dark:text-blue-400 border border-pertamina-blue/20 rounded-lg">Trailer / Tractor Head</span></td>
                            <td class="px-5 py-4 text-xs hidden md:table-cell text-slate-500">Distribusi antar depo atau SPBU besar di jalur lintas provinsi.</td>
                        </tr>
                        <!-- 32KL -->
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-4 font-bold text-slate-900 dark:text-white">32.000 Liter (32 KL)</td>
                            <td class="px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">4 Sekat</td>
                            <td class="px-5 py-4"><span class="inline-flex items-center px-2 py-1 text-xs font-bold bg-pertamina-blue/10 text-pertamina-blue dark:bg-blue-900/30 dark:text-blue-400 border border-pertamina-blue/20 rounded-lg">Trailer / Tractor Head</span></td>
                            <td class="px-5 py-4 text-xs hidden md:table-cell text-slate-500">Distribusi jarak jauh (Long Haul) antar terminal BBM.</td>
                        </tr>
                        <!-- 40KL -->
                        <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                            <td class="px-5 py-4 font-bold text-slate-900 dark:text-white">40.000 Liter (40 KL)</td>
                            <td class="px-5 py-4 font-semibold text-slate-600 dark:text-slate-400">4 - 5 Sekat</td>
                            <td class="px-5 py-4"><span class="inline-flex items-center px-2 py-1 text-xs font-bold bg-pertamina-red/10 text-pertamina-red dark:bg-red-900/30 dark:text-red-400 border border-pertamina-red/20 rounded-lg">Trailer (Giga/Scania)</span></td>
                            <td class="px-5 py-4 text-xs hidden md:table-cell text-slate-500">Distribusi skala besar dari Terminal BBM ke wilayah industri atau depo.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t bg-slate-50/50 dark:bg-slate-800/20 border-slate-200/50 dark:border-slate-800">
                <p class="text-xs font-semibold text-slate-500">Total: <span class="text-slate-900 dark:text-white">6</span> Klasifikasi Armada Aktif</p>
            </div>
        </div>

    </div>
</div>

{{-- ================= MODAL BBM ================= --}}
<div id="modalBBM" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="absolute inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeModal('modalBBM')"></div>
        <div class="relative w-full max-w-sm transition-all transform border shadow-2xl bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 border-white/50 dark:border-slate-700 rounded-2xl modal-content">
            <div class="p-6 text-center border-b border-slate-200/50 dark:border-slate-800 bg-orange-500/10">
                <div class="flex items-center justify-center mx-auto mb-3 text-white shadow-md size-12 rounded-xl bg-gradient-to-br from-orange-400 to-amber-500">
                    <span class="text-2xl material-symbols-outlined">water_drop</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tambah Master BBM</h3>
            </div>
            <div class="p-6 space-y-4 text-left border-b border-slate-200/50 dark:border-slate-800">
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Nama BBM</label>
                    <input type="text" class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-orange-500 focus:ring-2 focus:ring-orange-200" placeholder="Pertalite">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kode Unik</label>
                    <input type="text" class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-orange-500 focus:ring-2 focus:ring-orange-200" placeholder="PRTL">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Status</label>
                    <select class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-orange-500 focus:ring-2 focus:ring-orange-200">
                        <option>Aktif</option>
                        <option>Non-Aktif</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-3 p-4 bg-slate-50/50 dark:bg-slate-800/50">
                <button onclick="closeModal('modalBBM')" class="flex-1 px-4 py-2.5 text-sm font-semibold transition-all bg-white border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl hover:bg-slate-50">Batal</button>
                <button onclick="closeModal('modalBBM')" class="flex items-center justify-center flex-1 gap-2 px-4 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 hover:scale-105">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL KENDARAAN / ARMADA ================= --}}
<div id="modalKendaraan" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="absolute inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeModal('modalKendaraan')"></div>
        <div class="relative w-full max-w-lg transition-all transform border shadow-2xl bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 border-white/50 dark:border-slate-700 rounded-2xl modal-content">
            <div class="p-6 text-center border-b border-slate-200/50 dark:border-slate-800 bg-slate-100 dark:bg-slate-800">
                <div class="flex items-center justify-center mx-auto mb-3 text-white shadow-md size-12 rounded-xl bg-slate-700 dark:bg-slate-600">
                    <span class="text-2xl material-symbols-outlined">local_shipping</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Tambah Klasifikasi Armada</h3>
            </div>
            <div class="p-6 space-y-4 text-left border-b border-slate-200/50 dark:border-slate-800">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kapasitas Total</label>
                        <input type="text" class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="Ex: 8.000 Liter (8 KL)">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Jml Kompartemen</label>
                        <input type="text" class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="Ex: 1 - 2 Sekat">
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Jenis Kendaraan</label>
                    <input type="text" class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="Ex: Rigid Truck (6 Roda)">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Peruntukan Utama (Deskripsi)</label>
                    <textarea rows="3" class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200" placeholder="Deskripsi area operasi..."></textarea>
                </div>
            </div>
            <div class="flex gap-3 p-4 bg-slate-50/50 dark:bg-slate-800/50">
                <button onclick="closeModal('modalKendaraan')" class="flex-1 px-4 py-2.5 text-sm font-semibold transition-all bg-white border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl hover:bg-slate-50">Batal</button>
                <button onclick="closeModal('modalKendaraan')" class="flex items-center justify-center flex-1 gap-2 px-4 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-slate-800 hover:scale-105">Simpan Data</button>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        ['modalBBM', 'modalKendaraan'].forEach(id => {
            const m = document.getElementById(id);
            if (m && !m.classList.contains('hidden')) closeModal(id);
        });
    }
});
</script>
@endsection
