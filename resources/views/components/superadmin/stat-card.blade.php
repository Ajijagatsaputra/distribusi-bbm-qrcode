@props(['title', 'value', 'icon', 'color' => 'pertamina-blue'])

@php
    $bgColorClass = 'bg-'.$color.'/10';
    $textColorClass = 'text-'.$color;
    $glowClass = 'group-hover:bg-'.$color.'/20';
@endphp

<div class="glass-panel p-6 rounded-3xl hover-lift relative overflow-hidden group">
    <div class="absolute -right-6 -top-6 size-24 {{ $bgColorClass }} rounded-full blur-xl {{ $glowClass }} transition-colors"></div>
    <div class="flex flex-col h-full relative z-10">
        <div class="flex items-start justify-between mb-2">
            <span class="text-xs font-bold tracking-wider uppercase text-slate-500">{{ $title }}</span>
            <div class="size-12 rounded-2xl {{ $bgColorClass }} flex items-center justify-center {{ $textColorClass }}">
                <span class="material-symbols-outlined">{{ $icon }}</span>
            </div>
        </div>
        <h4 class="mt-auto text-4xl font-extrabold text-slate-900 dark:text-white">{{ $value }}</h4>
    </div>
</div>
