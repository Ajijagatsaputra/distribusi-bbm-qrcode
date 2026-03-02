@extends('layouts.admin')

@section('title', 'Distribution Data')

@section('content')

    {{-- PAGE HEADER (TETAP, TIDAK DIUBAH) --}}
    <div class="flex flex-wrap items-start justify-between gap-6">
        <div>
            <h3 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">
                Distribution Data
            </h3>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                View and manage all fuel shipment records
            </p>
        </div>

        <div class="flex items-center gap-3">
            <button
                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition border rounded-lg text-slate-700 dark:text-slate-200 border-slate-300 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800">
                <span class="material-symbols-outlined">download</span>
                Export Data
            </button>

            <button
                class="flex items-center gap-2 px-5 py-2 text-sm font-semibold text-white rounded-lg bg-primary hover:bg-primary/90">
                <span class="material-symbols-outlined">add</span>
                Add Distribution
            </button>
        </div>
    </div>

    {{-- FILTER --}}
    <x-admin.table-filters />

    {{-- TABLE --}}
    <x-admin.distribution-table />

@endsection
