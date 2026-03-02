{{-- Table Row Component --}}
@props(['hover' => true])

<tr {{ $attributes->merge([
    'class' => ($hover ? 'transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30' : '')
]) }}>
    {{ $slot }}
</tr>
