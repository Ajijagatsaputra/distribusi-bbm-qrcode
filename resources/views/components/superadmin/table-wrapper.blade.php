@props(['title'])

<div class="bg-white rounded shadow">
    <div class="px-6 py-4 font-semibold border-b">
        {{ $title }}
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            {{ $slot }}
        </table>
    </div>
</div>
