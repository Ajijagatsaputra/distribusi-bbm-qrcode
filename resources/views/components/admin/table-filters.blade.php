<div class="flex flex-col justify-between gap-4 md:flex-row md:items-end">

    <div class="flex flex-wrap items-center gap-3">
        <div class="relative w-full max-w-sm">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                <span class="material-symbols-outlined">search</span>
            </span>
            <input
                class="w-full pl-10 pr-4 text-sm bg-white rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-800 focus:ring-2 focus:ring-primary/20"
                placeholder="Search by Truck ID, Fuel, or Destination..."
                type="text" />
        </div>

        <input type="date"
            class="px-4 text-sm bg-white rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-800" />

        <span class="font-medium text-slate-400">to</span>

        <input type="date"
            class="px-4 text-sm bg-white rounded-lg h-11 dark:bg-slate-800 border-slate-200 dark:border-slate-800" />
    </div>

    <button
        class="flex items-center justify-center gap-2 px-5 text-sm font-bold bg-white border rounded-lg h-11 dark:bg-background-dark border-slate-200 dark:border-slate-800 hover:bg-slate-50">
        <span class="material-symbols-outlined">filter_list</span>
        Filters
    </button>

</div>
