@extends('layouts.admin')

@section('title', 'QR Code Management')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="flex flex-wrap items-center justify-between gap-4 mb-8 animate-slide-in">
        <div>
            <h3 class="flex items-center gap-3 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
                <span
                    class="p-2 transition-all bg-blue-100 rounded-lg dark:bg-blue-500/20 shadow-glow-blue hover:scale-110">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[28px]">qr_code_2</span>
                </span>
                QR Code Management
            </h3>
            <p class="flex items-center gap-2 mt-2 text-slate-600 dark:text-slate-400">
                <span class="w-2 h-2 rounded-full bg-pertamina-blue pulse-live"></span>
                Manajemen dan Validasi Distribusi BBM via QR Code
            </p>
        </div>
        <div class="flex gap-3">
            <button onclick="openGenerateModal()"
                class="flex items-center gap-2 px-6 py-3 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-blue-500 to-blue-700 shadow-glow-blue hover:shadow-xl hover:scale-105">
                <span class="text-xl material-symbols-outlined">add_circle</span>
                Generate QR Code
            </button>
        </div>
    </div>

    {{-- NOTIFICATION TOAST --}}
    <div id="toastNotification"
        class="fixed top-24 right-8 z-50 flex items-center gap-3 px-4 py-3 text-sm font-semibold text-white transition-all transform translate-x-full bg-slate-900 dark:bg-slate-800 rounded-xl shadow-2xl opacity-0">
        <span class="material-symbols-outlined text-pertamina-green">check_circle</span>
        <span id="toastMessage">Action successful!</span>
    </div>

    {{-- FILTER & STATS --}}
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4 animate-slide-in" style="animation-delay: 100ms;">
        <div
            class="p-5 transition-all duration-300 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Total QR Dibuat</p>
                <div class="p-2 bg-blue-100 dark:bg-blue-500/20 rounded-xl">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[20px]">qr_code_2</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-slate-900 dark:text-white" id="stat-total">{{ $stats['total'] }}</h3>
        </div>
        <div
            class="p-5 transition-all duration-300 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">QR Aktif</p>
                <div class="p-2 bg-emerald-100 dark:bg-emerald-500/20 rounded-xl">
                    <span
                        class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-[20px]">check_circle</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-emerald-600 dark:text-emerald-400" id="stat-aktif">{{ $stats['aktif'] }}
            </h3>
        </div>
        <div
            class="p-5 transition-all duration-300 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">QR Digunakan</p>
                <div class="p-2 bg-blue-100 dark:bg-blue-500/20 rounded-xl">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[20px]">verified</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-blue-600 dark:text-blue-400" id="stat-digunakan">{{ $stats['digunakan'] }}
            </h3>
        </div>
        <div
            class="p-5 transition-all duration-300 bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 hover:-translate-y-1 hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">QR Expired</p>
                <div class="p-2 bg-red-100 dark:bg-red-500/20 rounded-xl">
                    <span class="material-symbols-outlined text-red-500 dark:text-red-400 text-[20px]">cancel</span>
                </div>
            </div>
            <h3 class="text-3xl font-black text-red-500 dark:text-red-400" id="stat-expired">{{ $stats['expired'] }}</h3>
        </div>
    </div>

    {{-- TABLE AREA --}}
    <div class="overflow-hidden transition-all bg-white border shadow-glass backdrop-blur-md rounded-2xl border-slate-200/50 dark:bg-slate-900/70 dark:border-slate-800 animate-slide-in"
        style="animation-delay: 200ms;">
        <div
            class="flex flex-col gap-4 p-6 border-b md:flex-row md:items-center md:justify-between border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
            <h4 class="text-lg font-bold text-slate-900 dark:text-white">Daftar Data QR Code</h4>
            <div class="flex gap-3">
                <div class="relative">
                    <span
                        class="absolute -translate-y-1/2 material-symbols-outlined text-[18px] left-3 top-1/2 text-slate-400">search</span>
                    <input type="text" id="tableSearch" onkeyup="filterTable()" placeholder="Cari ID QR..."
                        class="w-full pl-9 pr-4 py-2 text-sm bg-white dark:bg-slate-800 border rounded-xl border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass transition-all">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500 dark:text-slate-400">
                            QR Code ID</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500 dark:text-slate-400">
                            SPBU</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500 dark:text-slate-400">
                            Jenis BBM</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500 dark:text-slate-400">
                            Kuota</th>
                        <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500 dark:text-slate-400">
                            Periode</th>
                        <th
                            class="px-6 py-4 text-xs font-bold tracking-wider text-center uppercase text-slate-500 dark:text-slate-400">
                            Status</th>
                        <th
                            class="px-6 py-4 text-xs font-bold tracking-wider text-right uppercase text-slate-500 dark:text-slate-400">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody id="qrTableBody" class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ($qrCodes as $index => $qr)
                        @php
                            $dot = 'bg-slate-500';
                            if ($qr->fuelType->code === 'PLT')
                                $dot = 'bg-emerald-500';
                            elseif ($qr->fuelType->code === 'PMX')
                                $dot = 'bg-blue-500';
                            elseif ($qr->fuelType->code === 'SLR')
                                $dot = 'bg-slate-700';

                            if ($qr->status === 'aktif') {
                                $class = 'text-emerald-700 bg-emerald-100 dark:bg-emerald-500/20 dark:text-emerald-400 border-emerald-200 dark:border-emerald-500/30';
                                $icon = 'check_circle';
                            } elseif ($qr->status === 'digunakan') {
                                $class = 'text-blue-700 bg-blue-100 dark:bg-blue-500/20 dark:text-blue-400 border-blue-200 dark:border-blue-500/30';
                                $icon = 'verified';
                            } else {
                                $class = 'text-red-700 bg-red-100 dark:bg-red-500/20 dark:text-red-400 border-red-200 dark:border-red-500/30';
                                $icon = 'cancel';
                            }
                        @endphp
                        <tr class="transition table-row hover:bg-slate-50 dark:hover:bg-slate-800/50" id="row-{{ $qr->id }}"
                            data-id="{{ $qr->id }}" data-qrid="{{ $qr->qr_id }}" data-spbu="{{ $qr->spbu->name }}"
                            data-bbm="{{ $qr->fuelType->name }}" data-kuota="{{ number_format($qr->kuota_liter, 0, ',', '.') }}"
                            data-start="{{ $qr->valid_from->format('Y-m-d') }}"
                            data-end="{{ $qr->valid_until->format('Y-m-d') }}" data-status="{{ ucfirst($qr->status) }}">
                            <td class="px-6 py-4">
                                <span
                                    class="font-mono text-xs font-bold text-slate-900 dark:text-white qrid-display">{{ $qr->qr_id }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white spbu-display">
                                {{ $qr->spbu->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold bg-slate-100/50 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg border border-slate-200/50">
                                    <span class="w-2 h-2 rounded-full {{ $dot }}"></span>
                                    <span class="bbm-display">{{ $qr->fuelType->name }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4"><span
                                    class="font-bold text-slate-900 dark:text-white kuota-display">{{ number_format($qr->kuota_liter, 0, ',', '.') }}</span>
                                Liter</td>
                            <td class="px-6 py-4 text-xs font-semibold text-slate-500 period-display">
                                {{ $qr->valid_from->format('d M') }} -
                                {{ $qr->valid_until->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="status-badge inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full border {{ $class }}">
                                    <span class="material-symbols-outlined text-[14px]">{{ $icon }}</span>
                                    <span class="status-text">{{ ucfirst($qr->status) }}</span>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick="viewQRDetail('{{ $qr->id }}')"
                                        class="p-2 transition rounded-lg text-pertamina-blue hover:bg-pertamina-blue/10 dark:hover:bg-blue-900/20 dark:text-blue-400 group"
                                        title="Lihat">
                                        <span
                                            class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">visibility</span>
                                    </button>
                                    <button onclick="openEditModal('{{ $qr->id }}')"
                                        class="p-2 transition rounded-lg text-orange-500 hover:bg-orange-500/10 dark:hover:bg-orange-900/20 dark:text-orange-400 group"
                                        title="Edit">
                                        <span
                                            class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">edit</span>
                                    </button>
                                    <button onclick="openDeleteModal('{{ $qr->id }}')"
                                        class="p-2 transition rounded-lg text-pertamina-red hover:bg-pertamina-red/10 dark:hover:bg-red-900/20 dark:text-red-400 group"
                                        title="Hapus">
                                        <span
                                            class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($qrCodes->hasPages())
            <div class="p-6 border-t border-slate-100 dark:border-slate-800">
                {{ $qrCodes->links() }}
            </div>
        @endif
    </div>

    {{-- MODALS --}}

    {{-- GENERATE QR MODAL --}}
    <div id="generateModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeGenerateModal()">
            </div>
            <div
                class="relative w-full max-w-2xl overflow-hidden text-left align-bottom transition-all transform border border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl shadow-glass dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div
                    class="px-6 py-5 border-b border-slate-200/50 dark:border-slate-800 bg-gradient-to-r from-blue-600/10 to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-12 h-12 shadow-md rounded-xl bg-gradient-to-br from-blue-500 to-blue-700">
                                <span class="text-2xl text-white material-symbols-outlined">qr_code_scanner</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Generate QR Code</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Buat QR Token baru untuk armada
                                    distribusi</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeGenerateModal()"
                            class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <span class="material-symbols-outlined text-slate-500">close</span>
                        </button>
                    </div>
                </div>

                <div class="px-6 py-6">
                    <!-- FORM -->
                    <form id="generateForm" class="space-y-4" onsubmit="event.preventDefault(); submitGenerateQR();">
                        <div class="p-6 text-center border-2 border-dashed rounded-xl border-blue-200 dark:border-blue-900 bg-blue-50/50 dark:bg-blue-900/10"
                            id="qrVisualArea">
                            <div class="relative inline-block w-40 h-40 mx-auto transition-transform hover:scale-105"
                                id="qrAnimationBox">
                                <div class="absolute inset-0 border-4 border-blue-500/30 rounded-xl"></div>
                                <!-- Scanner line -->
                                <div class="absolute top-0 left-0 w-full h-1 bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.8)] animate-pulse"
                                    id="scannerLine" style="animation: scan 2s infinite linear;"></div>
                                <div class="flex items-center justify-center h-full">
                                    <span class="text-blue-500/50 material-symbols-outlined text-[80px]">qr_code</span>
                                </div>
                            </div>
                            <p class="mt-4 text-xs font-bold tracking-widest text-blue-500 uppercase">System Ready</p>
                        </div>

                        <div id="genConfigFields">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">SPBU
                                        Target</label>
                                    <select id="genSpbu" name="spbu_id"
                                        class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 input-glass"
                                        required>
                                        <option value="">Pilih SPBU</option>
                                        @foreach($spbus as $spbu)
                                            <option value="{{ $spbu->id }}">{{ $spbu->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Jenis
                                        BBM</label>
                                    <select id="genBbm" name="fuel_type_id"
                                        class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 input-glass"
                                        required>
                                        <option value="">Pilih BBM</option>
                                        @foreach($fuelTypes as $ft)
                                            <option value="{{ $ft->id }}">{{ $ft->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Kuota
                                        (Liter)</label>
                                    <input type="number" id="genKuota"
                                        class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 input-glass"
                                        required />
                                </div>
                                <div>
                                    <label
                                        class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Durasi
                                        Validitas</label>
                                    <select id="genDurasi"
                                        class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 input-glass"
                                        required>
                                        <option value="1">1 Hari</option>
                                        <option value="2">2 Hari</option>
                                        <option value="3">3 Hari</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- SUCCESS PREVIEW -->
                        <div id="genSuccessArea" class="hidden text-center">
                            <div
                                class="inline-block p-4 mx-auto bg-white border border-blue-200 rounded-xl shadow-glass dark:bg-slate-100">
                                <!-- Real QR goes here -->
                                <div id="realQRCode" class="flex items-center justify-center w-32 h-32"></div>
                            </div>
                            <p class="mt-4 font-mono text-lg font-bold text-blue-600 dark:text-blue-400" id="genSuccessId">
                            </p>
                            <p class="text-sm font-medium text-emerald-500">QR Code generated successfully!</p>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200/50 dark:border-slate-800">
                            <button type="button" onclick="closeGenerateModal()"
                                class="px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 transition-all">
                                Tutup
                            </button>
                            <button type="submit" id="btnGen"
                                class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl hover:shadow-lg hover:scale-105 transition-all shadow-glow-blue">
                                <span class="flex items-center gap-2">
                                    <span class="text-lg material-symbols-outlined">bolt</span>
                                    Eksekusi Generate
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- VIEW QR MODAL --}}
    <div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeViewModal()"></div>
            <div
                class="relative w-full max-w-2xl overflow-hidden text-left align-bottom transition-all transform border border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl shadow-glass dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div
                    class="px-6 py-5 border-b border-slate-200/50 dark:border-slate-800 bg-gradient-to-r from-pertamina-blue/10 to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-600 shadow-glow-blue">
                                <span class="text-2xl text-white material-symbols-outlined">qr_code_2</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white" id="view-title">Detail QR Code
                                </h3>
                                <p class="font-mono text-sm font-semibold text-pertamina-blue" id="view-id">QR-ID</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeViewModal()"
                            class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <span class="material-symbols-outlined text-slate-500">close</span>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div
                            class="flex flex-col items-center justify-center p-6 border border-dashed rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                            <!-- Simulate QR view -->
                            <div
                                class="flex items-center justify-center p-3 bg-white border border-slate-200 size-40 rounded-xl shadow-sm">
                                <span class="text-slate-300 material-symbols-outlined text-[100px]">qr_code</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500">SPBU Tujuan</p>
                                <p id="view-spbu" class="text-base font-bold text-slate-900 dark:text-white">SPBU XXX</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="mb-1 text-xs font-semibold uppercase text-slate-500">Jenis BBM</p>
                                    <p id="view-bbm" class="text-base font-semibold text-slate-900 dark:text-white">
                                        Pertalite</p>
                                </div>
                                <div>
                                    <p class="mb-1 text-xs font-semibold uppercase text-slate-500">Kuota</p>
                                    <p id="view-kuota" class="text-base font-bold text-slate-900 dark:text-white">8.000 L
                                    </p>
                                </div>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500">Periode Aktif</p>
                                <p id="view-period" class="text-sm font-semibold text-slate-900 dark:text-white">07 Feb - 08
                                    Feb</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500">Status Terbaru</p>
                                <span id="view-status-container"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-bold rounded-full">
                                    <span class="text-sm material-symbols-outlined" id="view-status-icon">check</span>
                                    <span id="view-status-text">Status</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="flex justify-end gap-3 px-6 py-4 border-t bg-slate-50/50 dark:bg-slate-800/50 border-slate-200/50 dark:border-slate-800">
                    <button type="button" onclick="closeViewModal()"
                        class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border rounded-xl">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT QR MODAL --}}
    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeEditModal()"></div>
            <div
                class="relative w-full max-w-lg overflow-hidden text-left align-bottom transition-all transform border border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl shadow-glass dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div
                    class="px-6 py-5 border-b border-slate-200/50 dark:border-slate-800 bg-gradient-to-r from-orange-500/10 to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-12 h-12 shadow-md rounded-xl bg-gradient-to-br from-orange-500 to-amber-500">
                                <span class="text-2xl text-white material-symbols-outlined">edit</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Edit QR Code Data</h3>
                                <p id="edit-subtitle" class="text-sm font-mono text-orange-600 dark:text-orange-400">QR-ID
                                </p>
                            </div>
                        </div>
                        <button type="button" onclick="closeEditModal()"
                            class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <span class="material-symbols-outlined text-slate-500">close</span>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-6">
                    <form id="editForm" class="space-y-4" onsubmit="event.preventDefault(); submitEdit();">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Ubah Kuota
                                (Liter)</label>
                            <input type="number" id="edit-kuota"
                                class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 focus:ring-2 focus:ring-orange-500/20 input-glass"
                                required />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Status
                                Validasi</label>
                            <select id="edit-status"
                                class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 focus:ring-2 focus:ring-orange-500/20 input-glass"
                                required>
                                <option>Aktif</option>
                                <option>Digunakan</option>
                                <option>Expired</option>
                            </select>
                        </div>
                        <div
                            class="p-3 mt-4 text-xs font-medium border rounded-xl bg-orange-50 dark:bg-orange-500/10 text-orange-800 dark:text-orange-400 border-orange-200 dark:border-orange-500/30">
                            Informasi SPBU dan Jenis BBM tidak bisa diedit setelah di-generate. Silakan generate ulang jika
                            ada kesalahan fatal.
                        </div>
                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200/50">
                            <button type="button" onclick="closeEditModal()"
                                class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white dark:bg-slate-800 border rounded-xl">Batal</button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-orange-500 to-amber-600 rounded-xl shadow-lg hover:scale-105">Simpan
                                Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE QR MODAL --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeDeleteModal()">
            </div>
            <div
                class="relative w-full max-w-sm overflow-hidden text-left align-bottom transition-all transform border shadow-2xl border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div class="p-6 text-center">
                    <div
                        class="flex items-center justify-center mx-auto mb-4 rounded-full size-16 bg-pertamina-red/10 animate-pulse">
                        <span class="text-3xl material-symbols-outlined text-pertamina-red">warning</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Hapus Data QR?</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">QR Code <strong id="delete-qr-id"
                            class="text-pertamina-red"></strong> akan dihapus sementara dari sistem pemantauan.</p>
                </div>
                <div class="flex justify-center gap-3 px-6 py-4 border-t bg-slate-50/50 dark:bg-slate-800/50">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white rounded-xl">Batal</button>
                    <button type="button" id="confirmDeleteBtn"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-pertamina-red rounded-xl hover:shadow-lg hover:scale-105">Ya,
                        Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes scan {
            0% {
                top: 0;
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                top: 100%;
                opacity: 0;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>

    <script>
        // System Helpers
        function showToast(message) {
            const toast = document.getElementById('toastNotification');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('translate-x-full', 'opacity-0');
            setTimeout(() => toast.classList.add('translate-x-full', 'opacity-0'), 3000);
        }
        function toggleModal(id, show) {
            const el = document.getElementById(id);
            if (show) { el.classList.remove('hidden'); document.body.style.overflow = 'hidden'; }
            else { el.classList.add('hidden'); document.body.style.overflow = 'auto'; }
        }

        // Modal Components
        function openGenerateModal() {
            document.getElementById('generateForm').reset();
            document.getElementById('genConfigFields').classList.remove('hidden');
            document.getElementById('btnGen').classList.remove('hidden');
            document.getElementById('genSuccessArea').classList.add('hidden');
            document.getElementById('qrVisualArea').classList.remove('hidden');
            toggleModal('generateModal', true);
        }
        function closeGenerateModal() { toggleModal('generateModal', false); }
        function submitGenerateQR() {
            const spbuId = document.getElementById('genSpbu').value;
            const bbmId = document.getElementById('genBbm').value;
            const kuota = document.getElementById('genKuota').value;
            const durasi = document.getElementById('genDurasi').value;

            if (!spbuId || !bbmId || !kuota) {
                alert('Harap lengkapi semua field!');
                return;
            }

            // Tampilkan loading state
            const btnGen = document.getElementById('btnGen');
            btnGen.disabled = true;
            btnGen.innerHTML = '<span class="flex items-center gap-2"><span class="material-symbols-outlined animate-spin">sync</span> Memproses...</span>';

            fetch('{{ route('admin.qr-codes.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content
                        || '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    spbu_id: spbuId,
                    fuel_type_id: bbmId,
                    kuota_liter: kuota,
                    durasi: durasi,
                }),
            })
                .then(r => r.json())
                .then(data => {
                    if (!data.success) throw new Error(data.message || 'Gagal generate QR');

                    // Sembunyikan form, tampilkan area sukses
                    document.getElementById('genConfigFields').classList.add('hidden');
                    document.getElementById('qrVisualArea').classList.add('hidden');
                    btnGen.classList.add('hidden');
                    document.getElementById('genSuccessArea').classList.remove('hidden');
                    document.getElementById('genSuccessId').textContent = data.qr_id;

                    // Render QR Code real menggunakan token dari backend
                    document.getElementById('realQRCode').innerHTML = '';
                    QRCode.toCanvas(
                        data.token,
                        { width: 128, margin: 1, color: { dark: '#195de6', light: '#ffffff' } },
                        function (err, canvas) {
                            if (!err) document.getElementById('realQRCode').appendChild(canvas);
                        }
                    );

                    // Update stat counter
                    const el = document.getElementById('stat-total');
                    if (el) el.innerText = (parseInt(el.innerText.replace(/\./g, '')) + 1).toLocaleString('id-ID');
                    showToast('QR Code berhasil di-generate!');
                    // Reload window to show new data
                    setTimeout(() => window.location.reload(), 1500);
                })
                .catch(err => {
                    alert('Error: ' + err.message);
                    btnGen.disabled = false;
                    btnGen.innerHTML = '<span class="flex items-center gap-2"><span class="text-lg material-symbols-outlined">bolt</span> Eksekusi Generate</span>';
                });
        }

        // View Component
        function viewQRDetail(id) {
            const r = document.getElementById('row-' + id);
            if (!r) return;
            document.getElementById('view-id').textContent = r.dataset.qrid;
            document.getElementById('view-spbu').textContent = r.dataset.spbu;
            document.getElementById('view-bbm').textContent = r.dataset.bbm;
            document.getElementById('view-kuota').textContent = r.dataset.kuota + ' L';
            document.getElementById('view-period').textContent = r.dataset.start + ' s/d ' + r.dataset.end;

            // Badge extraction logic
            const srcBadge = r.querySelector('.status-badge');
            const tgtBadge = document.getElementById('view-status-container');
            tgtBadge.className = srcBadge.className;
            document.getElementById('view-status-icon').textContent = srcBadge.querySelector('.material-symbols-outlined').textContent;
            document.getElementById('view-status-text').textContent = srcBadge.querySelector('.status-text').textContent;

            toggleModal('viewModal', true);
        }
        function closeViewModal() { toggleModal('viewModal', false); }

        // Edit Component
        let currentEditId = null;
        function openEditModal(id) {
            currentEditId = id;
            const r = document.getElementById('row-' + id);
            if (!r) return;
            document.getElementById('edit-subtitle').textContent = r.dataset.qrid;
            document.getElementById('edit-kuota').value = r.dataset.kuota.replace(/\./g, '');
            document.getElementById('edit-status').value = r.dataset.status;
            toggleModal('editModal', true);
        }
        function closeEditModal() { toggleModal('editModal', false); currentEditId = null; }
        function submitEdit() {
            const r = document.getElementById('row-' + currentEditId);
            if (r) {
                const rawK = document.getElementById('edit-kuota').value;
                const newK = Number(rawK).toLocaleString('id-ID');
                const newS = document.getElementById('edit-status').value;

                // Send request to backend
                fetch(`/admin/qr-codes/${currentEditId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        _method: 'PATCH',
                        kuota_liter: rawK,
                        status: newS.toLowerCase(),
                    })
                })
                    .then(res => {
                        if (res.ok) {
                            r.dataset.kuota = newK;
                            r.dataset.status = newS;

                            r.querySelector('.kuota-display').textContent = newK;
                            const badgeSpan = r.querySelector('.status-badge');

                            if (newS === 'Aktif') {
                                badgeSpan.className = 'status-badge inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full border text-emerald-700 bg-emerald-100 dark:bg-emerald-500/20 dark:text-emerald-400 border-emerald-200 dark:border-emerald-500/30';
                                badgeSpan.querySelector('.material-symbols-outlined').textContent = 'check_circle';
                            } else if (newS === 'Digunakan') {
                                badgeSpan.className = 'status-badge inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full border text-blue-700 bg-blue-100 dark:bg-blue-500/20 dark:text-blue-400 border-blue-200 dark:border-blue-500/30';
                                badgeSpan.querySelector('.material-symbols-outlined').textContent = 'verified';
                            } else {
                                badgeSpan.className = 'status-badge inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full border text-red-700 bg-red-100 dark:bg-red-500/20 dark:text-red-400 border-red-200 dark:border-red-500/30';
                                badgeSpan.querySelector('.material-symbols-outlined').textContent = 'cancel';
                            }
                            badgeSpan.querySelector('.status-text').textContent = newS;
                            showToast('Update QR Mode sukses!');
                            closeEditModal();
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            alert('Gagal update data QR di server');
                        }
                    });
            }
        }

        // Delete Component
        let currentDelId = null;
        function openDeleteModal(id) {
            currentDelId = id;
            document.getElementById('delete-qr-id').textContent = document.getElementById('row-' + id).dataset.qrid;
            toggleModal('deleteModal', true);
        }
        function closeDeleteModal() { toggleModal('deleteModal', false); currentDelId = null; }
        document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
            if (currentDelId) {
                fetch(`/admin/qr-codes/${currentDelId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
                })
                    .then(res => {
                        if (res.ok) {
                            document.getElementById('row-' + currentDelId).remove();
                            showToast('QR berhasil di hapus!');
                            closeDeleteModal();
                            setTimeout(() => window.location.reload(), 1000);
                        } else {
                            alert('Gagal menghapus data QR dari server');
                        }
                    });
            }
        });

        function filterTable() {
            const q = document.getElementById('tableSearch').value.toLowerCase();
            document.querySelectorAll('.table-row').forEach(row => {
                row.style.display = row.dataset.qrid.toLowerCase().includes(q) ? '' : 'none';
            });
        }

        document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeGenerateModal(); closeViewModal(); closeEditModal(); closeDeleteModal(); } });
    </script>
@endsection