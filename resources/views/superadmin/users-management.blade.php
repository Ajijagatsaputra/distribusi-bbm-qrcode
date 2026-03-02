@extends('layouts.superadmin')

@section('title', 'User Management')

@section('content')
<div class="min-h-screen p-4 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 md:p-8">

    {{-- HEADER --}}
    <div class="flex flex-col justify-between gap-4 mb-8 md:flex-row md:items-center animate-fade-in">
        <div>
            <h2 class="mb-2 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                Manajemen Pengguna
            </h2>
            <p class="text-slate-600">
                Kelola hak akses administrator dan operator sistem
            </p>
        </div>

        <div class="flex items-center gap-3">
            {{-- FILTER ROLE --}}
            <div class="relative">
                <select id="roleFilter" onchange="filterByRole(this.value)"
                    class="px-4 py-2.5 pr-10 text-sm font-semibold bg-white border rounded-xl outline-none appearance-none cursor-pointer border-slate-300 text-slate-700 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all shadow-sm hover:shadow-md">
                    <option value="">Semua Role</option>
                    <option value="superadmin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="operator">Operator</option>
                </select>
                <svg class="absolute w-4 h-4 -translate-y-1/2 pointer-events-none text-slate-400 right-3 top-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </div>

            {{-- BUTTON ADD USER --}}
            <button onclick="openModal('modalAddUser')"
                class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-white transition-all duration-200 transform rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:scale-105 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Tambah Pengguna
            </button>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 lg:grid-cols-4">
        <div class="p-5 overflow-hidden transition-all duration-300 transform bg-white border border-purple-100 shadow-sm group hover:shadow-xl hover:-translate-y-1 rounded-2xl">
            <div class="flex items-center justify-between mb-3">
                <div class="p-2.5 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 group-hover:scale-110 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-purple-600">1</span>
            </div>
            <p class="text-sm font-medium text-slate-600">Super Admin</p>
        </div>

        <div class="p-5 overflow-hidden transition-all duration-300 transform bg-white border border-blue-100 shadow-sm group hover:shadow-xl hover:-translate-y-1 rounded-2xl">
            <div class="flex items-center justify-between mb-3">
                <div class="p-2.5 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 group-hover:scale-110 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-blue-600">1</span>
            </div>
            <p class="text-sm font-medium text-slate-600">Admin</p>
        </div>

        <div class="p-5 overflow-hidden transition-all duration-300 transform bg-white border shadow-sm group hover:shadow-xl hover:-translate-y-1 border-emerald-100 rounded-2xl">
            <div class="flex items-center justify-between mb-3">
                <div class="p-2.5 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 group-hover:scale-110 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-emerald-600">1</span>
            </div>
            <p class="text-sm font-medium text-slate-600">Operator</p>
        </div>

        <div class="p-5 overflow-hidden transition-all duration-300 transform bg-white border shadow-sm group hover:shadow-xl hover:-translate-y-1 border-slate-200 rounded-2xl">
            <div class="flex items-center justify-between mb-3">
                <div class="p-2.5 rounded-xl bg-gradient-to-br from-slate-500 to-slate-600 group-hover:scale-110 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <span class="text-2xl font-bold text-slate-600">3</span>
            </div>
            <p class="text-sm font-medium text-slate-600">Total Pengguna</p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-hidden transition-all duration-300 bg-white border shadow-lg border-slate-200 rounded-2xl hover:shadow-2xl">

        {{-- TABLE HEADER --}}
        <div class="p-6 border-b bg-gradient-to-r from-slate-50 to-blue-50 border-slate-200">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white rounded-lg shadow-sm">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Daftar Pengguna Sistem</h3>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left" id="userTable">
                <thead>
                    <tr class="text-xs font-semibold tracking-wider uppercase bg-slate-50 text-slate-600">
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4">Login Terakhir</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    {{-- SUPER ADMIN --}}
                    <tr class="transition-colors hover:bg-blue-50" data-role="superadmin">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white rounded-full bg-gradient-to-br from-purple-500 to-purple-600 ring-2 ring-purple-200">
                                        AJ
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-emerald-500"></div>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">Alex Johnson</p>
                                    <p class="text-xs text-slate-500">ID: #SA001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-600">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm">alex.johnson@example.com</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold uppercase rounded-full bg-gradient-to-r from-purple-100 to-purple-200 text-purple-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Super Admin
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-emerald-500 peer-checked:to-emerald-600"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-600">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm">12 Jun, 14:22</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="editUser('Alex Johnson')" class="p-2 transition-all rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteUser('Alex Johnson')" class="p-2 transition-all rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- ADMIN --}}
                    <tr class="transition-colors hover:bg-blue-50" data-role="admin">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-10 h-10 text-sm font-bold text-blue-700 bg-blue-100 rounded-full ring-2 ring-blue-200">
                                        DP
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-emerald-500"></div>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">Daniel Pratama</p>
                                    <p class="text-xs text-slate-500">ID: #AD001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-600">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm">daniel.p@hq.system.id</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold uppercase rounded-full bg-blue-100 text-blue-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                                </svg>
                                Admin
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-emerald-500 peer-checked:to-emerald-600"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-600">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm">12 Jun, 08:30</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="editUser('Daniel Pratama')" class="p-2 transition-all rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteUser('Daniel Pratama')" class="p-2 transition-all rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- OPERATOR --}}
                    <tr class="transition-colors hover:bg-blue-50" data-role="operator">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="flex items-center justify-center w-10 h-10 text-sm font-bold rounded-full bg-emerald-100 text-emerald-700 ring-2 ring-emerald-200">
                                        BK
                                    </div>
                                    <div class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-emerald-500"></div>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">Budi Kusuma</p>
                                    <p class="text-xs text-slate-500">ID: #OP001</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-600">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-sm">budi.k@field-ops.net</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold uppercase rounded-full bg-emerald-100 text-emerald-700">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                Operator
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-emerald-500 peer-checked:to-emerald-600"></div>
                            </label>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 text-slate-600">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-sm">11 Jun, 23:12</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick="editUser('Budi Kusuma')" class="p-2 transition-all rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteUser('Budi Kusuma')" class="p-2 transition-all rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- TABLE FOOTER --}}
        <div class="px-6 py-4 border-t bg-slate-50 border-slate-200">
            <p class="text-xs text-slate-500">
                Menampilkan <span class="font-semibold text-slate-700" id="displayCount">3</span> dari <span class="font-semibold text-slate-700">3</span> pengguna
            </p>
        </div>
    </div>

    {{-- ROLE EXPLANATION --}}
    <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-3">
        <div class="p-6 overflow-hidden transition-all duration-300 transform border border-purple-200 shadow-sm group hover:shadow-xl hover:-translate-y-1 bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 group-hover:scale-110 transition-all">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
                <h4 class="font-bold text-purple-800">Super Admin</h4>
            </div>
            <p class="text-sm text-purple-700">
                Akses penuh terhadap seluruh sistem termasuk master data, pengguna, log audit, dan konfigurasi sistem.
            </p>
        </div>

        <div class="p-6 overflow-hidden transition-all duration-300 transform border border-blue-200 shadow-sm group hover:shadow-xl hover:-translate-y-1 bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 group-hover:scale-110 transition-all">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h4 class="font-bold text-blue-800">Admin</h4>
            </div>
            <p class="text-sm text-blue-700">
                Kontrol regional atas QR code, data SPBU, dan monitoring distribusi BBM di wilayah kerja.
            </p>
        </div>

        <div class="p-6 overflow-hidden transition-all duration-300 transform border shadow-sm group hover:shadow-xl hover:-translate-y-1 border-emerald-200 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl">
            <div class="flex items-center gap-3 mb-3">
                <div class="p-2.5 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 group-hover:scale-110 transition-all">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h4 class="font-bold text-emerald-800">Operator</h4>
            </div>
            <p class="text-sm text-emerald-700">
                Peran lapangan yang fokus pada pemindaian QR code dan validasi distribusi BBM di SPBU.
            </p>
        </div>
    </div>

</div>

{{-- ================= MODAL ADD USER ================= --}}
<div id="modalAddUser" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="absolute inset-0 transition-opacity bg-black/60 backdrop-blur-sm" onclick="closeModal('modalAddUser')"></div>
        <div class="relative w-full max-w-lg transition-all transform scale-95 opacity-0 modal-content">
            <div class="overflow-hidden bg-white shadow-2xl rounded-2xl">
                {{-- HEADER --}}
                <div class="flex items-center gap-3 p-6 text-white bg-gradient-to-r from-blue-600 to-blue-700">
                    <div class="p-2 rounded-lg bg-white/20 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Tambah Pengguna Baru</h3>
                </div>

                {{-- FORM --}}
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <input type="text" id="userName" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" placeholder="Contoh: John Doe">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Email</label>
                        <input type="email" id="userEmail" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" placeholder="Contoh: john@example.com">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Role</label>
                        <select id="userRole" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100">
                            <option value="">Pilih Role</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Operator</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700">Password</label>
                        <div class="relative">
                            <input type="password" id="userPassword" class="w-full px-4 py-3 transition-all border outline-none rounded-xl border-slate-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" placeholder="Minimal 8 karakter">
                            <button type="button" onclick="togglePassword()" class="absolute -translate-y-1/2 text-slate-400 right-3 top-1/2 hover:text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 p-3 rounded-lg bg-blue-50">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-xs text-blue-700">Pengguna akan menerima email verifikasi setelah akun dibuat</p>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="flex gap-3 p-6 border-t bg-slate-50 border-slate-200">
                    <button onclick="closeModal('modalAddUser')" class="flex-1 px-4 py-3 font-semibold transition-all border-2 rounded-xl text-slate-700 border-slate-300 hover:bg-slate-100">
                        Batal
                    </button>
                    <button onclick="saveUser()" class="flex items-center justify-center flex-1 gap-2 px-4 py-3 font-semibold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 hover:shadow-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Pengguna
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ================= STYLES & SCRIPTS ================= --}}
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
// MODAL FUNCTIONS
function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

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

// FILTER BY ROLE
function filterByRole(role) {
    const rows = document.querySelectorAll('#userTable tbody tr');
    let visibleCount = 0;

    rows.forEach(row => {
        const rowRole = row.getAttribute('data-role');

        if (role === '' || rowRole === role) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    // Update display count
    document.getElementById('displayCount').textContent = visibleCount;
}

// TOGGLE PASSWORD VISIBILITY
function togglePassword() {
    const passwordInput = document.getElementById('userPassword');
    passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
}

// SAVE USER
function saveUser() {
    const name = document.getElementById('userName').value;
    const email = document.getElementById('userEmail').value;
    const role = document.getElementById('userRole').value;
    const password = document.getElementById('userPassword').value;

    if (!name || !email || !role || !password) {
        alert('Mohon lengkapi semua field!');
        return;
    }

    if (password.length < 8) {
        alert('Password minimal 8 karakter!');
        return;
    }

    // Simulate save
    alert(`Pengguna baru berhasil ditambahkan!\n\nNama: ${name}\nEmail: ${email}\nRole: ${role}`);

    // Reset form
    document.getElementById('userName').value = '';
    document.getElementById('userEmail').value = '';
    document.getElementById('userRole').value = '';
    document.getElementById('userPassword').value = '';

    closeModal('modalAddUser');
}

// EDIT USER
function editUser(name) {
    alert(`Fitur edit untuk ${name} akan segera tersedia!`);
}

// DELETE USER
function deleteUser(name) {
    if (confirm(`Apakah Anda yakin ingin menghapus pengguna ${name}?`)) {
        alert(`Pengguna ${name} berhasil dihapus!`);
    }
}

// ESC KEY TO CLOSE MODAL
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        const modals = ['modalAddUser'];
        modals.forEach(id => {
            const m = document.getElementById(id);
            if (m && !m.classList.contains('hidden')) closeModal(id);
        });
    }
});
</script>
@endsection
