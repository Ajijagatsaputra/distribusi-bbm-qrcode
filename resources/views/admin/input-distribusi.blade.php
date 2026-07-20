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
                <h3 class="text-lg font-bold text-slate-900">Alur Input Distribusi</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Pilih <strong>Surat Jalan aktif</strong> terlebih dahulu. Data driver, kendaraan, SPBU, dan BBM akan <strong>terisi otomatis</strong> sesuai surat jalan yang disetujui Admin Pusat.
                </p>
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 space-y-2">
                    <p class="text-xs font-bold uppercase text-slate-400">Langkah Verifikasi</p>
                    <ul class="text-xs text-slate-500 space-y-1.5 list-decimal pl-4">
                        <li>Pilih Surat Jalan dari dropdown.</li>
                        <li>Verifikasi fisik: cocokkan plat nomor & driver.</li>
                        <li>Sesuaikan volume aktual jika berbeda, lalu simpan.</li>
                    </ul>
                </div>
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200 flex items-start gap-2">
                    <span class="material-symbols-outlined text-amber-500 text-base shrink-0 mt-0.5">info</span>
                    <p class="text-xs text-amber-700">Distribusi <strong>wajib terikat</strong> Surat Jalan yang diterbitkan Admin Pusat.</p>
                </div>
            </div>
        </div>

        {{-- FORM INPUT --}}
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('admin.distributions.store') }}" class="glass-panel p-8 rounded-3xl border border-white/50 shadow-glass space-y-8 bg-white/40">
                @csrf

                {{-- PILIH SURAT JALAN — WAJIB --}}
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 block">
                        Surat Jalan <span class="text-pertamina-red">*</span>
                    </label>
                    @if($suratJalans->isEmpty())
                        <div class="flex items-center gap-3 p-4 bg-amber-50 border border-amber-200 rounded-xl">
                            <span class="material-symbols-outlined text-amber-500">warning</span>
                            <p class="text-sm text-amber-700 font-medium">Belum ada Surat Jalan aktif. Admin Pusat perlu menerbitkan Surat Jalan terlebih dahulu.</p>
                        </div>
                    @else
                        <select id="select_surat_jalan" name="surat_jalan_id"
                            class="w-full h-12 px-4 rounded-xl border-2 border-pertamina-blue/30 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800 transition-all"
                            required>
                            <option value="">-- Pilih Surat Jalan --</option>
                            @foreach($suratJalans as $sj)
                                <option value="{{ $sj->id }}"
                                    data-driver="{{ $sj->driver->name }}"
                                    data-plate="{{ $sj->vehicle_plate }}"
                                    data-spbu="{{ $sj->spbu_id }}"
                                    data-fuel="{{ $sj->fuel_type_id }}"
                                    data-volume="{{ $sj->volume_liter }}"
                                    {{ old('surat_jalan_id') == $sj->id ? 'selected' : '' }}>
                                    {{ $sj->kode_surat_jalan }} — {{ $sj->driver->name }} ({{ $sj->vehicle_plate }})
                                </option>
                            @endforeach
                        </select>
                        <p class="text-xs text-slate-400 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px] text-pertamina-blue">info</span>
                            Pilih surat jalan untuk mengisi data otomatis di bawah.
                        </p>
                    @endif
                </div>

                <div class="h-px bg-slate-200"></div>

                {{-- AUTO-FILL PREVIEW — tampil setelah surat jalan dipilih --}}
                <div id="sj-preview" class="hidden p-4 rounded-2xl bg-pertamina-blue/5 border border-pertamina-blue/20 space-y-3">
                    <div class="flex items-center justify-between">
                        <p class="text-xs font-bold uppercase tracking-wider text-pertamina-blue">Data dari Surat Jalan</p>
                        <span class="flex items-center gap-1 text-[10px] font-bold text-pertamina-green bg-pertamina-green/10 px-2 py-0.5 rounded-full">
                            <span class="material-symbols-outlined text-[12px]">lock</span> Terisi Otomatis
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div>
                            <p class="text-[10px] font-bold uppercase text-slate-400">Driver</p>
                            <p id="preview-driver" class="font-bold text-slate-800">—</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold uppercase text-slate-400">No. Polisi</p>
                            <p id="preview-plate" class="font-bold font-mono text-slate-800">—</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold uppercase text-slate-400">SPBU Tujuan</p>
                            <p id="preview-spbu" class="font-bold text-slate-800">—</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold uppercase text-slate-400">Jenis BBM</p>
                            <p id="preview-fuel" class="font-bold text-slate-800">—</p>
                        </div>
                    </div>
                </div>

                {{-- HIDDEN FIELDS — dikirim ke server, diisi via JS --}}
                <input type="hidden" id="driver_name"   name="driver_name" />
                <input type="hidden" id="vehicle_plate" name="vehicle_plate" />
                <input type="hidden" id="spbu_id"       name="spbu_id" />
                <input type="hidden" id="fuel_type_id"  name="fuel_type_id" />

                {{-- FORM GRID — hanya volume & qr yang masih bisa diinput --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- VOLUME — bisa disesuaikan --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-slate-700 block pl-1">
                            Volume Bongkar Aktual (Liter)
                            <span class="ml-1 text-[10px] font-medium text-slate-400">(boleh disesuaikan)</span>
                        </label>
                        <div class="relative">
                            <input type="number" id="volume_liter" name="volume_liter"
                                placeholder="0" value="{{ old('volume_liter') }}"
                                class="w-full h-12 pl-4 pr-16 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-right text-slate-800 transition-all"
                                required min="1" />
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold bg-slate-100 px-2 py-0.5 rounded text-xs">LITER</span>
                        </div>
                    </div>

                    {{-- QR CODE TOKEN (Optional) --}}
                    <div class="space-y-1.5">
                        <label class="text-sm font-bold text-slate-700 block pl-1">QR Code Token SPBU (Opsional)</label>
                        <select name="qr_code_id" class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white focus:outline-none focus:border-pertamina-blue font-semibold text-slate-800">
                            <option value="">-- Tanpa Scan QR Token --</option>
                            @foreach($qrCodes as $qr)
                                <option value="{{ $qr->id }}" {{ old('qr_code_id') == $qr->id ? 'selected' : '' }}>
                                    {{ $qr->qr_id }} (Kuota: {{ number_format($qr->kuota_liter) }} L)
                                </option>
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
                        <span class="material-symbols-outlined text-amber-500 shrink-0">verified_user</span>
                        <p class="text-[11px] font-medium leading-tight">Data akan dicatat sebagai distribusi resmi terikat Surat Jalan dan masuk ke audit log Admin Depo.</p>
                    </div>
                    <button type="submit" id="btn-submit"
                        class="flex items-center gap-2 h-14 px-8 rounded-2xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:to-blue-500 text-white font-bold text-base shadow-glow-blue hover:scale-105 transition-all disabled:opacity-40 disabled:cursor-not-allowed disabled:scale-100"
                        {{ $suratJalans->isEmpty() ? 'disabled' : '' }}>
                        <span class="material-symbols-outlined text-xl">save</span> Simpan Distribusi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectSj      = document.getElementById('select_surat_jalan');
    const driverHidden  = document.getElementById('driver_name');
    const plateHidden   = document.getElementById('vehicle_plate');
    const spbuHidden    = document.getElementById('spbu_id');
    const fuelHidden    = document.getElementById('fuel_type_id');
    const volumeInput   = document.getElementById('volume_liter');
    const preview       = document.getElementById('sj-preview');
    const btnSubmit     = document.getElementById('btn-submit');

    // SPBU & Fuel name maps untuk preview
    const spbuMap = {
        @foreach($spbus as $sp)
        '{{ $sp->id }}': '{{ $sp->name }}',
        @endforeach
    };
    const fuelMap = {
        @foreach($fuelTypes as $ft)
        '{{ $ft->id }}': '{{ $ft->name }}',
        @endforeach
    };

    if (selectSj) {
        selectSj.addEventListener('change', function () {
            const opt = selectSj.options[selectSj.selectedIndex];

            if (!opt.value) {
                // Reset semua hidden fields
                driverHidden.value = '';
                plateHidden.value  = '';
                spbuHidden.value   = '';
                fuelHidden.value   = '';
                volumeInput.value  = '';
                preview.classList.add('hidden');
                btnSubmit.disabled = true;
                return;
            }

            // Isi hidden fields dari data-* surat jalan
            driverHidden.value = opt.dataset.driver;
            plateHidden.value  = opt.dataset.plate;
            spbuHidden.value   = opt.dataset.spbu;
            fuelHidden.value   = opt.dataset.fuel;
            volumeInput.value  = opt.dataset.volume;

            // Update preview card
            document.getElementById('preview-driver').textContent = opt.dataset.driver;
            document.getElementById('preview-plate').textContent  = opt.dataset.plate;
            document.getElementById('preview-spbu').textContent   = spbuMap[opt.dataset.spbu] || 'SPBU #' + opt.dataset.spbu;
            document.getElementById('preview-fuel').textContent   = fuelMap[opt.dataset.fuel]  || 'BBM #'  + opt.dataset.fuel;
            preview.classList.remove('hidden');
            btnSubmit.disabled = false;
        });

        // Jika ada old value (validasi gagal), trigger change
        if (selectSj.value) selectSj.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
