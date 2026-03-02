{{-- Table Wrapper Component --}}
@props([
    'title' => null,
    'description' => null,
    'actions' => null
])

<div class="bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
    @if($title || $description || $actions)
        <div class="px-6 py-4 border-b border-[#dcdfe5] dark:border-slate-800 flex items-center justify-between">
            <div>
                @if($title)
                    <h3 class="text-[#111318] dark:text-white text-lg font-bold">{{ $title }}</h3>
                @endif
                @if($description)
                    <p class="text-[#636f88] dark:text-slate-400 text-sm mt-1">{{ $description }}</p>
                @endif
            </div>
            @if($actions)
                <div>
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            @isset($header)
                <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-[#dcdfe5] dark:border-slate-800">
                    <tr>
                        {{ $header }}
                    </tr>
                </thead>
            @endisset

            <tbody class="divide-y divide-[#dcdfe5] dark:divide-slate-800">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @isset($footer)
        <div class="px-6 py-4 bg-slate-50 dark:bg-slate-800/30 border-t border-[#dcdfe5] dark:border-slate-800">
            {{ $footer }}
        </div>
    @endisset
</div>
