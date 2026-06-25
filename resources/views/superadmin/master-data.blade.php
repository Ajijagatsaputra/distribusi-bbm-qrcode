@extends('layouts.superadmin')

@section('title', 'Master Data Management')

@section('content')
    <div class="animate-slide-in">

        {{-- ===== HEADER SECTION ===== --}}
        <div class="mb-8">
            <h1 class="mb-2 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                Master Data <span class="text-pertamina-blue">Manajemen</span>
            </h1>
            <p class="text-sm text-slate-600 dark:text-slate-400">Pusat kontrol data utama sistem distribusi BBM (BBM, SPBU,
                dan Armada)</p>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
            <div
                class="mb-6 flex items-center gap-3 px-4 py-3 bg-pertamina-green/10 border border-pertamina-green/30 rounded-xl text-pertamina-green font-semibold text-sm">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div
                class="mb-6 flex items-center gap-3 px-4 py-3 bg-pertamina-red/10 border border-pertamina-red/30 rounded-xl text-pertamina-red font-semibold text-sm">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif

        {{-- ===== STATISTIK ===== --}}
        <div class="grid grid-cols-1 gap-4 mb-10 sm:grid-cols-2 lg:grid-cols-4 md:gap-6">
            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Total Transaksi Selesai</p>
                    <div class="flex items-center justify-center rounded-lg size-10 bg-pertamina-blue/10">
                        <span class="text-xl material-symbols-outlined text-pertamina-blue">receipt_long</span>
                    </div>
                </div>
                <h4 class="text-4xl font-black text-slate-900 dark:text-white">
                    {{ number_format($stats['total_distributions'] ?? 0, 0, ',', '.') }}</h4>
                <div class="flex items-center mt-3 text-xs text-pertamina-green">
                    <span class="text-[14px] material-symbols-outlined mr-1">trending_up</span>
                    <span class="font-bold">Realtime</span>
                    <span class="ml-1 text-slate-400">di database</span>
                </div>
            </div>

            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">SPBU Aktif</p>
                    <div class="flex items-center justify-center rounded-lg size-10 bg-pertamina-green/10">
                        <span class="text-xl material-symbols-outlined text-pertamina-green">local_gas_station</span>
                    </div>
                </div>
                <h4 class="text-4xl font-black text-slate-900 dark:text-white">
                    {{ number_format($stats['total_spbu'] ?? 0, 0, ',', '.') }}</h4>
                <div class="flex items-center mt-3 text-xs text-slate-500">
                    <span class="text-[14px] material-symbols-outlined mr-1 text-pertamina-green">verified</span>
                    <span class="font-bold text-slate-600 dark:text-slate-300">Aktif</span>
                    <span class="ml-1">dalam sistem</span>
                </div>
            </div>

            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Jenis BBM Disalurkan</p>
                    <div class="flex items-center justify-center rounded-lg size-10 bg-orange-500/10">
                        <span class="text-xl text-orange-500 material-symbols-outlined">water_drop</span>
                    </div>
                </div>
                <h4 class="text-4xl font-black text-slate-900 dark:text-white">
                    {{ number_format($stats['total_fuel_types'] ?? 0, 0, ',', '.') }}</h4>
                <div class="flex items-center mt-3 text-xs text-slate-500">
                    <span class="text-[14px] material-symbols-outlined mr-1 text-orange-500">category</span>
                    <span class="ml-1">Varian produk aktif</span>
                </div>
            </div>

            <div
                class="p-6 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Armada Terdaftar</p>
                    <div class="flex items-center justify-center rounded-lg size-10 bg-slate-100 dark:bg-slate-800">
                        <span
                            class="text-xl text-slate-700 dark:text-slate-300 material-symbols-outlined">local_shipping</span>
                    </div>
                </div>
                <h4 class="text-4xl font-black text-slate-900 dark:text-white">
                    {{ number_format($stats['total_vehicle_types'] ?? 0, 0, ',', '.') }}</h4>
                <div class="flex items-center mt-3 text-xs text-slate-500">
                    <span class="text-[14px] material-symbols-outlined mr-1">speed</span>
                    <span class="ml-1">Kategori armada</span>
                </div>
            </div>
        </div>

        {{-- ===== DATA TABLES ===== --}}
        <div class="space-y-6">

            {{-- ROW 1: Fuel Types (1/3) & Vehicle Types (2/3) --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- MASTER BBM (1/3 Width) --}}
                <div
                    class="flex flex-col overflow-hidden bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                    <div
                        class="flex items-center justify-between p-5 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                        <h4 class="text-base font-bold text-slate-900 dark:text-white"><span
                                class="material-symbols-outlined text-[18px] mr-1 align-bottom text-orange-500">water_drop</span>
                            Master BBM</h4>
                        <button type="button" onclick="openFuelModal('add')"
                            class="flex items-center gap-1 px-3 py-1.5 text-xs font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 hover:scale-105 shadow-glow-amber">
                            <span class="text-[16px] material-symbols-outlined">add</span>
                            Tambah
                        </button>
                    </div>
                    <div class="flex-1 overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                                <tr>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                        BBM</th>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                        Kode</th>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                        Status</th>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800 text-right">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($fuelTypes as $fuel)
                                    <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30"
                                        id="fuel-row-{{ $fuel->id }}">
                                        <td class="px-5 py-3 font-bold text-slate-900 dark:text-white name-cell">
                                            {{ $fuel->name }}</td>
                                        <td class="px-5 py-3"><span
                                                class="px-2 py-1 text-[10px] font-bold uppercase rounded-lg bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 code-cell">{{ $fuel->code }}</span>
                                        </td>
                                        <td class="px-5 py-3">
                                            @if($fuel->status === 'aktif')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2 py-0.5 text-[10px] font-bold uppercase rounded-full bg-pertamina-green/10 text-pertamina-green status-cell"
                                                    data-status="aktif"><span
                                                        class="w-1.5 h-1.5 bg-pertamina-green rounded-full"></span>Aktif</span>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2 py-0.5 text-[10px] font-bold uppercase rounded-full bg-slate-100 text-slate-500 dark:bg-slate-800 status-cell"
                                                    data-status="nonaktif"><span
                                                        class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3 text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <button onclick="openFuelModal('edit', {{ $fuel->id }})"
                                                    class="p-1 text-orange-500 hover:bg-orange-500/10 rounded transition-colors"><span
                                                        class="material-symbols-outlined text-[16px]">edit</span></button>
                                                <button onclick="openDeleteModal('fuel', {{ $fuel->id }})"
                                                    class="p-1 text-pertamina-red hover:bg-pertamina-red/10 rounded transition-colors"><span
                                                        class="material-symbols-outlined text-[16px]">delete</span></button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-5 py-6 text-center text-slate-400 font-medium">Belum ada data
                                            BBM.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="px-5 py-3 border-t bg-slate-50/50 dark:bg-slate-800/20 border-slate-200/50 dark:border-slate-800">
                        <p class="text-xs font-semibold text-slate-500">Total: <span
                                class="text-slate-900 dark:text-white">{{ $fuelTypes->count() }}</span> Data Tersimpan</p>
                    </div>
                </div>

                {{-- MASTER ARMADA / KENDARAAN (2/3 Width) --}}
                <div
                    class="flex flex-col overflow-hidden bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 lg:col-span-2">
                    <div
                        class="flex items-center justify-between p-5 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                        <div class="flex flex-col">
                            <h4 class="text-base font-bold text-slate-900 dark:text-white"><span
                                    class="material-symbols-outlined text-[18px] mr-1 align-bottom text-slate-700 dark:text-slate-300">local_shipping</span>
                                Master Kapasitas & Jenis Armada</h4>
                            <p class="text-xs text-slate-500">Spesifikasi dimensi armada angkut distribusi BBM Pertamina</p>
                        </div>
                        <button type="button" onclick="openVehicleModal('add')"
                            class="flex items-center gap-1 px-3 py-1.5 text-xs font-bold text-slate-700 dark:text-slate-300 transition-all shadow-sm rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700">
                            <span class="text-[16px] material-symbols-outlined">add</span>
                            Tambah Klasifikasi
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left border-collapse">
                            <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                                <tr>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                        Kapasitas</th>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                        Jml Kompartemen</th>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                        Jenis Kendaraan</th>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider hidden md:table-cell text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                        Deskripsi</th>
                                    <th
                                        class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800 text-right">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($vehicleTypes as $vt)
                                    <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30"
                                        id="vehicle-row-{{ $vt->id }}">
                                        <td class="px-5 py-4 font-bold text-slate-900 dark:text-white capacity-cell"
                                            data-liter="{{ $vt->capacity_liter }}">{{ $vt->capacity }}</td>
                                        <td
                                            class="px-5 py-4 font-semibold text-slate-600 dark:text-slate-400 compartments-cell">
                                            {{ $vt->compartments }}</td>
                                        <td class="px-5 py-4"><span
                                                class="inline-flex items-center px-2 py-1 text-xs font-bold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg type-cell">{{ $vt->vehicle_type }}</span>
                                        </td>
                                        <td class="px-5 py-4 text-xs hidden md:table-cell text-slate-500 desc-cell">
                                            {{ $vt->description }}</td>
                                        <td class="px-5 py-3 text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <button onclick="openVehicleModal('edit', {{ $vt->id }})"
                                                    class="p-1 text-orange-500 hover:bg-orange-500/10 rounded transition-colors"><span
                                                        class="material-symbols-outlined text-[16px]">edit</span></button>
                                                <button onclick="openDeleteModal('vehicle', {{ $vt->id }})"
                                                    class="p-1 text-pertamina-red hover:bg-pertamina-red/10 rounded transition-colors"><span
                                                        class="material-symbols-outlined text-[16px]">delete</span></button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-6 text-center text-slate-400 font-medium">Belum ada data
                                            armada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="px-5 py-3 border-t bg-slate-50/50 dark:bg-slate-800/20 border-slate-200/50 dark:border-slate-800">
                        <p class="text-xs font-semibold text-slate-500">Total: <span
                                class="text-slate-900 dark:text-white">{{ $vehicleTypes->count() }}</span> Klasifikasi
                            Armada Aktif</p>
                    </div>
                </div>

            </div>

            {{-- ROW 2: SPBUs --}}
            <div
                class="flex flex-col overflow-hidden bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800">
                <div
                    class="flex items-center justify-between p-5 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                    <div class="flex flex-col">
                        <h4 class="text-base font-bold text-slate-900 dark:text-white"><span
                                class="material-symbols-outlined text-[18px] mr-1 align-bottom text-pertamina-blue">local_gas_station</span>
                            Master SPBU Terdaftar</h4>
                        <p class="text-xs text-slate-500">Daftar Stasiun Pengisian Bahan Bakar Umum (SPBU) yang terhubung ke
                            jaringan distribusi</p>
                    </div>
                    <button type="button" onclick="openSpbuModal('add')"
                        class="flex items-center gap-1 px-4 py-2 text-xs font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:scale-105 shadow-glow-blue">
                        <span class="text-[16px] material-symbols-outlined">add</span>
                        Tambah SPBU Baru
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left border-collapse">
                        <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                            <tr>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                    Kode SPBU</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                    Nama SPBU</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                    Alamat</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                    Kota</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800">
                                    Status</th>
                                <th
                                    class="px-5 py-3 text-xs font-bold tracking-wider text-slate-500 uppercase border-b border-slate-200/50 dark:border-slate-800 text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                            @forelse($spbus as $spbu)
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30"
                                    id="spbu-row-{{ $spbu->id }}">
                                    <td class="px-5 py-4 font-bold text-slate-900 dark:text-white code-cell">{{ $spbu->code }}
                                    </td>
                                    <td class="px-5 py-4 font-semibold text-slate-700 dark:text-slate-300 name-cell">
                                        {{ $spbu->name }}</td>
                                    <td class="px-5 py-4 text-slate-600 dark:text-slate-400 address-cell">{{ $spbu->address }}
                                    </td>
                                    <td class="px-5 py-4 text-slate-600 dark:text-slate-400 city-cell">{{ $spbu->city }}</td>
                                    <td class="px-5 py-4">
                                        @if($spbu->status === 'aktif')
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold uppercase rounded-full bg-pertamina-green/10 text-pertamina-green status-cell"
                                                data-status="aktif"><span
                                                    class="w-1.5 h-1.5 bg-pertamina-green rounded-full"></span>Aktif</span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-0.5 text-[10px] font-bold uppercase rounded-full bg-slate-100 text-slate-500 dark:bg-slate-800 status-cell"
                                                data-status="nonaktif"><span
                                                    class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <button onclick="openSpbuModal('edit', {{ $spbu->id }})"
                                                class="p-1 text-orange-500 hover:bg-orange-500/10 rounded transition-colors"><span
                                                    class="material-symbols-outlined text-[16px]">edit</span></button>
                                            <button onclick="openDeleteModal('spbu', {{ $spbu->id }})"
                                                class="p-1 text-pertamina-red hover:bg-pertamina-red/10 rounded transition-colors"><span
                                                    class="material-symbols-outlined text-[16px]">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-6 text-center text-slate-400 font-medium">Belum ada data
                                        SPBU.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div
                    class="px-5 py-3 border-t bg-slate-50/50 dark:bg-slate-800/20 border-slate-200/50 dark:border-slate-800">
                    <p class="text-xs font-semibold text-slate-500">Total: <span
                            class="text-slate-900 dark:text-white">{{ $spbus->count() }}</span> SPBU Aktif</p>
                </div>
            </div>

        </div>
    </div>

    {{-- ================= MODAL BBM ================= --}}
    <div id="modalBBM" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="absolute inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm"
                onclick="closeModal('modalBBM')"></div>
            <div
                class="relative w-full max-w-sm transition-all transform border shadow-2xl bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 border-white/50 dark:border-slate-700 rounded-2xl modal-content">
                <form id="fuelForm" method="POST" action="">
                    @csrf
                    <input type="hidden" id="fuel-method" name="_method" value="POST">
                    <div class="p-6 text-center border-b border-slate-200/50 dark:border-slate-800 bg-orange-500/10">
                        <div
                            class="flex items-center justify-center mx-auto mb-3 text-white shadow-md size-12 rounded-xl bg-gradient-to-br from-orange-400 to-amber-500">
                            <span class="text-2xl material-symbols-outlined">water_drop</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white" id="fuel-modal-title">Tambah Master BBM
                        </h3>
                    </div>
                    <div class="p-6 space-y-4 text-left border-b border-slate-200/50 dark:border-slate-800">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Nama
                                BBM</label>
                            <input type="text" id="fuel-name" name="name"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                placeholder="Pertalite" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kode
                                Unik</label>
                            <input type="text" id="fuel-code" name="code"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                placeholder="PRTL" required>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Status</label>
                            <select id="fuel-status" name="status"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-orange-500 focus:ring-2 focus:ring-orange-200"
                                required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 p-4 bg-slate-50/50 dark:bg-slate-800/50">
                        <button type="button" onclick="closeModal('modalBBM')"
                            class="flex-1 px-4 py-2.5 text-sm font-semibold transition-all bg-white border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl hover:bg-slate-50">Batal</button>
                        <button type="submit"
                            class="flex items-center justify-center flex-1 gap-2 px-4 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 hover:scale-105">Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= MODAL KENDARAAN / ARMADA ================= --}}
    <div id="modalKendaraan" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="absolute inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm"
                onclick="closeModal('modalKendaraan')"></div>
            <div
                class="relative w-full max-w-lg transition-all transform border shadow-2xl bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 border-white/50 dark:border-slate-700 rounded-2xl modal-content">
                <form id="vehicleForm" method="POST" action="">
                    @csrf
                    <input type="hidden" id="vehicle-method" name="_method" value="POST">
                    <div
                        class="p-6 text-center border-b border-slate-200/50 dark:border-slate-800 bg-slate-100 dark:bg-slate-800">
                        <div
                            class="flex items-center justify-center mx-auto mb-3 text-white shadow-md size-12 rounded-xl bg-slate-700 dark:bg-slate-600">
                            <span class="text-2xl material-symbols-outlined">local_shipping</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white" id="vehicle-modal-title">Tambah
                            Klasifikasi Armada</h3>
                    </div>
                    <div class="p-6 space-y-4 text-left border-b border-slate-200/50 dark:border-slate-800">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kapasitas
                                    (Teks)</label>
                                <input type="text" id="vehicle-capacity" name="capacity"
                                    class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                    placeholder="Ex: 8.000 Liter (8 KL)" required>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kapasitas
                                    (Liter)</label>
                                <input type="number" id="vehicle-capacity-liter" name="capacity_liter"
                                    class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                    placeholder="Ex: 8000" required>
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Jml
                                Kompartemen / Sekat</label>
                            <input type="text" id="vehicle-compartments" name="compartments"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                placeholder="Ex: 1 - 2 Sekat" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Jenis
                                Kendaraan</label>
                            <input type="text" id="vehicle-type" name="vehicle_type"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                placeholder="Ex: Rigid Truck (6 Roda)" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Peruntukan
                                Utama (Deskripsi)</label>
                            <textarea id="vehicle-description" name="description" rows="3"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                placeholder="Deskripsi area operasi..."></textarea>
                        </div>
                    </div>
                    <div class="flex gap-3 p-4 bg-slate-50/50 dark:bg-slate-800/50">
                        <button type="button" onclick="closeModal('modalKendaraan')"
                            class="flex-1 px-4 py-2.5 text-sm font-semibold transition-all bg-white border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl hover:bg-slate-50">Batal</button>
                        <button type="submit"
                            class="flex items-center justify-center flex-1 gap-2 px-4 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-slate-800 hover:scale-105">Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= MODAL SPBU ================= --}}
    <div id="modalSpbu" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="absolute inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm"
                onclick="closeModal('modalSpbu')"></div>
            <div
                class="relative w-full max-w-lg transition-all transform border shadow-2xl bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 border-white/50 dark:border-slate-700 rounded-2xl modal-content">
                <form id="spbuForm" method="POST" action="">
                    @csrf
                    <input type="hidden" id="spbu-method" name="_method" value="POST">
                    <div class="p-6 text-center border-b border-slate-200/50 dark:border-slate-800 bg-pertamina-blue/10">
                        <div
                            class="flex items-center justify-center mx-auto mb-3 text-white shadow-md size-12 rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-600">
                            <span class="text-2xl material-symbols-outlined">local_gas_station</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white" id="spbu-modal-title">Tambah Master
                            SPBU</h3>
                    </div>
                    <div class="p-6 space-y-4 text-left border-b border-slate-200/50 dark:border-slate-800">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Nama
                                SPBU</label>
                            <input type="text" id="spbu-name" name="name"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20"
                                placeholder="SPBU 34.123.01" required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kode
                                SPBU</label>
                            <input type="text" id="spbu-code" name="code"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20"
                                placeholder="34.123.01" required>
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Alamat</label>
                            <input type="text" id="spbu-address" name="address"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20"
                                placeholder="Jl. Sudirman No. 10">
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kota /
                                Kabupaten</label>
                            <input type="text" id="spbu-city" name="city"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20"
                                placeholder="Bandung">
                        </div>
                        <div>
                            <label
                                class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Status</label>
                            <select id="spbu-status" name="status"
                                class="w-full px-4 py-2.5 text-sm transition-all border outline-none rounded-xl bg-white/50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20"
                                required>
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex gap-3 p-4 bg-slate-50/50 dark:bg-slate-800/50">
                        <button type="button" onclick="closeModal('modalSpbu')"
                            class="flex-1 px-4 py-2.5 text-sm font-semibold transition-all bg-white border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl hover:bg-slate-50">Batal</button>
                        <button type="submit"
                            class="flex items-center justify-center flex-1 gap-2 px-4 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:scale-105">Simpan
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL DELETE GENERAL --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm"
                onclick="closeModal('deleteModal')"></div>
            <div
                class="relative w-full max-w-sm overflow-hidden text-left align-bottom transition-all transform border shadow-2xl border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div class="p-6 text-center">
                    <div
                        class="flex items-center justify-center mx-auto mb-4 rounded-full size-16 bg-pertamina-red/10 animate-pulse">
                        <span class="text-3xl material-symbols-outlined text-pertamina-red">delete_sweep</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Hapus Data Master?</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Tindakan ini tidak dapat dibatalkan. Data akan
                        dihapus secara permanen dari sistem.</p>
                </div>
                <div
                    class="flex justify-center gap-3 px-6 py-4 border-t bg-slate-50/50 dark:bg-slate-800/50 border-slate-200/50 dark:border-slate-800">
                    <button type="button" onclick="closeModal('deleteModal')"
                        class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-xl hover:bg-slate-50">Batal</button>
                    <button type="button" id="confirmDeleteBtn"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-pertamina-red rounded-xl hover:shadow-lg hover:scale-105 transition-all">Ya,
                        Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <form id="deleteForm" method="POST" action="" class="hidden">
        @csrf
        @method('DELETE')
    </form>

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

        // FUEL (BBM) MODAL
        function openFuelModal(mode, id = null) {
            const form = document.getElementById('fuelForm');
            if (mode === 'add') {
                form.reset();
                form.action = "{{ route('superadmin.master-data.fuel.store') }}";
                document.getElementById('fuel-method').value = "POST";
                document.getElementById('fuel-modal-title').textContent = "Tambah Master BBM";
            } else {
                const row = document.getElementById('fuel-row-' + id);
                form.action = "/superadmin/master-data/fuel/" + id;
                document.getElementById('fuel-method').value = "PUT";
                document.getElementById('fuel-modal-title').textContent = "Edit Master BBM";

                document.getElementById('fuel-name').value = row.querySelector('.name-cell').textContent.trim();
                document.getElementById('fuel-code').value = row.querySelector('.code-cell').textContent.trim();
                document.getElementById('fuel-status').value = row.querySelector('.status-cell').dataset.status;
            }
            openModal('modalBBM');
        }

        // VEHICLE MODAL
        function openVehicleModal(mode, id = null) {
            const form = document.getElementById('vehicleForm');
            if (mode === 'add') {
                form.reset();
                form.action = "{{ route('superadmin.master-data.vehicle.store') }}";
                document.getElementById('vehicle-method').value = "POST";
                document.getElementById('vehicle-modal-title').textContent = "Tambah Klasifikasi Armada";
            } else {
                const row = document.getElementById('vehicle-row-' + id);
                form.action = "/superadmin/master-data/vehicle/" + id;
                document.getElementById('vehicle-method').value = "PUT";
                document.getElementById('vehicle-modal-title').textContent = "Edit Klasifikasi Armada";

                document.getElementById('vehicle-capacity').value = row.querySelector('.capacity-cell').textContent.trim();
                document.getElementById('vehicle-capacity-liter').value = row.querySelector('.capacity-cell').dataset.liter;
                document.getElementById('vehicle-compartments').value = row.querySelector('.compartments-cell').textContent.trim();
                document.getElementById('vehicle-type').value = row.querySelector('.type-cell').textContent.trim();
                document.getElementById('vehicle-description').value = row.querySelector('.desc-cell').textContent.trim();
            }
            openModal('modalKendaraan');
        }

        // SPBU MODAL
        function openSpbuModal(mode, id = null) {
            const form = document.getElementById('spbuForm');
            if (mode === 'add') {
                form.reset();
                form.action = "{{ route('superadmin.master-data.spbu.store') }}";
                document.getElementById('spbu-method').value = "POST";
                document.getElementById('spbu-modal-title').textContent = "Tambah Master SPBU";
            } else {
                const row = document.getElementById('spbu-row-' + id);
                form.action = "/superadmin/master-data/spbu/" + id;
                document.getElementById('spbu-method').value = "PUT";
                document.getElementById('spbu-modal-title').textContent = "Edit Master SPBU";

                document.getElementById('spbu-name').value = row.querySelector('.name-cell').textContent.trim();
                document.getElementById('spbu-code').value = row.querySelector('.code-cell').textContent.trim();
                document.getElementById('spbu-address').value = row.querySelector('.address-cell').textContent.trim();
                document.getElementById('spbu-city').value = row.querySelector('.city-cell').textContent.trim();
                document.getElementById('spbu-status').value = row.querySelector('.status-cell').dataset.status;
            }
            openModal('modalSpbu');
        }

        // DELETE MODAL
        function openDeleteModal(type, id) {
            const deleteForm = document.getElementById('deleteForm');
            let url = "";
            if (type === 'fuel') {
                url = "/superadmin/master-data/fuel/" + id;
            } else if (type === 'vehicle') {
                url = "/superadmin/master-data/vehicle/" + id;
            } else if (type === 'spbu') {
                url = "/superadmin/master-data/spbu/" + id;
            }
            deleteForm.action = url;
            openModal('deleteModal');
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            document.getElementById('deleteForm').submit();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                ['modalBBM', 'modalKendaraan', 'modalSpbu', 'deleteModal'].forEach(id => {
                    const m = document.getElementById(id);
                    if (m && !m.classList.contains('hidden')) closeModal(id);
                });
            }
        });
    </script>
@endsection