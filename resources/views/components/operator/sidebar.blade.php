{{-- Sidebar Navigation Component --}}
@props([
    'user' => [
        'name' => 'Ahmad Fauzi',
        'station' => 'Station 04 - Bandung',
        'avatar' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDVgNo_uorxd8rjNHT77G2jaGK89g4eZ7rclYVsqYDUNjUmZJeTn4QLIhx_vZKylilj5wqxMEqwvcKzRCzoMPYvGHDt2iP0tzxZN1aA6hYwEW83KumfMERF7kVF8oE6HFq0R5Gx17q2gpf_4HB01t_utrO5i7wC_DTNyA59sHB4B34_6aheXei2mphjT9FkVdz5F1xdRfyqKGhmgl-25Ce3K0w_2A-ibC5AFR0N7zWaIDbNiaq44weYdy3q-ZpHQbVbsw1tSMaWrw'
    ]
])

<aside class="w-72 bg-white dark:bg-[#1a202c] border-r border-[#dcdfe5] dark:border-slate-800 flex flex-col fixed h-full z-20">
    <div class="flex flex-col h-full p-6">
        <!-- Branding -->
        <div class="flex items-center gap-3 mb-10">
            <div class="flex items-center justify-center text-white rounded-lg bg-primary size-10">
                <span class="material-symbols-outlined">local_gas_station</span>
            </div>
            <div class="flex flex-col">
                <h1 class="text-[#111318] dark:text-white text-base font-bold leading-tight">BBM Distribusi</h1>
                <p class="text-[#636f88] dark:text-slate-400 text-xs font-medium">Driver Portal</p>
            </div>
        </div>

        <!-- Nav Menu -->
        <nav class="flex flex-col flex-1 gap-1">
            <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('operator.dashboard') ? 'bg-primary/10 text-primary' : 'text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                href="{{ route('operator.dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <span class="text-sm {{ request()->routeIs('operator.dashboard') ? 'font-semibold' : 'font-medium' }}">Dashboard</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('operator.input-distribution') ? 'bg-primary/10 text-primary' : 'text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                href="{{ route('operator.input-distribution') }}">
                <span class="material-symbols-outlined">add_box</span>
                <span class="text-sm {{ request()->routeIs('operator.input-distribution') ? 'font-semibold' : 'font-medium' }}">Input Distribution Data</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('operator.history') ? 'bg-primary/10 text-primary' : 'text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800' }} transition-colors"
                href="{{ route('operator.history') }}">
                <span class="material-symbols-outlined">history</span>
                <span class="text-sm {{ request()->routeIs('operator.history') ? 'font-semibold' : 'font-medium' }}">History</span>
            </a>

            <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                href="#">
                <span class="material-symbols-outlined">person</span>
                <span class="text-sm font-medium">Profile</span>
            </a>
        </nav>

        <!-- Profile & Logout -->
        <div class="mt-auto pt-6 border-t border-[#dcdfe5] dark:border-slate-800">
            <div class="flex items-center gap-3 px-2 mb-4">
                <div class="bg-center bg-cover rounded-full size-8 bg-slate-200"
                    style="background-image: url('{{ $user['avatar'] }}')">
                </div>
                <div class="flex flex-col overflow-hidden">
                    <p class="text-sm font-bold truncate">{{ $user['name'] }}</p>
                    <p class="text-xs text-[#636f88] dark:text-slate-400">{{ $user['station'] }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    class="flex items-center w-full gap-3 px-4 py-3 text-red-500 transition-colors rounded-lg hover:bg-red-50 dark:hover:bg-red-900/10"
                    type="submit">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm font-semibold">Logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
