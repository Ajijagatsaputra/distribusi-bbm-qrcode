@props(['title', 'subtitle' => null])

<div class="mb-6">
    <h2 class="text-xl font-bold">{{ $title }}</h2>
    @if($subtitle)
        <p class="text-sm text-gray-500">{{ $subtitle }}</p>
    @endif
</div>
