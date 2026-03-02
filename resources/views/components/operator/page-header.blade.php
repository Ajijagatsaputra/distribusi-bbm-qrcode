{{-- Page Header Component --}}
@props([
    'title',
    'description' => null,
    'action' => null
])

<div class="flex flex-wrap items-end justify-between gap-4 mb-8">
    <div class="flex flex-col gap-2">
        <h1 class="text-[#111318] dark:text-white text-4xl font-black leading-tight tracking-tight">
            {{ $title }}
        </h1>
        @if($description)
            <p class="text-[#636f88] dark:text-slate-400 text-base font-normal leading-normal">
                {{ $description }}
            </p>
        @endif
    </div>

    @if($action)
        <div>
            {{ $action }}
        </div>
    @endif
</div>
