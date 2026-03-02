@extends('layouts.admin')

@section('title', 'Distribution Data')

@section('content')

{{-- PAGE HEADER --}}
<div class="flex flex-wrap items-center justify-between gap-4 mb-8 animate-slide-in">
    <div>
        <h3 class="flex items-center gap-3 text-3xl font-bold tracking-tight text-slate-900 dark:text-white">
            Distribution Data Management
        </h3>
        <p class="flex items-center gap-2 mt-2 text-slate-600 dark:text-slate-400">
            <span class="w-2 h-2 bg-green-500 rounded-full pulse-live"></span>
            Manage and monitor all fuel distribution activities
        </p>
    </div>
    <div class="flex gap-3">
        <button onclick="exportData()" class="flex items-center gap-2 px-5 py-3 text-sm font-semibold transition-all bg-white border shadow-sm dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
            <span class="text-xl material-symbols-outlined">download</span>
            Export Data
        </button>
        <button onclick="openAddModal()" class="flex items-center gap-2 px-5 py-3 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-primary to-primary-dark hover:shadow-xl hover:scale-105">
            <span class="text-xl material-symbols-outlined">add</span>
            Add Distribution
        </button>
    </div>
</div>

{{-- FILTERS & SEARCH --}}
<div class="p-6 mb-6 bg-white border dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-2xl shadow-card">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
        {{-- Search --}}
        <div class="md:col-span-2">
            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                <span class="flex items-center gap-2">
                    <span class="text-base material-symbols-outlined">search</span>
                    Search
                </span>
            </label>
            <input
                type="text"
                id="searchInput"
                placeholder="Search by Truck ID, Destination..."
                class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                onkeyup="filterTable()"
            />
        </div>

        {{-- Date From --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                <span class="flex items-center gap-2">
                    <span class="text-base material-symbols-outlined">calendar_today</span>
                    From Date
                </span>
            </label>
            <input
                type="date"
                id="dateFrom"
                class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                onchange="filterByDate()"
            />
        </div>

        {{-- Date To --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                <span class="flex items-center gap-2">
                    <span class="text-base material-symbols-outlined">event</span>
                    To Date
                </span>
            </label>
            <input
                type="date"
                id="dateTo"
                class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all"
                onchange="filterByDate()"
            />
        </div>
    </div>

    {{-- Filter Pills --}}
    <div class="flex items-center gap-2 pt-4 mt-4 border-t border-slate-200 dark:border-slate-700">
        <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">Status:</span>
        <button onclick="filterByStatus('all')" class="filter-pill active px-3 py-1.5 text-xs font-semibold rounded-lg transition-all" data-status="all">
            All
        </button>
        <button onclick="filterByStatus('completed')" class="filter-pill px-3 py-1.5 text-xs font-semibold rounded-lg transition-all" data-status="completed">
            <span class="inline-block w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
            Completed
        </button>
        <button onclick="filterByStatus('in-transit')" class="filter-pill px-3 py-1.5 text-xs font-semibold rounded-lg transition-all" data-status="in-transit">
            <span class="inline-block w-2 h-2 mr-1 bg-blue-500 rounded-full"></span>
            In Transit
        </button>
        <button onclick="filterByStatus('loading')" class="filter-pill px-3 py-1.5 text-xs font-semibold rounded-lg transition-all" data-status="loading">
            <span class="inline-block w-2 h-2 mr-1 rounded-full bg-amber-500"></span>
            Loading
        </button>
    </div>
</div>

{{-- TABLE --}}
<div class="overflow-hidden bg-white border dark:bg-slate-900 border-slate-200 dark:border-slate-800 rounded-2xl shadow-card">

    {{-- Table Header --}}
    <div class="flex items-center justify-between p-6 border-b border-slate-200 dark:border-slate-800">
        <div>
            <h4 class="text-lg font-bold text-slate-900 dark:text-white">Distribution Records</h4>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Total <span id="totalRecords">10</span> distributions</p>
        </div>
        <div class="flex gap-2">
            <button onclick="refreshTable()" class="px-4 py-2 text-sm font-medium transition-all rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700">
                <span class="text-lg material-symbols-outlined">refresh</span>
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700" id="distributionTable">
            {{-- TABLE HEADER --}}
            <thead class="bg-slate-50 dark:bg-slate-800/50">
                <tr>
                    <th class="px-6 py-4 text-left">
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">No</span>
                    </th>
                    <th class="px-6 py-4 text-left">
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Truck ID</span>
                    </th>
                    <th class="px-6 py-4 text-left">
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Jenis BBM</span>
                    </th>
                    <th class="px-6 py-4 text-left">
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Volume (KL)</span>
                    </th>
                    <th class="px-6 py-4 text-left">
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Tujuan</span>
                    </th>
                    <th class="px-6 py-4 text-left">
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Tanggal</span>
                    </th>
                    <th class="px-6 py-4 text-center">
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Status</span>
                    </th>
                    <th class="px-6 py-4 text-center">
                        <span class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Action</span>
                    </th>
                </tr>
            </thead>

            {{-- TABLE BODY --}}
            <tbody class="bg-white divide-y dark:bg-slate-900 divide-slate-100 dark:divide-slate-800">
                @php
                    $fuelTypes = ['Pertalite', 'Pertamax', 'Solar', 'Dex'];
                    $statuses = [
                        ['name' => 'Completed', 'class' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400', 'icon' => 'check_circle'],
                        ['name' => 'In Transit', 'class' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400', 'icon' => 'local_shipping'],
                        ['name' => 'Loading', 'class' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400', 'icon' => 'schedule']
                    ];
                @endphp

                @for ($i = 1; $i <= 10; $i++)
                    @php
                        $status = $statuses[($i - 1) % 3];
                        $fuel = $fuelTypes[($i - 1) % 4];
                        $volume = rand(5000, 15000) / 1000;
                        $date = now()->subDays(rand(0, 30))->format('d M Y');
                    @endphp
                    <tr class="table-row transition hover:bg-slate-50 dark:hover:bg-slate-800/50"
                        data-truck="TRK-00{{ $i }}"
                        data-destination="SPBU 34.11{{ $i }}03"
                        data-status="{{ strtolower(str_replace(' ', '-', $status['name'])) }}"
                        data-date="{{ $date }}">

                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-slate-900 dark:text-white">{{ $i }}</span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-primary/10 to-primary/5">
                                    <span class="text-lg material-symbols-outlined text-primary">local_shipping</span>
                                </div>
                                <div>
                                    <p class="font-mono text-sm font-bold text-slate-900 dark:text-white">TRK-00{{ $i }}</p>
                                    <p class="text-xs text-slate-500">Driver: Driver {{ $i }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg">
                                <span class="text-sm material-symbols-outlined">water_drop</span>
                                {{ $fuel }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-slate-900 dark:text-white">{{ number_format($volume, 1) }}</span>
                            <span class="text-xs text-slate-500">KL</span>
                        </td>

                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">SPBU 34.11{{ $i }}03</p>
                                <p class="text-xs text-slate-500">Jakarta Selatan</p>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $date }}</p>
                                <p class="text-xs text-slate-500">{{ now()->subDays(rand(0, 30))->format('H:i') }} WIB</p>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold {{ $status['class'] }} rounded-full">
                                <span class="text-sm material-symbols-outlined">{{ $status['icon'] }}</span>
                                {{ $status['name'] }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="viewDistribution({{ $i }})"
                                    class="p-2 text-blue-600 transition rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 dark:text-blue-400 group"
                                    title="View Details">
                                    <span class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">visibility</span>
                                </button>

                                <button onclick="editDistribution({{ $i }})"
                                    class="p-2 transition rounded-lg text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/20 dark:text-amber-400 group"
                                    title="Edit">
                                    <span class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">edit</span>
                                </button>

                                <button onclick="deleteDistribution({{ $i }})"
                                    class="p-2 text-red-600 transition rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 dark:text-red-400 group"
                                    title="Delete">
                                    <span class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="flex items-center justify-between px-6 py-4 border-t bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800">
        <p class="text-sm text-slate-600 dark:text-slate-400">
            Showing <span class="font-semibold text-slate-900 dark:text-white">1-10</span> of <span class="font-semibold text-slate-900 dark:text-white">152</span> distributions
        </p>
        <div class="flex gap-2">
            <button class="px-4 py-2 text-sm font-semibold bg-white border rounded-lg dark:bg-slate-800 border-slate-200 dark:border-slate-700 disabled:opacity-50 disabled:cursor-not-allowed text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700" disabled>
                Previous
            </button>
            <button class="px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-primary-dark">
                Next
            </button>
        </div>
    </div>
</div>

{{-- ADD DISTRIBUTION MODAL --}}
<div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        {{-- Overlay --}}
        <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeAddModal()"></div>

        {{-- Modal Content --}}
        <div class="relative inline-block w-full max-w-2xl overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl dark:bg-slate-900 rounded-2xl sm:my-8 sm:align-middle">
            {{-- Header --}}
            <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800 bg-gradient-to-r from-primary/5 to-transparent">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-primary to-primary-dark">
                            <span class="text-2xl text-white material-symbols-outlined">add_circle</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Add New Distribution</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Fill in the distribution details</p>
                        </div>
                    </div>
                    <button onclick="closeAddModal()" class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-slate-500">close</span>
                    </button>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 py-6">
                <form id="addForm" class="space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Truck ID</label>
                            <input type="text" placeholder="e.g., TRK-001" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Driver Name</label>
                            <input type="text" placeholder="Driver name" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Fuel Type</label>
                            <select class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                                <option value="">Select fuel type</option>
                                <option>Pertalite</option>
                                <option>Pertamax</option>
                                <option>Solar</option>
                                <option>Dex</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Volume (KL)</label>
                            <input type="number" step="0.01" placeholder="0.00" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Destination</label>
                        <input type="text" placeholder="e.g., SPBU 34.11403" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Location</label>
                        <input type="text" placeholder="e.g., Jakarta Selatan" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Date</label>
                            <input type="date" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Time</label>
                            <input type="time" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Status</label>
                        <select class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                            <option value="">Select status</option>
                            <option>Loading</option>
                            <option>In Transit</option>
                            <option>Completed</option>
                        </select>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-3 px-6 py-4 border-t bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800">
                <button onclick="closeAddModal()" class="px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                    Cancel
                </button>
                <button onclick="submitAdd()" class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-primary to-primary-dark rounded-xl hover:shadow-lg transition-all">
                    <span class="flex items-center gap-2">
                        <span class="text-lg material-symbols-outlined">check_circle</span>
                        Save Distribution
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- VIEW DISTRIBUTION MODAL --}}
<div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeViewModal()"></div>

        <div class="relative inline-block w-full max-w-3xl overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl dark:bg-slate-900 rounded-2xl sm:my-8 sm:align-middle">
            {{-- Header --}}
            <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800 bg-gradient-to-r from-blue-500/5 to-transparent">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600">
                            <span class="text-2xl text-white material-symbols-outlined">info</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Distribution Details</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Complete distribution information</p>
                        </div>
                    </div>
                    <button onclick="closeViewModal()" class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-slate-500">close</span>
                    </button>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 py-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Truck ID</p>
                            <p class="font-mono text-base font-bold text-slate-900 dark:text-white">TRK-001</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Driver Name</p>
                            <p class="text-base font-semibold text-slate-900 dark:text-white">John Doe</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Fuel Type</p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 rounded-lg">
                                <span class="text-sm material-symbols-outlined">water_drop</span>
                                Pertalite
                            </span>
                        </div>
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Volume</p>
                            <p class="text-base font-bold text-slate-900 dark:text-white">8.5 <span class="text-sm font-normal text-slate-500">KL</span></p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Destination</p>
                            <p class="text-base font-semibold text-slate-900 dark:text-white">SPBU 34.11403</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Location</p>
                            <p class="text-base font-semibold text-slate-900 dark:text-white">Jakarta Selatan</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Date & Time</p>
                            <p class="text-base font-semibold text-slate-900 dark:text-white">08 Feb 2026, 14:30 WIB</p>
                        </div>
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Status</p>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-bold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 rounded-full">
                                <span class="text-sm material-symbols-outlined">check_circle</span>
                                Completed
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Additional Info --}}
                <div class="p-4 mt-6 border bg-slate-50 dark:bg-slate-800/50 rounded-xl border-slate-200 dark:border-slate-700">
                    <p class="mb-2 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Additional Notes</p>
                    <p class="text-sm text-slate-600 dark:text-slate-300">Distribution completed successfully. No incidents reported.</p>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-3 px-6 py-4 border-t bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800">
                <button onclick="closeViewModal()" class="px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                    Close
                </button>
                <button onclick="printDetails()" class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl hover:shadow-lg transition-all">
                    <span class="flex items-center gap-2">
                        <span class="text-lg material-symbols-outlined">print</span>
                        Print
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- EDIT DISTRIBUTION MODAL --}}
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeEditModal()"></div>

        <div class="relative inline-block w-full max-w-2xl overflow-hidden text-left align-bottom transition-all transform bg-white shadow-xl dark:bg-slate-900 rounded-2xl sm:my-8 sm:align-middle">
            {{-- Header --}}
            <div class="px-6 py-5 border-b border-slate-200 dark:border-slate-800 bg-gradient-to-r from-amber-500/5 to-transparent">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600">
                            <span class="text-2xl text-white material-symbols-outlined">edit</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Edit Distribution</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Update distribution information</p>
                        </div>
                    </div>
                    <button onclick="closeEditModal()" class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                        <span class="material-symbols-outlined text-slate-500">close</span>
                    </button>
                </div>
            </div>

            {{-- Body --}}
            <div class="px-6 py-6">
                <form id="editForm" class="space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Truck ID</label>
                            <input type="text" value="TRK-001" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Driver Name</label>
                            <input type="text" value="John Doe" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Fuel Type</label>
                            <select class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                                <option>Pertalite</option>
                                <option>Pertamax</option>
                                <option>Solar</option>
                                <option>Dex</option>
                            </select>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Volume (KL)</label>
                            <input type="number" step="0.01" value="8.5" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Destination</label>
                        <input type="text" value="SPBU 34.11403" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Location</label>
                        <input type="text" value="Jakarta Selatan" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Date</label>
                            <input type="date" value="2026-02-08" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Time</label>
                            <input type="time" value="14:30" class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required />
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Status</label>
                        <select class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary" required>
                            <option>Loading</option>
                            <option>In Transit</option>
                            <option selected>Completed</option>
                        </select>
                    </div>
                </form>
            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-3 px-6 py-4 border-t bg-slate-50 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800">
                <button onclick="closeEditModal()" class="px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                    Cancel
                </button>
                <button onclick="submitEdit()" class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl hover:shadow-lg transition-all">
                    <span class="flex items-center gap-2">
                        <span class="text-lg material-symbols-outlined">save</span>
                        Update Distribution
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Modal Functions
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openViewModal() {
        document.getElementById('viewModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeViewModal() {
        document.getElementById('viewModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openEditModal() {
        document.getElementById('editModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // View Distribution
    function viewDistribution(id) {
        openViewModal();
    }

    // Edit Distribution
    function editDistribution(id) {
        openEditModal();
    }

    // Delete Distribution
    function deleteDistribution(id) {
        if (confirm('Are you sure you want to delete this distribution record?')) {
            // Add delete logic here
            alert('Distribution deleted successfully!');
        }
    }

    // Submit Add Form
    function submitAdd() {
        const form = document.getElementById('addForm');
        if (form.checkValidity()) {
            alert('Distribution added successfully!');
            closeAddModal();
            form.reset();
        } else {
            form.reportValidity();
        }
    }

    // Submit Edit Form
    function submitEdit() {
        const form = document.getElementById('editForm');
        if (form.checkValidity()) {
            alert('Distribution updated successfully!');
            closeEditModal();
        } else {
            form.reportValidity();
        }
    }

    // Print Details
    function printDetails() {
        window.print();
    }

    // Export Data
    function exportData() {
        alert('Exporting data...');
    }

    // Refresh Table
    function refreshTable() {
        alert('Refreshing data...');
        location.reload();
    }

    // Filter by Status
    let currentStatusFilter = 'all';

    function filterByStatus(status) {
        currentStatusFilter = status;

        // Update active pill
        document.querySelectorAll('.filter-pill').forEach(pill => {
            pill.classList.remove('active', 'bg-primary', 'text-white');
            pill.classList.add('bg-slate-100', 'dark:bg-slate-800', 'text-slate-700', 'dark:text-slate-300');
        });

        const activePill = document.querySelector(`[data-status="${status}"]`);
        activePill.classList.remove('bg-slate-100', 'dark:bg-slate-800', 'text-slate-700', 'dark:text-slate-300');
        activePill.classList.add('active', 'bg-primary', 'text-white');

        // Filter rows
        const rows = document.querySelectorAll('.table-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowStatus = row.getAttribute('data-status');
            if (status === 'all' || rowStatus === status) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        updateRecordCount(visibleCount);
    }

    // Search Filter
    function filterTable() {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.table-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const truck = row.getAttribute('data-truck').toLowerCase();
            const destination = row.getAttribute('data-destination').toLowerCase();
            const status = row.getAttribute('data-status');

            const matchesSearch = truck.includes(searchValue) || destination.includes(searchValue);
            const matchesStatus = currentStatusFilter === 'all' || status === currentStatusFilter;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        updateRecordCount(visibleCount);
    }

    // Date Filter
    function filterByDate() {
        const dateFrom = document.getElementById('dateFrom').value;
        const dateTo = document.getElementById('dateTo').value;

        if (!dateFrom && !dateTo) {
            filterTable();
            return;
        }

        const rows = document.querySelectorAll('.table-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const rowDate = new Date(row.getAttribute('data-date'));
            const from = dateFrom ? new Date(dateFrom) : new Date('1900-01-01');
            const to = dateTo ? new Date(dateTo) : new Date('2100-12-31');

            const status = row.getAttribute('data-status');
            const matchesStatus = currentStatusFilter === 'all' || status === currentStatusFilter;

            if (rowDate >= from && rowDate <= to && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        updateRecordCount(visibleCount);
    }

    // Update Record Count
    function updateRecordCount(count) {
        document.getElementById('totalRecords').textContent = count;
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddModal();
            closeViewModal();
            closeEditModal();
        }
    });
</script>
@endpush

@push('styles')
<style>
    /* Animations */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-in {
        animation: slideInUp 0.5s ease-out;
    }

    /* Pulse animation */
    @keyframes pulse-ring {
        0%, 100% {
            transform: scale(0.95);
            opacity: 1;
        }
        50% {
            transform: scale(1);
            opacity: 0.7;
        }
    }

    .pulse-live {
        animation: pulse-ring 2s ease-in-out infinite;
    }

    /* Shadow */
    .shadow-card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.08), 0 1px 2px 0 rgba(0, 0, 0, 0.04);
    }

    /* Filter Pills */
    .filter-pill {
        background: rgb(241, 245, 249);
        color: rgb(51, 65, 85);
    }

    .filter-pill.active {
        background: rgb(25, 93, 230);
        color: white;
    }

    .dark .filter-pill {
        background: rgb(30, 41, 59);
        color: rgb(203, 213, 225);
    }

    .dark .filter-pill.active {
        background: rgb(25, 93, 230);
        color: white;
    }
</style>
@endpush
