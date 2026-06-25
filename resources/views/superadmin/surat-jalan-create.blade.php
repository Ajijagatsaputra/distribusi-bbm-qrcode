@extends('layouts.superadmin')

@section('title', 'Buat Surat Jalan')

@section('content')
    <div class="space-y-8 max-w-[800px] mx-auto">
        {{-- BREADCRUMBS & HEADER --}}
        <div class="flex flex-col gap-2">
            <a href="{{ route('superadmin.surat-jalan.index') }}"
                class="inline-flex items-center gap-1.5 text-slate-500 hover:text-slate-800 text-sm font-bold transition-all">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                <span>Kembali ke Surat Jalan</span>
            </a>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white mt-2">
                Buat <span class="gradient-text">Surat Jalan Baru</span>
            </h2>
            <p class="text-sm font-medium text-slate-500">
                Terbitkan surat penugasan resmi untuk Driver melakukan pengiriman BBM ke SPBU
            </p>
        </div>

        {{-- FORM --}}
        <div class="glass-panel p-8 rounded-3xl border border-white/50 shadow-glass bg-white/60">
            <form method="POST" action="{{ route('superadmin.surat-jalan.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- DRIVER --}}
                    <div class="flex flex-col gap-2">
                        <label for="driver_id" class="text-sm font-bold text-slate-700">Driver (Operator)</label>
                        <select name="driver_id" id="driver_id" required
                            class="w-full py-3 px-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800">
                            <option value="" disabled selected>Pilih Driver...</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }} ({{ $driver->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('driver_id')
                            <span class="text-xs text-pertamina-red font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- SPBU --}}
                    <div class="flex flex-col gap-2">
                        <label for="spbu_id" class="text-sm font-bold text-slate-700">SPBU Tujuan</label>
                        <select name="spbu_id" id="spbu_id" required
                            class="w-full py-3 px-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800">
                            <option value="" disabled selected>Pilih SPBU Tujuan...</option>
                            @foreach($spbus as $spbu)
                                <option value="{{ $spbu->id }}" {{ old('spbu_id') == $spbu->id ? 'selected' : '' }}>
                                    {{ $spbu->name }} - {{ $spbu->location }}
                                </option>
                            @endforeach
                        </select>
                        @error('spbu_id')
                            <span class="text-xs text-pertamina-red font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- JENIS BBM --}}
                    <div class="flex flex-col gap-2">
                        <label for="fuel_type_id" class="text-sm font-bold text-slate-700">Jenis BBM</label>
                        <select name="fuel_type_id" id="fuel_type_id" required
                            class="w-full py-3 px-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800">
                            <option value="" disabled selected>Pilih Jenis BBM...</option>
                            @foreach($fuelTypes as $fuel)
                                <option value="{{ $fuel->id }}" {{ old('fuel_type_id') == $fuel->id ? 'selected' : '' }}>
                                    {{ $fuel->name }} ({{ $fuel->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('fuel_type_id')
                            <span class="text-xs text-pertamina-red font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- VOLUME (LITER) --}}
                    <div class="flex flex-col gap-2">
                        <label for="volume_liter" class="text-sm font-bold text-slate-700">Volume (Liter)</label>
                        <input type="number" name="volume_liter" id="volume_liter" value="{{ old('volume_liter') }}"
                            placeholder="Contoh: 8000" min="100" required
                            class="w-full py-3 px-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800" />
                        @error('volume_liter')
                            <span class="text-xs text-pertamina-red font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- NOMOR POLISI ARMADA --}}
                    <div class="flex flex-col gap-2">
                        <label for="vehicle_plate" class="text-sm font-bold text-slate-700">Nomor Polisi Armada</label>
                        <input type="text" name="vehicle_plate" id="vehicle_plate" value="{{ old('vehicle_plate') }}"
                            placeholder="Contoh: B 9012 UO" required
                            class="w-full py-3 px-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800" />
                        @error('vehicle_plate')
                            <span class="text-xs text-pertamina-red font-bold">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- TANGGAL PENGIRIMAN --}}
                    <div class="flex flex-col gap-2">
                        <label for="tanggal_kirim" class="text-sm font-bold text-slate-700">Tanggal Pengiriman</label>
                        <input type="date" name="tanggal_kirim" id="tanggal_kirim"
                            value="{{ old('tanggal_kirim', now()->format('Y-m-d')) }}" required
                            min="{{ now()->format('Y-m-d') }}"
                            class="w-full py-3 px-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800" />
                        @error('tanggal_kirim')
                            <span class="text-xs text-pertamina-red font-bold">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- CATATAN --}}
                <div class="flex flex-col gap-2">
                    <label for="catatan" class="text-sm font-bold text-slate-700">Catatan Tambahan (Opsional)</label>
                    <textarea name="catatan" id="catatan" rows="3"
                        placeholder="Tambahkan instruksi khusus pengiriman di sini..."
                        class="w-full py-3 px-4 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-pertamina-blue/50 dark:bg-slate-900 dark:border-slate-800">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <span class="text-xs text-pertamina-red font-bold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- SUBMIT --}}
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('superadmin.surat-jalan.index') }}"
                        class="inline-flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3.5 rounded-2xl transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center bg-pertamina-blue hover:bg-blue-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-glow-blue transition-all">
                        Kirim & Terbitkan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection