{{-- Stats Card Component --}}
@props([
    'title',
    'value',
    'icon',
    'iconColor' => 'text-primary',
    'valueColor' => 'text-[#111318] dark:text-white',
    'badge' => null,
    'trend' => null
])

<div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 shadow-sm">
    <div class="flex items-center justify-between mb-1">
        <p class="text-[#636f88] dark:text-slate-400 text-sm font-medium">{{ $title }}</p>
        <span class="material-symbols-outlined {{ $iconColor }}">{{ $icon }}</span>
    </div>

    <div class="flex items-end justify-between gap-2">
        <p class="{{ $valueColor }} tracking-tight text-3xl font-bold">{{ $value }}</p>

        @if($trend)
            <span class="text-xs font-semibold {{ $trend['type'] === 'up' ? 'text-green-600' : 'text-red-600' }} flex items-center gap-0.5 mb-1">
                <span class="text-base material-symbols-outlined">
                    {{ $trend['type'] === 'up' ? 'trending_up' : 'trending_down' }}
                </span>
                {{ $trend['value'] }}
            </span>
        @endif
    </div>

    @if($badge)
        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 w-fit mt-2">
            {{ $badge }}
        </span>
    @endif
</div>
