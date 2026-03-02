@extends('layouts.superadmin')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="min-h-screen p-4 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 md:p-8">

    {{-- ===== HEADER SECTION ===== --}}
    <div class="mb-8 animate-fade-in">
        <h1 class="mb-2 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
            Dashboard Super Admin
        </h1>
        <p class="text-slate-600">Kelola sistem distribusi BBM secara terpusat</p>
    </div>

    {{-- ===== STATISTIK ===== --}}
    <div class="grid grid-cols-1 gap-4 mb-10 sm:grid-cols-2 lg:grid-cols-4 md:gap-6">
        <div class="overflow-hidden transition-all duration-300 transform bg-white border border-blue-100 shadow-sm group hover:shadow-xl hover:-translate-y-1 rounded-2xl">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 transition-all duration-300 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 group-hover:scale-110">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">Hari Ini</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-slate-600">Total Distribusi BBM</h3>
                <p class="text-3xl font-bold text-slate-800">1.248</p>
                <div class="flex items-center mt-3 text-xs text-emerald-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                    <span class="font-semibold">+12.5%</span>
                    <span class="ml-1 text-slate-500">vs kemarin</span>
                </div>
            </div>
        </div>

        <div class="overflow-hidden transition-all duration-300 transform bg-white border shadow-sm group hover:shadow-xl hover:-translate-y-1 border-emerald-100 rounded-2xl">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 transition-all duration-300 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 group-hover:scale-110">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full text-emerald-700 bg-emerald-100">Aktif</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-slate-600">QR Code Terdaftar</h3>
                <p class="text-3xl font-bold text-slate-800">986</p>
                <div class="flex items-center mt-3 text-xs text-emerald-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="font-semibold">100%</span>
                    <span class="ml-1 text-slate-500">terverifikasi</span>
                </div>
            </div>
        </div>

        <div class="overflow-hidden transition-all duration-300 transform bg-white border shadow-sm group hover:shadow-xl hover:-translate-y-1 border-amber-100 rounded-2xl">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 transition-all duration-300 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 group-hover:scale-110">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full text-amber-700 bg-amber-100">Master</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-slate-600">Jenis BBM Aktif</h3>
                <p class="text-3xl font-bold text-slate-800">5</p>
                <div class="flex items-center mt-3 text-xs text-slate-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="ml-1 text-slate-500">dari 6 total jenis</span>
                </div>
            </div>
        </div>

        <div class="overflow-hidden transition-all duration-300 transform bg-white border shadow-sm group hover:shadow-xl hover:-translate-y-1 border-violet-100 rounded-2xl">
            <div class="p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 transition-all duration-300 rounded-xl bg-gradient-to-br from-violet-500 to-violet-600 group-hover:scale-110">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full text-violet-700 bg-violet-100">Nasional</span>
                </div>
                <h3 class="mb-1 text-sm font-medium text-slate-600">SPBU Terdaftar</h3>
                <p class="text-3xl font-bold text-slate-800">27</p>
                <div class="flex items-center mt-3 text-xs text-blue-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="ml-1 text-slate-500">di 3 kota</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== MASTER DATA ===== --}}
    <div class="mb-6">
        <h2 class="mb-6 text-xl font-bold text-slate-800">Master Data</h2>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- MASTER BBM --}}
        <div class="overflow-hidden transition-all duration-300 transform bg-white border shadow-lg group hover:shadow-2xl border-slate-200 rounded-2xl">
            <div class="flex items-center justify-between p-6 border-b bg-gradient-to-r from-blue-50 to-indigo-50 border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white rounded-lg shadow-sm">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Master Jenis BBM</h3>
                </div>
                <button type="button" onclick="openModal('modalBBM')"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-200 transform rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:scale-105 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Tambah</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider uppercase bg-slate-50 text-slate-600">
                            <th class="px-6 py-3 text-left">Nama BBM</th>
                            <th class="px-6 py-3 text-left">Kode</th>
                            <th class="px-6 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="transition-colors hover:bg-blue-50">
                            <td class="px-6 py-4 font-medium text-slate-800">Pertalite</td>
                            <td class="px-6 py-4 text-slate-600">
                                <span class="px-2.5 py-1 text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg">PRTL</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Aktif
                                </span>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-blue-50">
                            <td class="px-6 py-4 font-medium text-slate-800">Pertalite</td>
                            <td class="px-6 py-4 text-slate-600">
                                <span class="px-2.5 py-1 text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg">PRTL</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Aktif
                                </span>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-blue-50">
                            <td class="px-6 py-4 font-medium text-slate-800">Pertamax</td>
                            <td class="px-6 py-4 text-slate-600">
                                <span class="px-2.5 py-1 text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg">PRTX</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full text-slate-600 bg-slate-100">
                                    <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                    Non Aktif
                                </span>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-blue-50">
                            <td class="px-6 py-4 font-medium text-slate-800">Bio Solar</td>
                            <td class="px-6 py-4 text-slate-600">
                                <span class="px-2.5 py-1 text-xs font-semibold bg-slate-100 text-slate-700 rounded-lg">BIO</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold text-emerald-700 bg-emerald-100 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Aktif
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t bg-slate-50 border-slate-200">
                <p class="text-xs text-slate-500">Total: <span class="font-semibold text-slate-700">4 jenis BBM</span></p>
            </div>
        </div>

        {{-- MASTER SPBU --}}
        <div class="overflow-hidden transition-all duration-300 transform bg-white border shadow-lg group hover:shadow-2xl border-slate-200 rounded-2xl">
            <div class="flex items-center justify-between p-6 border-b bg-gradient-to-r from-emerald-50 to-teal-50 border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white rounded-lg shadow-sm">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Master SPBU</h3>
                </div>
                <button type="button" onclick="openModal('modalSPBU')"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-200 transform rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 hover:scale-105 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Tambah</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider uppercase bg-slate-50 text-slate-600">
                            <th class="px-6 py-3 text-left">Kode SPBU</th>
                            <th class="px-6 py-3 text-left">Lokasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="transition-colors hover:bg-emerald-50">
                            <td class="px-6 py-4">
                                <span class="font-mono font-semibold text-slate-800">34.123.01</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="font-medium text-slate-700">Bandung</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-emerald-50">
                            <td class="px-6 py-4">
                                <span class="font-mono font-semibold text-slate-800">34.123.01</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="font-medium text-slate-700">Jakarta</span>
                                </div>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-emerald-50">
                            <td class="px-6 py-4">
                                <span class="font-mono font-semibold text-slate-800">34.123.01</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="font-medium text-slate-700">Semarang</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t bg-slate-50 border-slate-200">
                <p class="text-xs text-slate-500">Total: <span class="font-semibold text-slate-700">3 SPBU</span></p>
            </div>
        </div>

        {{-- MASTER KENDARAAN --}}
        <div class="overflow-hidden transition-all duration-300 transform bg-white border shadow-lg group hover:shadow-2xl border-slate-200 rounded-2xl">
            <div class="flex items-center justify-between p-6 border-b bg-gradient-to-r from-violet-50 to-purple-50 border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-white rounded-lg shadow-sm">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Master Kendaraan</h3>
                </div>
                <button type="button" onclick="openModal('modalKendaraan')"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-200 transform rounded-xl bg-gradient-to-r from-violet-600 to-violet-700 hover:from-violet-700 hover:to-violet-800 hover:scale-105 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Tambah</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider uppercase bg-slate-50 text-slate-600">
                            <th class="px-6 py-3 text-left">Plat Nomor</th>
                            <th class="px-6 py-3 text-left">Jenis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="transition-colors hover:bg-violet-50">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-slate-800">B 1234 ABC</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                    </svg>
                                    Mobil
                                </span>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-violet-50">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-slate-800">B 1234 ABC</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-amber-100 text-amber-700 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    Motor
                                </span>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-violet-50">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-slate-800">B 1234 ABC</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-emerald-100 text-emerald-700 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    Truk Kontainer
                                </span>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-violet-50">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-slate-800">B 1234 ABC</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-purple-100 text-purple-700 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                                    </svg>
                                    Bus
                                </span>
                            </td>
                        </tr>
                        <tr class="transition-colors hover:bg-violet-50">
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-slate-800">B 1234 ABC</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold bg-indigo-100 text-indigo-700 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h4a1 1 0 001-1m-6 0h6"/>
                                    </svg>
                                    Truk
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t bg-slate-50 border-slate-200">
                <p class="text-xs text-slate-500">Total: <span class="font-semibold text-slate-700">5 kendaraan</span></p>
            </div>
        </div>

    </div>
</div>

{{-- ================= MODAL BBM ================= --}}
<div id="modalBBM" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="absolute inset-0 transition-opacity bg-black/60 backdrop-blur-sm" onclick="closeModal('modalBBM')"></div>
        <div class="relative w-full max-w-md transition-all transform scale-95 opacity-0 modal-content">
            <div class="overflow-hidden bg-white shadow-2xl rounded-2xl">
                <div class="flex items-center gap-3 p-6 text-white bg-gradient-to-r from-blue-600 to-blue-700">
                    <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Tambah Jenis BBM</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Nama BBM</label>
                        <input type="text" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" placeholder="Contoh: Pertalite">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Kode BBM</label>
                        <input type="text" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" placeholder="Contoh: PRTL">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Status</label>
                        <select class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                            <option>Aktif</option>
                            <option>Nonaktif</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 p-6 border-t bg-slate-50 border-slate-200">
                    <button onclick="closeModal('modalBBM')" class="flex-1 px-4 py-3 font-semibold transition-all border-2 rounded-xl text-slate-700 border-slate-300 hover:bg-slate-100">
                        Batal
                    </button>
                    <button class="flex items-center justify-center flex-1 gap-2 px-4 py-3 font-semibold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL SPBU ================= --}}
<div id="modalSPBU" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="absolute inset-0 transition-opacity bg-black/60 backdrop-blur-sm" onclick="closeModal('modalSPBU')"></div>
        <div class="relative w-full max-w-md transition-all transform scale-95 opacity-0 modal-content">
            <div class="overflow-hidden bg-white shadow-2xl rounded-2xl">
                <div class="flex items-center gap-3 p-6 text-white bg-gradient-to-r from-emerald-600 to-emerald-700">
                    <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Tambah SPBU</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Kode SPBU</label>
                        <input type="text" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" placeholder="Contoh: 34.123.01">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Lokasi</label>
                        <input type="text" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100" placeholder="Contoh: Bandung">
                    </div>
                </div>
                <div class="flex gap-3 p-6 border-t bg-slate-50 border-slate-200">
                    <button onclick="closeModal('modalSPBU')" class="flex-1 px-4 py-3 font-semibold transition-all border-2 rounded-xl text-slate-700 border-slate-300 hover:bg-slate-100">
                        Batal
                    </button>
                    <button class="flex items-center justify-center flex-1 gap-2 px-4 py-3 font-semibold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= MODAL KENDARAAN ================= --}}
<div id="modalKendaraan" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="absolute inset-0 transition-opacity bg-black/60 backdrop-blur-sm" onclick="closeModal('modalKendaraan')"></div>
        <div class="relative w-full max-w-md transition-all transform scale-95 opacity-0 modal-content">
            <div class="overflow-hidden bg-white shadow-2xl rounded-2xl">
                <div class="flex items-center gap-3 p-6 text-white bg-gradient-to-r from-violet-600 to-violet-700">
                    <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Tambah Kendaraan</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Plat Nomor</label>
                        <input type="text" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-violet-500 focus:ring-4 focus:ring-violet-100" placeholder="Contoh: B 1234 ABC">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Jenis Kendaraan</label>
                        <select class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-violet-500 focus:ring-4 focus:ring-violet-100">
                            <option>Motor</option>
                            <option>Mobil</option>
                            <option>Truk Kontainer</option>
                            <option>Bus</option>
                            <option>Truk</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 p-6 border-t bg-slate-50 border-slate-200">
                    <button onclick="closeModal('modalKendaraan')" class="flex-1 px-4 py-3 font-semibold transition-all border-2 rounded-xl text-slate-700 border-slate-300 hover:bg-slate-100">
                        Batal
                    </button>
                    <button class="flex items-center justify-center flex-1 gap-2 px-4 py-3 font-semibold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-violet-600 to-violet-700 hover:from-violet-700 hover:to-violet-800 hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}

@keyframes modal-show {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.modal-show {
    animation: modal-show 0.3s ease-out forwards;
}
</style>

<script>
function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    // Trigger animation
    setTimeout(() => {
        const content = modal.querySelector('.modal-content');
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('modal-show');
    }, 10);
}

function closeModal(id) {
    const modal = document.getElementById(id);
    const content = modal.querySelector('.modal-content');

    content.classList.remove('modal-show');
    content.classList.add('scale-95', 'opacity-0');

    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 200);
}

document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        ['modalBBM','modalSPBU','modalKendaraan'].forEach(id => {
            const m = document.getElementById(id);
            if (m && !m.classList.contains('hidden')) closeModal(id);
        });
    }
});

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('bg-black/60')) {
        ['modalBBM','modalSPBU','modalKendaraan'].forEach(id => {
            const m = document.getElementById(id);
            if (m && !m.classList.contains('hidden')) closeModal(id);
        });
    }
});
</script>
@endsection
