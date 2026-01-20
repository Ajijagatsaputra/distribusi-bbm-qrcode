<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Operator Dashboard Overview</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
        <!-- Sidebar Navigation -->
        <aside
            class="w-72 bg-white dark:bg-[#1a202c] border-r border-[#dcdfe5] dark:border-slate-800 flex flex-col fixed h-full">
            <div class="flex flex-col h-full p-6">
                <!-- Branding -->
                <div class="flex items-center gap-3 mb-10">
                    <div class="flex items-center justify-center text-white rounded-lg bg-primary size-10">
                        <span class="material-symbols-outlined">local_gas_station</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-[#111318] dark:text-white text-base font-bold leading-tight">BBM Distribusi</h1>
                        <p class="text-[#636f88] dark:text-slate-400 text-xs font-medium">Operator Portal</p>
                    </div>
                </div>
                <!-- Nav Menu -->
                <nav class="flex flex-col flex-1 gap-1">
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary/10 text-primary" href="#">
                        <span class="material-symbols-outlined">dashboard</span>
                        <span class="text-sm font-semibold">Dashboard</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined">add_box</span>
                        <span class="text-sm font-medium">Input Distribution Data</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined">history</span>
                        <span class="text-sm font-medium">History</span>
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
                            data-alt="Headshot of the operator user"
                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDVgNo_uorxd8rjNHT77G2jaGK89g4eZ7rclYVsqYDUNjUmZJeTn4QLIhx_vZKylilj5wqxMEqwvcKzRCzoMPYvGHDt2iP0tzxZN1aA6hYwEW83KumfMERF7kVF8oE6HFq0R5Gx17q2gpf_4HB01t_utrO5i7wC_DTNyA59sHB4B34_6aheXei2mphjT9FkVdz5F1xdRfyqKGhmgl-25Ce3K0w_2A-ibC5AFR0N7zWaIDbNiaq44weYdy3q-ZpHQbVbsw1tSMaWrw')">
                        </div>
                        <div class="flex flex-col overflow-hidden">
                            <p class="text-sm font-bold truncate">Ahmad Fauzi</p>
                            <p class="text-xs text-[#636f88] dark:text-slate-400">Station 04 - Bandung</p>
                        </div>
                    </div>
                    <button
                        class="flex items-center w-full gap-3 px-4 py-3 text-red-500 transition-colors rounded-lg hover:bg-red-50 dark:hover:bg-red-900/10">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="text-sm font-semibold">Logout</span>
                    </button>
                </div>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 ml-72">
            <div class="max-w-[1100px] mx-auto p-8">
                <!-- Page Heading -->
                <div class="flex flex-wrap items-end justify-between gap-4 mb-8">
                    <div class="flex flex-col gap-2">
                        <p class="text-[#111318] dark:text-white text-4xl font-black leading-tight tracking-tight">
                            Operator Dashboard</p>
                        <p class="text-[#636f88] dark:text-slate-400 text-base font-normal leading-normal">Welcome back.
                            Manage fuel distribution entries accurately.</p>
                    </div>
                    <div
                        class="px-4 py-2 bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 rounded-lg shadow-sm">
                        <p class="text-xs text-[#636f88] dark:text-slate-400 font-bold uppercase tracking-wider">Current
                            Shift</p>
                        <p class="text-sm font-medium">Monday, Oct 23, 2023 • 08:00 - 16:00</p>
                    </div>
                </div>
                <!-- Stats Summary -->
                <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 shadow-sm">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-[#636f88] dark:text-slate-400 text-sm font-medium">Entries Today</p>
                            <span class="material-symbols-outlined text-primary">assignment</span>
                        </div>
                        <p class="text-[#111318] dark:text-white tracking-tight text-3xl font-bold">12</p>
                    </div>
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 shadow-sm">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-[#636f88] dark:text-slate-400 text-sm font-medium">Total Volume (L)</p>
                            <span class="material-symbols-outlined text-primary">ev_station</span>
                        </div>
                        <p class="text-[#111318] dark:text-white tracking-tight text-3xl font-bold">45,200</p>
                    </div>
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 shadow-sm">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-[#636f88] dark:text-slate-400 text-sm font-medium">System Status</p>
                            <span class="text-green-500 material-symbols-outlined">check_circle</span>
                        </div>
                        <p
                            class="text-[#111318] dark:text-white tracking-tight text-3xl font-bold text-green-600 dark:text-green-400">
                            Online</p>
                    </div>
                </div>
                <!-- Quick Action Panel -->
                <div class="mb-10">
                    <div
                        class="flex flex-col items-center justify-between gap-6 p-8 border rounded-xl border-primary/20 bg-primary/5 dark:bg-primary/10 md:flex-row">
                        <div class="flex flex-col gap-2">
                            <h2 class="flex items-center gap-2 text-xl font-bold leading-tight text-primary">
                                <span class="material-symbols-outlined">add_circle</span>
                                New Fuel Distribution Entry
                            </h2>
                            <p
                                class="text-[#636f88] dark:text-slate-400 text-base font-normal max-w-2xl leading-relaxed">
                                Start a new log for vehicle fuel dispatching. Please ensure all meter readings are
                                verified against the manual meter before submitting.
                            </p>
                        </div>
                        <button
                            class="whitespace-nowrap flex h-14 px-8 items-center justify-center rounded-lg bg-primary text-white text-base font-bold shadow-lg shadow-primary/30 hover:bg-blue-700 transition-all transform hover:scale-[1.02] active:scale-[0.98]">
                            Input Distribution Data
                        </button>
                    </div>
                </div>
                <!-- Recent History Section -->
                <div>
                    <div class="flex items-center justify-between px-1 mb-4">
                        <h2 class="text-[#111318] dark:text-white text-xl font-bold leading-tight">Last 5 Entries</h2>
                        <a class="flex items-center gap-1 text-sm font-bold text-primary hover:underline"
                            href="#">
                            View All History
                            <span class="text-sm material-symbols-outlined">arrow_forward</span>
                        </a>
                    </div>
                    <div
                        class="bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 rounded-xl overflow-hidden shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-slate-50 dark:bg-slate-800/50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-[#636f88] dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                                        Time</th>
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
                                        Status</th>
                                    <th class="px-6 py-4 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#dcdfe5] dark:divide-slate-800">
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 text-sm font-medium">14:45</td>
                                    <td class="px-6 py-4 text-sm font-bold">D 1234 ABC</td>
                                    <td class="px-6 py-4 text-sm">Pertalite</td>
                                    <td class="px-6 py-4 text-sm font-bold">250.00</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Success
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 text-sm font-medium">13:10</td>
                                    <td class="px-6 py-4 text-sm font-bold">B 9876 XYZ</td>
                                    <td class="px-6 py-4 text-sm">Pertamax</td>
                                    <td class="px-6 py-4 text-sm font-bold">45.50</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Success
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 text-sm font-medium">11:55</td>
                                    <td class="px-6 py-4 text-sm font-bold">D 4455 DEF</td>
                                    <td class="px-6 py-4 text-sm">Solar</td>
                                    <td class="px-6 py-4 text-sm font-bold">1,200.00</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 text-sm font-medium">10:20</td>
                                    <td class="px-6 py-4 text-sm font-bold">Z 1122 GHI</td>
                                    <td class="px-6 py-4 text-sm">Pertalite</td>
                                    <td class="px-6 py-4 text-sm font-bold">30.00</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Success
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4 text-sm font-medium">08:45</td>
                                    <td class="px-6 py-4 text-sm font-bold">D 8888 JKL</td>
                                    <td class="px-6 py-4 text-sm">Pertamax Turbo</td>
                                    <td class="px-6 py-4 text-sm font-bold">60.00</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Success
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-[#636f88] hover:text-primary"><span
                                                class="material-symbols-outlined">more_horiz</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
