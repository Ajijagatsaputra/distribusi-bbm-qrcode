{{-- Generic Card Component --}}
@props([
    'padding' => 'p-6',
    'rounded' => 'rounded-xl',
    'shadow' => 'shadow-sm',
    'border' => true
])

<div {{ $attributes->merge([
    'class' => "bg-white dark:bg-[#1a202c] $rounded $shadow $padding " .
               ($border ? 'border border-[#dcdfe5] dark:border-slate-800' : '')
]) }}>
    {{ $slot }}
</div>
