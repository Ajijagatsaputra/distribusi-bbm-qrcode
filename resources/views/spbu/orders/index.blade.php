@extends('layouts.spbu')

@section('title', 'Pemesanan BBM')

@section('content')
    <div class="animate-slide-in space-y-8">
        {{-- HEADER --}}
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="mb-2 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                    Pemesanan <span class="text-pertamina-blue">BBM</span>
                </h2>
                <p class="text-sm text-slate-650 dark:text-slate-400">
                    Ajukan permintaan pasokan BBM baru dan pantau persetujuan Surat Jalan dari Depo
                </p>
            </div>
        </div>

        @if(session('success'))
            <div
                class="flex items-center gap-3 px-4 py-3 bg-pertamina-green/10 border border-pertamina-green/30 rounded-xl text-pertamina-green font-semibold text-sm">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div
                class="flex items-center gap-3 px-4 py-3 bg-pertamina-red/10 border border-pertamina-red/30 rounded-xl text-pertamina-red font-semibold text-sm">
                <span class="material-symbols-outlined">error</span>
                {{ session('error') }}
            </div>
        @endif

        {{-- MAIN SECTION SPLIT: CREATE & HISTORY --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- FORM INPUT ORDER --}}
            <div class="lg:col-span-1">
                <div
                    class="p-6 bg-white border border-slate-200/50 rounded-2xl dark:bg-slate-900/70 dark:border-slate-800 shadow-glass sticky top-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-600 shadow-glow-blue text-white">
                            <span class="material-symbols-outlined text-[22px]">add_shopping_cart</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-slate-900 dark:text-white">Pemesanan Baru</h3>
                            <p class="text-xs text-slate-500 font-medium">Input kuantitas pasokan</p>
                        </div>
                    </div>

                    <form action="{{ route('spbu.orders.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Jenis Bahan Bakar
                                (BBM)</label>
                            <select name="fuel_type_id"
                                class="w-full px-4 py-3 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20"
                                required>
                                <option value="">-- Pilih Jenis BBM --</option>
                                @foreach($fuelTypes as $fuel)
                                    <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Volume
                                (Liter)</label>
                            <div class="relative">
                                <input type="number" name="volume_liter" placeholder="Contoh: 8000" min="100"
                                    class="w-full px-4 py-3 pr-12 text-sm transition-all border outline-none rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-2 focus:ring-pertamina-blue/20"
                                    required>
                                <span
                                    class="absolute -translate-y-1/2 text-sm font-bold text-slate-400 right-4 top-1/2">Liter</span>
                            </div>
                        </div>

                        <div
                            class="p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-100 dark:border-slate-800">
                            <div class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[18px] text-pertamina-blue mt-0.5">info</span>
                                <p class="text-[11px] font-semibold text-slate-500 leading-relaxed">
                                    Pesanan yang Anda buat akan langsung terkirim ke Admin Pusat untuk diverifikasi dan
                                    diterbitkan Surat Jalan-nya.
                                </p>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-700 hover:scale-102 shadow-glow-blue outline-none">
                            <span class="material-symbols-outlined text-[18px]">send</span>
                            Kirim Pengajuan
                        </button>
                    </form>
                </div>
            </div>

            {{-- HISTORY ORDERS TABLE --}}
            <div class="lg:col-span-2">
                <div
                    class="overflow-hidden bg-white border shadow-glass backdrop-blur-md border-slate-200/50 rounded-2xl dark:bg-slate-900/70 dark:border-slate-800">
                    <div class="p-6 border-b border-slate-200/50 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                        <h4 class="font-bold text-slate-900 dark:text-white">Riwayat Pengajuan Pesanan</h4>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr
                                    class="text-xs font-bold tracking-wider uppercase bg-slate-50/50 dark:bg-slate-800/50 text-slate-500">
                                    <th class="px-6 py-4">Kode Pesanan</th>
                                    <th class="px-6 py-4">Jenis BBM</th>
                                    <th class="px-6 py-4">Volume (Liter)</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4">Surat Jalan</th>
                                    <th class="px-6 py-4">Tanggal Pengajuan</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($orders as $order)
                                    <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                                            {{ $order->kode_pesanan }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <span class="w-3 h-3 rounded-full"
                                                    style="background-color: {{ $order->fuelType->color_code ?? '#ccc' }}"></span>
                                                <span
                                                    class="font-bold text-slate-700 dark:text-slate-300">{{ $order->fuelType->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">
                                            {{ number_format($order->volume_liter, 0, ',', '.') }} L
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @php
                                                $color = $order->statusColor();
                                                $label = $order->statusLabel();
                                            @endphp
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-bold uppercase rounded-full bg-{{ $color }}-100 text-{{ $color }}-700 dark:bg-{{ $color }}-900/30 dark:text-{{ $color }}-400 border border-{{ $color }}-200 dark:border-{{ $color }}-850">
                                                {{ $label }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($order->suratJalan)
                                                <div class="flex flex-col gap-1">
                                                    <span
                                                        class="text-xs font-bold font-mono text-slate-600 bg-slate-100 dark:bg-slate-800 dark:text-slate-400 px-2 py-0.5 rounded w-max">
                                                        {{ $order->suratJalan->kode_surat_jalan }}
                                                    </span>
                                                    <span class="text-[10px] text-slate-400 font-semibold">Plat:
                                                        {{ $order->suratJalan->vehicle_plate ?? '-' }}</span>
                                                </div>
                                            @else
                                                <span class="text-xs text-slate-400 font-medium italic">Belum Diterbitkan</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-slate-500 font-semibold">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-slate-500 font-semibold">
                                            Belum ada pengajuan pesanan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($orders->hasPages())
                        <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-800">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection