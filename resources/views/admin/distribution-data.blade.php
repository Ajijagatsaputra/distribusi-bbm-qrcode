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
                <span class="w-2 h-2 rounded-full bg-pertamina-green pulse-live"></span>
                Manage and monitor all fuel distribution activities
            </p>
        </div>
        <div class="flex gap-3">
            <button onclick="exportData()"
                class="flex items-center gap-2 px-5 py-3 text-sm font-semibold transition-all bg-white border shadow-sm dark:bg-slate-800 border-slate-200 dark:border-slate-700 rounded-xl text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 hover:scale-105">
                <span class="text-xl material-symbols-outlined">download</span>
                Export Data
            </button>
            <a href="{{ route('admin.input-distribusi') }}"
                class="flex items-center gap-2 px-5 py-3 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 shadow-glow-blue hover:shadow-xl hover:scale-105">
                <span class="text-xl material-symbols-outlined">add_circle</span>
                Add Distribution
            </a>
        </div>
    </div>

    {{-- FILTERS & SEARCH --}}
    <div
        class="p-6 mb-6 transition-all border shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl">
        <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
            {{-- Search --}}
            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                    <span class="flex items-center gap-2">
                        <span class="text-base material-symbols-outlined">search</span>
                        Search
                    </span>
                </label>
                <input type="text" id="searchInput" placeholder="Search by Truck ID, Destination..."
                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white input-glass transition-all focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue"
                    onkeyup="filterTable()" />
            </div>

            {{-- Date From --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                    <span class="flex items-center gap-2">
                        <span class="text-base material-symbols-outlined">calendar_today</span>
                        From Date
                    </span>
                </label>
                <input type="date" id="dateFrom"
                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white input-glass transition-all focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue"
                    onchange="filterByDate()" />
            </div>

            {{-- Date To --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">
                    <span class="flex items-center gap-2">
                        <span class="text-base material-symbols-outlined">event</span>
                        To Date
                    </span>
                </label>
                <input type="date" id="dateTo"
                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-white input-glass transition-all focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue"
                    onchange="filterByDate()" />
            </div>
        </div>

        {{-- Filter Pills --}}
        <div class="flex items-center gap-2 pt-4 mt-4 border-t border-slate-200/50 dark:border-slate-700">
            <span class="text-sm font-semibold text-slate-600 dark:text-slate-400">Status:</span>
            <button onclick="filterByStatus('all')"
                class="filter-pill active px-3 py-1.5 text-xs font-semibold rounded-lg transition-all" data-status="all">
                All
            </button>
            <button onclick="filterByStatus('completed')"
                class="filter-pill px-3 py-1.5 text-xs font-semibold rounded-lg transition-all" data-status="completed">
                <span class="inline-block w-2 h-2 mr-1 rounded-full bg-pertamina-green"></span>
                Completed
            </button>
            <button onclick="filterByStatus('in-transit')"
                class="filter-pill px-3 py-1.5 text-xs font-semibold rounded-lg transition-all" data-status="in-transit">
                <span class="inline-block w-2 h-2 mr-1 rounded-full bg-pertamina-blue"></span>
                In Transit
            </button>
            <button onclick="filterByStatus('loading')"
                class="filter-pill px-3 py-1.5 text-xs font-semibold rounded-lg transition-all" data-status="loading">
                <span class="inline-block w-2 h-2 mr-1 rounded-full bg-orange-500"></span>
                Loading
            </button>
        </div>
    </div>

    {{-- NOTIFICATION TOAST (Hidden by default) --}}
    <div id="toastNotification"
        class="fixed top-24 right-8 z-50 flex items-center gap-3 px-4 py-3 text-sm font-semibold text-white transition-all transform translate-x-full bg-slate-900 dark:bg-slate-800 rounded-xl shadow-2xl opacity-0">
        <span class="material-symbols-outlined text-pertamina-green">check_circle</span>
        <span id="toastMessage">Action successful!</span>
    </div>

    {{-- TABLE --}}
    <div
        class="overflow-hidden transition-all border shadow-glass backdrop-blur-md bg-white/70 dark:bg-slate-900/70 border-white/50 dark:border-slate-800 rounded-2xl">

        {{-- Table Header --}}
        <div class="flex items-center justify-between p-6 border-b border-slate-200/50 dark:border-slate-800">
            <div>
                <h4 class="text-lg font-bold text-slate-900 dark:text-white">Distribution Records</h4>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Total <span id="totalRecords">10</span>
                    distributions</p>
            </div>
            <div class="flex gap-2">
                <button onclick="refreshTable()"
                    class="px-4 py-2 text-sm font-medium transition-all rounded-xl bg-slate-100/50 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700">
                    <span class="text-lg material-symbols-outlined">refresh</span>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200/50 dark:divide-slate-700" id="distributionTable">
                {{-- TABLE HEADER --}}
                <thead class="bg-slate-50/50 dark:bg-slate-800/50">
                    <tr>
                        <th class="px-6 py-4 text-left">
                            <span
                                class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">No</span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span
                                class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Truck
                                ID</span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span
                                class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Jenis
                                BBM</span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span
                                class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Volume
                                (KL)</span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span
                                class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Tujuan</span>
                        </th>
                        <th class="px-6 py-4 text-left">
                            <span
                                class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Tanggal</span>
                        </th>
                        <th class="px-6 py-4 text-center">
                            <span
                                class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Status</span>
                        </th>
                        <th class="px-6 py-4 text-center">
                            <span
                                class="text-xs font-bold tracking-wider uppercase text-slate-600 dark:text-slate-400">Action</span>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y bg-white/30 dark:bg-slate-900/30 divide-slate-100 dark:divide-slate-800"
                    id="tableBody">
                    @forelse ($distributions as $index => $dist)
                        @php
                            $sysDate = $dist->distributed_at ? $dist->distributed_at->format('Y-m-d') : '';
                            $displayDate = $dist->distributed_at ? $dist->distributed_at->format('d M Y') : '';
                            $time = $dist->distributed_at ? $dist->distributed_at->format('H:i') : '';
                            $truck = $dist->vehicle_plate;
                            $driver = $dist->driver_name;
                            $fuel = $dist->fuelType ? $dist->fuelType->name : 'N/A';
                            $volume = $dist->volume_liter / 1000;
                            $destination = $dist->spbu ? $dist->spbu->name : 'N/A';
                            $location = $dist->spbu ? $dist->spbu->location : 'N/A';

                            if ($dist->status === 'selesai') {
                                $statusName = 'Completed';
                                $statusClass = 'bg-pertamina-green/10 text-pertamina-green dark:bg-pertamina-green/20 dark:text-green-400';
                                $statusIcon = 'check_circle';
                            } elseif ($dist->status === 'loading') {
                                $statusName = 'Loading';
                                $statusClass = 'bg-orange-500/10 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400';
                                $statusIcon = 'schedule';
                            } else {
                                $statusName = 'In Transit';
                                $statusClass = 'bg-pertamina-blue/10 text-pertamina-blue dark:bg-pertamina-blue/20 dark:text-blue-400';
                                $statusIcon = 'local_shipping';
                            }
                        @endphp
                        <tr class="transition table-row hover:bg-white/60 dark:hover:bg-slate-800/50" id="row-{{ $dist->id }}"
                            data-id="{{ $dist->id }}" data-truck="{{ $truck }}" data-driver="{{ $driver }}"
                            data-fuel="{{ $fuel }}" data-volume="{{ number_format($volume, 1) }}"
                            data-destination="{{ $destination }}" data-location="{{ $location }}" data-date="{{ $sysDate }}"
                            data-displaydate="{{ $displayDate }}" data-time="{{ $time }}" data-status="{{ $statusName }}"
                            data-statusclass="{{ $statusClass }}" data-statusicon="{{ $statusIcon }}">

                            <td class="px-6 py-4">
                                <span
                                    class="text-sm font-semibold text-slate-900 dark:text-white row-number">{{ $distributions->firstItem() + $index }}</span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-pertamina-blue/10 to-pertamina-blue/5">
                                        <span
                                            class="text-lg material-symbols-outlined text-pertamina-blue">local_shipping</span>
                                    </div>
                                    <div class="max-w-[120px]">
                                        <p
                                            class="font-mono text-sm font-bold truncate text-slate-900 dark:text-white truck-display">
                                            {{ $truck }}</p>
                                        <p class="text-xs truncate text-slate-500 driver-display">Driver: {{ $driver }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-semibold bg-slate-100/50 text-slate-700 dark:bg-slate-800 dark:text-slate-300 rounded-lg">
                                    <span class="text-sm material-symbols-outlined">water_drop</span>
                                    <span class="fuel-display">{{ $fuel }}</span>
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="text-sm font-bold text-slate-900 dark:text-white volume-display">{{ number_format($volume, 1) }}</span>
                                <span class="text-xs text-slate-500">KL</span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="max-w-[160px]">
                                    <p
                                        class="text-sm font-semibold truncate text-slate-900 dark:text-white destination-display">
                                        {{ $destination }}</p>
                                    <p class="text-xs truncate text-slate-500 location-display">{{ $location }}</p>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white date-display">
                                        {{ $displayDate }}</p>
                                    <p class="text-xs text-slate-500 time-display">{{ $time }} WIB</p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span
                                    class="status-badge inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold border border-current/10 {{ $statusClass }} rounded-full">
                                    <span class="text-sm material-symbols-outlined">{{ $statusIcon }}</span>
                                    <span class="status-text">{{ $statusName }}</span>
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button onclick="viewDistribution({{ $dist->id }})"
                                        class="p-2 transition rounded-lg text-pertamina-blue hover:bg-pertamina-blue/10 dark:hover:bg-blue-900/20 dark:text-blue-400 group"
                                        title="View Details">
                                        <span
                                            class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">visibility</span>
                                    </button>

                                    <button onclick="editDistribution({{ $dist->id }})"
                                        class="p-2 transition rounded-lg text-orange-500 hover:bg-orange-500/10 dark:hover:bg-orange-900/20 dark:text-orange-400 group"
                                        title="Edit">
                                        <span
                                            class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">edit</span>
                                    </button>

                                    <button onclick="openDeleteModal({{ $dist->id }})"
                                        class="p-2 transition rounded-lg text-pertamina-red hover:bg-pertamina-red/10 dark:hover:bg-red-900/20 dark:text-red-400 group"
                                        title="Delete">
                                        <span
                                            class="text-lg transition-transform material-symbols-outlined group-hover:scale-110">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-slate-500">
                                <span class="material-symbols-outlined text-4xl mb-2 block">inbox</span>
                                Tidak ada data distribusi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="px-6 py-4 border-t bg-slate-50/50 dark:bg-slate-800/50 border-slate-200/50 dark:border-slate-800">
            {{ $distributions->links() }}
        </div>
    </div>

    {{-- ADD DISTRIBUTION MODAL --}}
    <div id="addModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeAddModal()"></div>
            <div
                class="relative w-full max-w-2xl overflow-hidden text-left align-bottom transition-all transform border border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl shadow-glass dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div
                    class="px-6 py-5 border-b border-slate-200/50 dark:border-slate-800 bg-gradient-to-r from-pertamina-blue/10 to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-600 shadow-glow-blue">
                                <span class="text-2xl text-white material-symbols-outlined">add_circle</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Add New Distribution</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Fill in the distribution details</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeAddModal()"
                            class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <span class="material-symbols-outlined text-slate-500">close</span>
                        </button>
                    </div>
                </div>
                <div class="px-6 py-6">
                    <form id="addForm" class="space-y-5" onsubmit="event.preventDefault(); submitAdd();">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Truck
                                    ID</label>
                                <input type="text" placeholder="e.g., TRK-001"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                    required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Driver
                                    Name</label>
                                <input type="text" placeholder="Driver name"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                    required />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Fuel
                                    Type</label>
                                <select
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                    required>
                                    <option value="">Select fuel type</option>
                                    <option>Pertalite</option>
                                    <option>Pertamax</option>
                                    <option>Solar</option>
                                    <option>Dex</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Volume
                                    (KL)</label>
                                <input type="number" step="0.01" placeholder="0.00"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                    required />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Destination</label>
                                <input type="text" placeholder="e.g., SPBU 34.11403"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                    required />
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Location</label>
                                <input type="text" placeholder="e.g., Jakarta Selatan"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                    required />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Date</label>
                                <input type="date"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                    required />
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Time</label>
                                <input type="time"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                    required />
                            </div>
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Status</label>
                            <select
                                class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue input-glass"
                                required>
                                <option value="">Select status</option>
                                <option>Loading</option>
                                <option>In Transit</option>
                                <option>Completed</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200/50 dark:border-slate-800">
                            <button type="button" onclick="closeAddModal()"
                                class="px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-pertamina-blue to-blue-600 rounded-xl hover:shadow-lg hover:scale-105 transition-all shadow-glow-blue">
                                <span class="flex items-center gap-2">
                                    <span class="text-lg material-symbols-outlined">check_circle</span>
                                    Save Distribution
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- VIEW DISTRIBUTION MODAL --}}
    <div id="viewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeViewModal()"></div>

            <div
                class="relative w-full max-w-3xl overflow-hidden text-left align-bottom transition-all transform border border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl shadow-glass dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div
                    class="px-6 py-5 border-b border-slate-200/50 dark:border-slate-800 bg-gradient-to-r from-pertamina-blue/10 to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-600 shadow-glow-blue">
                                <span class="text-2xl text-white material-symbols-outlined">info</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Distribution Details</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Complete distribution information</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeViewModal()"
                            class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <span class="material-symbols-outlined text-slate-500">close</span>
                        </button>
                    </div>
                </div>

                <div class="px-6 py-6" id="viewModalLayout">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Truck ID
                                </p>
                                <p id="view-truck" class="font-mono text-base font-bold text-slate-900 dark:text-white">
                                    TRK-001</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Driver
                                    Name</p>
                                <p id="view-driver" class="text-base font-semibold text-slate-900 dark:text-white">John Doe
                                </p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Fuel Type
                                </p>
                                <span
                                    class="inline-flex items-center gap-1.5 px-3 py-1 text-sm font-semibold bg-pertamina-blue/10 text-pertamina-blue border border-pertamina-blue/20 rounded-lg">
                                    <span class="text-sm material-symbols-outlined">water_drop</span>
                                    <span id="view-fuel">Pertalite</span>
                                </span>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Volume
                                </p>
                                <p id="view-volume" class="text-base font-bold text-slate-900 dark:text-white">8.5 <span
                                        class="text-sm font-normal text-slate-500">KL</span></p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">
                                    Destination</p>
                                <p id="view-destination" class="text-base font-semibold text-slate-900 dark:text-white">SPBU
                                    34.11403</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Location
                                </p>
                                <p id="view-location" class="text-base font-semibold text-slate-900 dark:text-white">Jakarta
                                    Selatan</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Date &
                                    Time</p>
                                <p id="view-datetime" class="text-base font-semibold text-slate-900 dark:text-white">08 Feb
                                    2026, 14:30 WIB</p>
                            </div>
                            <div>
                                <p class="mb-1 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Status
                                </p>
                                <span id="view-status-container"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-bold bg-pertamina-green/10 text-pertamina-green border border-pertamina-green/20 rounded-full">
                                    <span class="text-sm material-symbols-outlined"
                                        id="view-status-icon">check_circle</span>
                                    <span id="view-status-text">Completed</span>
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Additional Info --}}
                    <div
                        class="p-4 mt-6 border bg-slate-50/50 dark:bg-slate-800/50 rounded-xl border-slate-200/50 dark:border-slate-700">
                        <p class="mb-2 text-xs font-semibold uppercase text-slate-500 dark:text-slate-400">Additional Notes
                        </p>
                        <p class="text-sm text-slate-600 dark:text-slate-300">Distribution logged automatically by the
                            system. Verification matched with driver logs.</p>
                    </div>
                </div>

                <div
                    class="flex justify-end gap-3 px-6 py-4 border-t bg-slate-50/50 dark:bg-slate-800/50 border-slate-200/50 dark:border-slate-800">
                    <button type="button" onclick="closeViewModal()"
                        class="px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                        Close
                    </button>
                    <button type="button" onclick="printDetails()"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-pertamina-blue to-blue-600 rounded-xl hover:shadow-lg hover:scale-105 transition-all shadow-glow-blue">
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

            <div
                class="relative w-full max-w-2xl overflow-hidden text-left align-bottom transition-all transform border border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl shadow-glass dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div
                    class="px-6 py-5 border-b border-slate-200/50 dark:border-slate-800 bg-gradient-to-r from-orange-500/10 to-transparent">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center w-12 h-12 shadow-md rounded-xl bg-gradient-to-br from-orange-500 to-orange-600">
                                <span class="text-2xl text-white material-symbols-outlined">edit</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Edit Distribution</h3>
                                <p id="edit-modal-subtitle" class="text-sm text-slate-500 dark:text-slate-400">Update
                                    information for TRK-XXX</p>
                            </div>
                        </div>
                        <button type="button" onclick="closeEditModal()"
                            class="p-2 transition rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                            <span class="material-symbols-outlined text-slate-500">close</span>
                        </button>
                    </div>
                </div>

                <div class="px-6 py-6">
                    <form id="editForm" class="space-y-5" onsubmit="event.preventDefault(); submitEdit();">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Truck
                                    ID</label>
                                <input type="text" id="edit-truck"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                    required />
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Driver
                                    Name</label>
                                <input type="text" id="edit-driver"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                    required />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Fuel
                                    Type</label>
                                <select id="edit-fuel"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                    required>
                                    <option>Pertalite</option>
                                    <option>Pertamax</option>
                                    <option>Solar</option>
                                    <option>Dex</option>
                                </select>
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Volume
                                    (KL)</label>
                                <input type="number" id="edit-volume" step="0.01"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                    required />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Destination</label>
                                <input type="text" id="edit-destination"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                    required />
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Location</label>
                                <input type="text" id="edit-location"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                    required />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Date</label>
                                <input type="date" id="edit-date"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                    required />
                            </div>
                            <div>
                                <label
                                    class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Time</label>
                                <input type="time" id="edit-time"
                                    class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                    required />
                            </div>
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-semibold text-slate-700 dark:text-slate-300">Status</label>
                            <select id="edit-status"
                                class="w-full px-4 py-2.5 text-sm border rounded-xl border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 input-glass"
                                required>
                                <option>Loading</option>
                                <option>In Transit</option>
                                <option>Completed</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200/50 dark:border-slate-800">
                            <button type="button" onclick="closeEditModal()"
                                class="px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-bold text-white transition-all shadow-lg rounded-xl bg-gradient-to-r from-orange-500 to-amber-600 hover:scale-105 shadow-orange-500/30">
                                <span class="flex items-center gap-2">
                                    <span class="text-lg material-symbols-outlined">save</span>
                                    Update Distribution
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE CONFIRM MODAL --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-slate-900/75 backdrop-blur-sm" onclick="closeDeleteModal()">
            </div>
            <div
                class="relative w-full max-w-sm overflow-hidden text-left align-bottom transition-all transform border shadow-2xl border-white/50 dark:border-slate-700 bg-white/90 backdrop-blur-xl dark:bg-slate-900/90 rounded-2xl sm:my-8 sm:align-middle">
                <div class="p-6 text-center">
                    <div class="flex items-center justify-center mx-auto mb-4 rounded-full size-16 bg-pertamina-red/10">
                        <span class="text-3xl material-symbols-outlined text-pertamina-red">warning</span>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Hapus Data Distribusi?</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Peringatan: Data <strong id="delete-truck-id"
                            class="text-slate-700 dark:text-slate-300"></strong> akan dihapus sementara secara visual dari
                        tabel ini.</p>
                </div>
                <div
                    class="flex justify-center gap-3 px-6 py-4 border-t bg-slate-50/50 dark:bg-slate-800/50 border-slate-200/50 dark:border-slate-800">
                    <button type="button" onclick="closeDeleteModal()"
                        class="px-5 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">Batal</button>
                    <button type="button" id="confirmDeleteBtn"
                        class="px-5 py-2.5 text-sm font-bold text-white transition-all rounded-xl hover:shadow-lg hover:scale-105 bg-pertamina-red shadow-pertamina-red/30">Ya,
                        Hapus</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@stack('scripts')
@push('scripts')
    <script>
        // System Helpers
        function showToast(message) {
            const toast = document.getElementById('toastNotification');
            document.getElementById('toastMessage').textContent = message;

            toast.classList.remove('translate-x-full', 'opacity-0');

            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
            }, 3000);
        }

        // Modal Visibility Helpers
        function toggleModal(id, show) {
            const el = document.getElementById(id);
            if (show) {
                el.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                el.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Add Component
        function openAddModal() { toggleModal('addModal', true); }
        function closeAddModal() { toggleModal('addModal', false); }
        function submitAdd() {
            showToast('Distribution added successfully!');
            closeAddModal();
            document.getElementById('addForm').reset();
        }

        // View Component
        function openViewModal() { toggleModal('viewModal', true); }
        function closeViewModal() { toggleModal('viewModal', false); }
        function viewDistribution(id) {
            const row = document.getElementById('row-' + id);
            if (!row) return;

            document.getElementById('view-truck').textContent = row.dataset.truck;
            document.getElementById('view-driver').textContent = row.dataset.driver;
            document.getElementById('view-fuel').textContent = row.dataset.fuel;
            document.getElementById('view-volume').innerHTML = row.dataset.volume + ' <span class="text-sm font-normal text-slate-500">KL</span>';
            document.getElementById('view-destination').textContent = row.dataset.destination;
            document.getElementById('view-location').textContent = row.dataset.location;
            document.getElementById('view-datetime').textContent = row.dataset.displaydate + ', ' + row.dataset.time + ' WIB';

            // Status updates dynamically
            const iconSpan = document.getElementById('view-status-icon');
            const textSpan = document.getElementById('view-status-text');
            const container = document.getElementById('view-status-container');

            iconSpan.textContent = row.dataset.statusicon;
            textSpan.textContent = row.dataset.status;
            container.className = `inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-bold border border-current/20 rounded-full ${row.dataset.statusclass}`;

            openViewModal();
        }

        // Edit Component
        let currentEditId = null;
        function openEditModal() { toggleModal('editModal', true); }
        function closeEditModal() { toggleModal('editModal', false); currentEditId = null; }

        function editDistribution(id) {
            const row = document.getElementById('row-' + id);
            if (!row) return;
            currentEditId = id;

            document.getElementById('edit-modal-subtitle').textContent = "Update information for " + row.dataset.truck;

            document.getElementById('edit-truck').value = row.dataset.truck;
            document.getElementById('edit-driver').value = row.dataset.driver;
            document.getElementById('edit-fuel').value = row.dataset.fuel;
            document.getElementById('edit-volume').value = row.dataset.volume;
            document.getElementById('edit-destination').value = row.dataset.destination;
            document.getElementById('edit-location').value = row.dataset.location;
            document.getElementById('edit-date').value = row.dataset.date;
            document.getElementById('edit-time').value = row.dataset.time;
            document.getElementById('edit-status').value = row.dataset.status;

            openEditModal();
        }

        function submitEdit() {
            const row = document.getElementById('row-' + currentEditId);
            if (row) {
                // Update Dataset (Memory)
                row.dataset.truck = document.getElementById('edit-truck').value;
                row.dataset.driver = document.getElementById('edit-driver').value;
                row.dataset.fuel = document.getElementById('edit-fuel').value;
                row.dataset.volume = document.getElementById('edit-volume').value;
                row.dataset.destination = document.getElementById('edit-destination').value;
                row.dataset.location = document.getElementById('edit-location').value;
                row.dataset.date = document.getElementById('edit-date').value;
                row.dataset.time = document.getElementById('edit-time').value;

                // Format new date manually for display prototype
                const dInput = new Date(row.dataset.date);
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                row.dataset.displaydate = ("0" + dInput.getDate()).slice(-2) + " " + months[dInput.getMonth()] + " " + dInput.getFullYear();

                // Status Logic Mapping
                const newStatus = document.getElementById('edit-status').value;
                row.dataset.status = newStatus;

                if (newStatus === "Completed") {
                    row.dataset.statusclass = "bg-pertamina-green/10 text-pertamina-green dark:bg-pertamina-green/20 dark:text-green-400";
                    row.dataset.statusicon = "check_circle";
                } else if (newStatus === "In Transit") {
                    row.dataset.statusclass = "bg-pertamina-blue/10 text-pertamina-blue dark:bg-pertamina-blue/20 dark:text-blue-400";
                    row.dataset.statusicon = "local_shipping";
                } else {
                    row.dataset.statusclass = "bg-orange-500/10 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400";
                    row.dataset.statusicon = "schedule";
                }

                // Update DOM Visuals
                row.querySelector('.truck-display').textContent = row.dataset.truck;
                row.querySelector('.driver-display').textContent = 'Driver: ' + row.dataset.driver;
                row.querySelector('.fuel-display').textContent = row.dataset.fuel;
                row.querySelector('.volume-display').textContent = row.dataset.volume;
                row.querySelector('.destination-display').textContent = row.dataset.destination;
                row.querySelector('.location-display').textContent = row.dataset.location;
                row.querySelector('.date-display').textContent = row.dataset.displaydate;
                row.querySelector('.time-display').textContent = row.dataset.time + ' WIB';

                const badgeSpan = row.querySelector('.status-badge');
                badgeSpan.className = `status-badge inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold border border-current/10 ${row.dataset.statusclass} rounded-full`;
                badgeSpan.querySelector('.material-symbols-outlined').textContent = row.dataset.statusicon;
                badgeSpan.querySelector('.status-text').textContent = row.dataset.status;

                showToast('Distribution updated successfully!');
                filterTable(); // Re-index if necessary
            }
            closeEditModal();
        }

        // Delete Component
        let currentDeleteId = null;
        function openDeleteModal(id) {
            currentDeleteId = id;
            const row = document.getElementById('row-' + id);
            if (row) {
                document.getElementById('delete-truck-id').textContent = row.dataset.truck;
            }
            toggleModal('deleteModal', true);
        }

        function closeDeleteModal() { toggleModal('deleteModal', false); currentDeleteId = null; }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (currentDeleteId) {
                const row = document.getElementById('row-' + currentDeleteId);
                if (row) {
                    row.remove();
                    showToast('Distribution deleted successfully!');
                    filterTable();
                }
            }
            closeDeleteModal();
        });

        // Filtering
        let currentStatusFilter = 'all';

        function filterByStatus(status) {
            currentStatusFilter = status;

            document.querySelectorAll('.filter-pill').forEach(pill => {
                pill.classList.remove('active', 'border', 'border-current/20', 'shadow-sm');
            });

            const activePill = document.querySelector(`.filter-pill[data-status="${status}"]`);
            if (activePill) activePill.classList.add('active', 'border', 'border-current/20', 'shadow-sm');

            applyFilters();
        }

        function filterTable() { applyFilters(); }
        function filterByDate() { applyFilters(); }

        function applyFilters() {
            const searchValue = document.getElementById('searchInput').value.toLowerCase();
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;
            const rows = document.querySelectorAll('.table-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const truck = row.dataset.truck.toLowerCase();
                const destination = row.dataset.destination.toLowerCase();
                const statusName = row.dataset.status.toLowerCase().replace(' ', '-');
                const rowDate = new Date(row.dataset.date);

                const fromDate = dateFrom ? new Date(dateFrom) : new Date('1900-01-01');
                const toDate = dateTo ? new Date(dateTo) : new Date('2100-12-31');

                const matchesSearch = truck.includes(searchValue) || destination.includes(searchValue);
                const matchesStatus = currentStatusFilter === 'all' || statusName === currentStatusFilter;
                const matchesDate = rowDate >= fromDate && rowDate <= toDate;

                if (matchesSearch && matchesStatus && matchesDate) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            updateRecordCount(visibleCount);
        }

        function updateRecordCount(count) {
            const totalEl = document.getElementById('totalRecords');
            if (totalEl) totalEl.textContent = count;
            const showingEl = document.getElementById('showingCount');
            if (showingEl) showingEl.textContent = count > 0 ? "1-" + Math.min(count, 10) : "0";
        }

        // General Helpers
        function printDetails() { window.print(); }
        function exportData() { showToast('Exporting data...'); }
        function refreshTable() { location.reload(); }

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeAddModal();
                closeViewModal();
                closeEditModal();
                closeDeleteModal();
            }
        });

        document.querySelector('.filter-pill[data-status="all"]').classList.add('border', 'border-current/20', 'shadow-sm');
    </script>
@endpush