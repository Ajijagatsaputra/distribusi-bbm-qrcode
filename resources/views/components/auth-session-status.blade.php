@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 bg-green-50 border border-green-200 rounded-xl p-4 mb-4']) }}>
        {{ $status }}
    </div>
@endif
