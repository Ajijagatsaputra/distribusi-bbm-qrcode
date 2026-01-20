<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Operator Distribution History</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#195de6",
                        "background-light": "#f6f6f8",
                        "background-dark": "#111621",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark min-h-screen text-[#111318] dark:text-white">
    <div class="flex min-h-screen">
        <aside
            class="w-72 bg-white dark:bg-[#1a202c] border-r border-[#dcdfe5] dark:border-slate-800 flex flex-col fixed h-full z-20">
            <div class="flex flex-col h-full p-6">
                <div class="flex items-center gap-3 mb-10">
                    <div class="flex items-center justify-center text-white rounded-lg bg-primary size-10">
                        <span class="material-symbols-outlined">local_gas_station</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-[#111318] dark:text-white text-base font-bold leading-tight">BBM Distribusi</h1>
                        <p class="text-[#636f88] dark:text-slate-400 text-xs font-medium">Operator Portal</p>
                    </div>
                </div>
                <nav class="flex flex-col flex-1 gap-1">
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="{{ route('operator.dashboard') }}">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="{{ route('operator.input-distribution') }}">
                        <span class="material-symbols-outlined">add_box</span>
                        <span class="text-sm font-medium">Input Distribution Data</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary/10 text-primary" href="#">
                        <span class="material-symbols-outlined">history</span>
                        <span class="text-sm font-semibold">History</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined">person</span>
                        <span class="text-sm font-medium">Profile</span>
                    </a>
                </nav>
                <div class="mt-auto pt-6 border-t border-[#dcdfe5] dark:border-slate-800">
                    <div class="flex items-center gap-3 px-2 mb-4">
                        <div class="bg-center bg-cover rounded-full size-8 bg-slate-200"
                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDVgNo_uorxd8rjNHT77G2jaGK89g4eZ7rclYVsqYDUNjUmZJeTn4QLIhx_vZKylilj5wqxMEqwvcKzRCzoMPYvGHDt2iP0tzxZN1aA6hYwEW83KumfMERF7kVF8oE6HFq0R5Gx17q2gpf_4HB01t_utrO5i7wC_DTNyA59sHB4B34_6aheXei2mphjT9FkVdz5F1xdRfyqKGhmgl-25Ce3K0w_2A-ibC5AFR0N7zWaIDbNiaq44weYdy3q-ZpHQbVbsw1tSMaWrw')">
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <p class="text-sm font-bold truncate">Ahmad Fauzi</p>
                            <p class="text-xs text-[#636f88] dark:text-slate-400">Station 04 - Bandung</p>
                        </div>
                    </div>
                     <button
                        class="flex items-center w-full gap-3 px-4 py-3 text-red-500 transition-colors rounded-lg hover:bg-red-50 dark:hover:bg-red-900/10"
                        onclick="event.preventDefault(); document.location.href = '{{ url('/') }}'" type="button">
                        <a href="{{ url('/') }}"></a>
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm font-semibold">Logout</span>
                    </button>
                </div>
            </div>
        </aside>
        <main class="flex-1 ml-72">
            <div class="max-w-[1200px] mx-auto p-8">
                <div class="mb-8">
                    <h1 class="text-[#111318] dark:text-white text-3xl font-black leading-tight tracking-tight mb-2">
                        Distribution History</h1>
                    <p class="text-[#636f88] dark:text-slate-400 text-base font-normal">View and audit all past fuel
                        distribution logs recorded from this station.</p>
                </div>
                <div
                    class="bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 rounded-xl p-5 mb-6 flex flex-wrap items-center justify-between gap-4 shadow-sm">
                    <div class="flex flex-wrap items-center flex-1 gap-4">
                        <div class="relative w-full max-w-sm">
                            <span
                                class="absolute text-lg -translate-y-1/2 material-symbols-outlined left-3 top-1/2 text-slate-400">search</span>
                            <input
                                class="w-full pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border-[#dcdfe5] dark:border-slate-800 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all"
                                placeholder="Search by vehicle ID or destination..." type="text" />
                        </div>
                        <div
                            class="flex items-center gap-2 bg-slate-50 dark:bg-slate-900 border border-[#dcdfe5] dark:border-slate-800 rounded-lg px-3 py-2">
                            <span class="text-lg material-symbols-outlined text-slate-400">calendar_today</span>
                            <input class="p-0 text-sm bg-transparent border-none focus:ring-0 dark:text-white"
                                type="date" />
                            <span class="text-xs text-slate-400">to</span>
                            <input class="p-0 text-sm bg-transparent border-none focus:ring-0 dark:text-white"
                                type="date" />
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button
                            class="flex items-center gap-2 px-4 py-2 border border-[#dcdfe5] dark:border-slate-800 rounded-lg text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                            <span class="text-lg material-symbols-outlined">filter_list</span>
                            Filter
                        </button>
                        <button
                            class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg bg-slate-900 dark:bg-slate-700 hover:bg-black">
                            <span class="text-lg material-symbols-outlined">download</span>
                            Export
                        </button>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead
                                class="bg-slate-50 dark:bg-slate-800/50 border-b border-[#dcdfe5] dark:border-slate-800">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-[#636f88] dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        Date &amp; Time</th>
                                    <th
                                        class="px-6 py-4 text-[#636f88] dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        Vehicle ID</th>
                                    <th
                                        class="px-6 py-4 text-[#636f88] dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        Fuel Type</th>
                                    <th
                                        class="px-6 py-4 text-[#636f88] dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        Volume (L)</th>
                                    <th
                                        class="px-6 py-4 text-[#636f88] dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        Destination</th>
                                    <th
                                        class="px-6 py-4 text-[#636f88] dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        Status</th>
                                    <th class="px-6 py-4 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#dcdfe5] dark:divide-slate-800">
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold">Oct 23, 2023</div>
                                        <div class="text-xs text-[#636f88]">14:45 PM</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold">D 1234 ABC</td>
                                    <td class="px-6 py-4 text-sm">Pertalite</td>
                                    <td class="px-6 py-4 text-sm font-bold">250.00</td>
                                    <td class="px-6 py-4 text-sm">Depot Siliwangi</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Success</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary transition-colors"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold">Oct 23, 2023</div>
                                        <div class="text-xs text-[#636f88]">13:10 PM</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold">B 9876 XYZ</td>
                                    <td class="px-6 py-4 text-sm">Pertamax</td>
                                    <td class="px-6 py-4 text-sm font-bold">45.50</td>
                                    <td class="px-6 py-4 text-sm">SPBU Pasteur</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Success</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary transition-colors"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold">Oct 23, 2023</div>
                                        <div class="text-xs text-[#636f88]">11:55 AM</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold">D 4455 DEF</td>
                                    <td class="px-6 py-4 text-sm">Solar</td>
                                    <td class="px-6 py-4 text-sm font-bold">1,200.00</td>
                                    <td class="px-6 py-4 text-sm">Logistics Center A</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary transition-colors"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold">Oct 23, 2023</div>
                                        <div class="text-xs text-[#636f88]">10:20 AM</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold">Z 1122 GHI</td>
                                    <td class="px-6 py-4 text-sm">Pertalite</td>
                                    <td class="px-6 py-4 text-sm font-bold">30.00</td>
                                    <td class="px-6 py-4 text-sm">Main Hub</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Success</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary transition-colors"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold">Oct 23, 2023</div>
                                        <div class="text-xs text-[#636f88]">09:15 AM</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold">F 5566 JKL</td>
                                    <td class="px-6 py-4 text-sm">Pertamax Turbo</td>
                                    <td class="px-6 py-4 text-sm font-bold">120.00</td>
                                    <td class="px-6 py-4 text-sm">Emergency Services</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">Failed</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary transition-colors"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold">Oct 22, 2023</div>
                                        <div class="text-xs text-[#636f88]">17:30 PM</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold">D 8888 JKL</td>
                                    <td class="px-6 py-4 text-sm">Pertamax Turbo</td>
                                    <td class="px-6 py-4 text-sm font-bold">60.00</td>
                                    <td class="px-6 py-4 text-sm">SPBU Buah Batu</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Success</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary transition-colors"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="px-6 py-4 bg-slate-50 dark:bg-slate-800/30 border-t border-[#dcdfe5] dark:border-slate-800 flex items-center justify-between">
                        <p class="text-sm text-[#636f88] dark:text-slate-400 font-medium">
                            Showing <span class="text-[#111318] dark:text-white">1</span> to <span
                                class="text-[#111318] dark:text-white">6</span> of <span
                                class="text-[#111318] dark:text-white">124</span> results
                        </p>
                        <div class="flex items-center gap-2">
                            <button
                                class="p-2 border border-[#dcdfe5] dark:border-slate-800 rounded-lg hover:bg-white dark:hover:bg-slate-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                                disabled="">
                                <span class="material-symbols-outlined">chevron_left</span>
                            </button>
                            <button
                                class="flex items-center justify-center text-sm font-bold text-white rounded-lg size-9 bg-primary">1</button>
                            <button
                                class="flex items-center justify-center text-sm font-medium rounded-lg size-9 hover:bg-slate-200 dark:hover:bg-slate-800">2</button>
                            <button
                                class="flex items-center justify-center text-sm font-medium rounded-lg size-9 hover:bg-slate-200 dark:hover:bg-slate-800">3</button>
                            <span class="px-2">...</span>
                            <button
                                class="flex items-center justify-center text-sm font-medium rounded-lg size-9 hover:bg-slate-200 dark:hover:bg-slate-800">12</button>
                            <button
                                class="p-2 border border-[#dcdfe5] dark:border-slate-800 rounded-lg hover:bg-white dark:hover:bg-slate-700 transition-colors">
                                <span class="material-symbols-outlined">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
