@extends('layouts.admin')

@section('title', 'Input Distribusi Manual')

@section('content')
<div class="space-y-8">
    {{-- HEADER --}}
    <div class="flex flex-col gap-1">
        <h2 class="text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
            Input <span class="gradient-text">Data Distribusi</span>
        </h2>
        <p class="text-base font-medium text-slate-500 dark:text-slate-400">
            Catat hasil akhir pengiriman BBM ke SPBU tujuan secara manual jika terdapat kendala scan QR Code oleh Driver
        </p>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="p-4 bg-pertamina-green/10 border border-pertamina-green/20 rounded-2xl flex items-center gap-3 text-pertamina-green font-semibold">
            <span class="material-symbols-outlined">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="p-4 bg-pertamina-red/10 border border-pertamina-red/20 rounded-2xl text-pertamina-red font-semibold">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- SEBELUMNYA/PETUNJUK --}}
        <div class="space-y-6">
            <div class="glass-panel p-6 rounded-3xl border border-white/50 shadow-glass space-y-4">
                <div class="size-12 rounded-2xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                    <span class="material-symbols-outlined text-2xl">info</span>
                </div>
                <h3 class="text-lg font-bold text-slate-900">Metode Penginputan</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Anda dapat mencatat distribusi menggunakan data <strong>Surat Jalan aktif</strong> yang sedang berjalan untuk mempermudah auto-fill, atau menginput seluruh data secara <strong>manual mandiri</strong> jika data Surat Jalan belum terdaftar.
                </p>
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 space-y-2">
                    <p class="text-xs font-bold uppercase text-slate-400">Alur Verifikasi Fisik</p>
                    <ul class="text-xs text-slate-500 space-y-1.5 list-decimal pl-4">
                        <li>Pastikan Driver melaporkan dokumen fisik.</li>
                        <li>Cek kesesuaian plat nomor & volume tangki.</li>
                        <li>Input data setelah BBM berhasil dibongkar di SPBU.</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- FORM INPUT --}}
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('admin.distributions.store') }}" class="glass-panel p-8 rounded-3xl border border-white/50 shadow-glass space-y-8 bg-white/40">
                @csrf

                {{-- PILIH DARI SURAT JALAN (OPSIONAL) --}}
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 block">Hubungkan dengan Surat Jalan (Opsional)</label>
                    <select id="select_surat_jalan" name="surat_jalan_id" class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800">
                        <option value="">-- Input Manual Tanpa Surat Jalan --</option>
                        @foreach($suratJalans as $sj)
                            <option value="{{ $sj->id }}" 
                                data-driver="{{ $sj->driver->name }}"
                                data-plate="{{ $sj->vehicle_plate }}"
                                data-spbu="{{ $sj->spbu_id }}"
                                data-fuel="{{ $sj->fuel_type_id }}"
                                data-volume="{{ $sj->volume_liter }}"
                                {{ old('surat_jalan_id') == $sj->id ? 'selected' : '' }}>
                                {{ $sj->kode_surat_jalan }} - {{ $sj->driver->name }} ({{ $sj->vehicle_plate }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-slate-400">Memilih Surat Jalan akan otomatis mengisi form di bawah.</p>
                </div>

                <div class="h-px bg-slate-200"></div>

                {{-- FORM GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- DRIVER NAME --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-slate-700 block pl-1">Nama Driver</label>
                        <input type="text" id="driver_name" name="driver_name" placeholder="Nama lengkap driver" value="{{ old('driver_name') }}" class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800" required />
                    </div>

                    {{-- PLATE --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-slate-700 block pl-1">No. Polisi Kendaraan</label>
                        <input type="text" id="vehicle_plate" name="vehicle_plate" placeholder="Cth: B 1234 S" value="{{ old('vehicle_plate') }}" class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800" required />
                    </div>

                    {{-- SPBU --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-slate-700 block pl-1">SPBU Tujuan</label>
                        <select id="spbu_id" name="spbu_id" class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800" required>
                            <option value="">Pilih SPBU Tujuan</option>
                            @foreach($spbus as $spbu)
                                <option value="{{ $spbu->id }}" {{ old('spbu_id') == $spbu->id ? 'selected' : '' }}>{{ $spbu->name }} - {{ $spbu->location }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- BBM TYPE --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-slate-700 block pl-1">Jenis BBM</label>
                        <select id="fuel_type_id" name="fuel_type_id" class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800" required>
                            <option value="">Pilih Jenis BBM</option>
                            @foreach($fuelTypes as $ft)
                                <option value="{{ $ft->id }}" {{ old('fuel_type_id') == $ft->id ? 'selected' : '' }}>{{ $ft->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- VOLUME --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-slate-700 block pl-1">Volume Bongkar (Liter)</label>
                        <div class="relative">
                            <input type="number" id="volume_liter" name="volume_liter" placeholder="0" value="{{ old('volume_liter') }}" class="w-full h-12 pl-4 pr-16 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-right text-slate-800" required min="1" />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold bg-slate-100 px-2 py-0.5 rounded text-xs">LITER</span>
                        </div>
                    </div>

                    {{-- QR CODE TOKEN (Optional) --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-slate-700 block pl-1">QR Code Token SPBU (Optional)</label>
                        <select name="qr_code_id" class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800">
                            <option value="">-- Tanpa Scan QR Token --</option>
                            @foreach($qrCodes as $qr)
                                <option value="{{ $qr->id }}" {{ old('qr_code_id') == $qr->id ? 'selected' : '' }}>{{ $qr->qr_id }} (Kuota: {{ number_format($qr->kuota_liter) }} L)</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- NOTES --}}
                <div class="space-y-1.5">
                    <label class="text-sm font-bold text-slate-700 block pl-1">Catatan Tambahan</label>
                    <textarea name="notes" placeholder="Catatan atau keterangan bongkar BBM..." rows="3" class="w-full p-4 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800">{{ old('notes') }}</textarea>
                </div>

                {{-- SUBMIT --}}
                <div class="flex items-center justify-between gap-4 pt-4">
                    <div class="flex items-center gap-2.5 max-w-md text-amber-700 bg-amber-50 px-4 py-3 rounded-2xl border border-amber-200/50">
                        <span class="material-symbols-outlined text-amber-500 shrink-0">warning</span>
                        <p class="text-[11px] font-medium leading-tight">Data yang disimpan akan masuk ke audit logs sebagai distribusi manual oleh Admin Depo.</p>
                    </div>
                    <button type="submit" class="flex items-center gap-2 h-14 px-8 rounded-2xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:to-blue-500 text-white font-bold text-base shadow-glow-blue hover:scale-105 transition-all">
                        <span class="material-symbols-outlined text-xl">save</span> Simpan Distribusi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectSj = document.getElementById('select_surat_jalan');
        const driverInput = document.getElementById('driver_name');
        const plateInput = document.getElementById('vehicle_plate');
        const spbuSelect = document.getElementById('spbu_id');
        const fuelSelect = document.getElementById('fuel_type_id');
        const volumeInput = document.getElementById('volume_liter');

        selectSj.addEventListener('change', function() {
            const selectedOpt = selectSj.options[selectSj.selectedIndex];
            if (!selectedOpt.value) {
                // Clear fields if empty selected
                driverInput.value = '';
                plateInput.value = '';
                spbuSelect.value = '';
                fuelSelect.value = '';
                volumeInput.value = '';
                return;
            }

            // Populate fields
            driverInput.value = selectedOpt.dataset.driver;
            plateInput.value = selectedOpt.dataset.plate;
            spbuSelect.value = selectedOpt.dataset.spbu;
            fuelSelect.value = selectedOpt.dataset.fuel;
            volumeInput.value = selectedOpt.dataset.volume;
        });
    });
</script>
@endsection
