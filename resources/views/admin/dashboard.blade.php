@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')

    {{-- PAGE HEADER --}}
    <x-admin.page-header />

    {{-- STATS --}}
    <x-admin.stats :totalVolume="$totalVolume" :totalSpbu="$totalSpbu" :activeDistributions="$activeDistributions"
        :pendingSuratJalan="$pendingSuratJalan" />

    {{-- CHART + ACTIVITY --}}
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <x-admin.chart-card :weeklyVolume="$weeklyVolume" :dailyAverage="$dailyAverage" />
        </div>
        <div>
            <x-admin.activity :recentActivities="$recentActivities" />
        </div>
    </div>

@endsection