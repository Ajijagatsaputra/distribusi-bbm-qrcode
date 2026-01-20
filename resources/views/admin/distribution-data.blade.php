<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin - Distribution Data Table | Distribusi BBM</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
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
                        "display": ["Inter"]
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

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
    <div class="flex min-h-screen">
        <aside
            class="w-72 bg-white dark:bg-background-dark border-r border-slate-200 dark:border-slate-800 flex flex-col fixed h-full z-50">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="size-10 bg-primary rounded-lg flex items-center justify-center text-white">
                        <span class="material-symbols-outlined">local_gas_station</span>
                    </div>
                    <div>
                        <h1 class="text-slate-900 dark:text-white text-lg font-bold leading-none">Distribusi BBM</h1>
                        <p class="text-slate-500 dark:text-slate-400 text-xs font-medium uppercase tracking-wider mt-1">
                            Admin Panel</p>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1">
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all"
                    href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm">Dashboard</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl bg-primary/10 text-primary font-semibold transition-all"
                    href="{{ route('admin.distribution-data') }}">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="text-sm">Distribution Data</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all"
                    href="{{ route('admin.reports') }}">
                    <span class="material-symbols-outlined">description</span>
                    <span class="text-sm">Reports</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all"
                    href="{{ route('admin.profile') }}">
                    <span class="material-symbols-outlined">person</span>
                    <span class="text-sm">Profile</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all"
                    href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="text-sm">Settings</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:bg-red-50 dark:hover:bg-red-950/20 transition-all"
                    href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm">Logout</span>
                </a>
            </div>
        </aside>
        <main class="flex-1 ml-72 flex flex-col min-h-screen">
            <header
                class="h-20 bg-white dark:bg-background-dark border-b border-slate-200 dark:border-slate-800 flex items-center justify-between px-8 sticky top-0 z-40">
                <div class="flex items-center gap-6">
                    <h2 class="text-slate-900 dark:text-white text-xl font-bold">Distribution Data</h2>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="size-10 flex items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div class="h-8 w-px bg-slate-200 dark:border-slate-800 mx-2"></div>
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white leading-none">Budi Santoso
                            </p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Admin Logistik</p>
                        </div>
                        <div class="size-10 rounded-full bg-cover bg-center border border-slate-200"
                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBaxsyFU2s-cKzz4FWJMKlmZTryMxQe8wCPCL7L9fe0eQgsyljihrG2JuY8c5EyHYNYW_wTamxfdToLg0zvby2PsBRDr6QfB5yFg4oVbZohnuc5RRHAGduc6I0fpnfKf9My8o_G5iBSwY5rMDKBPb_ymOd7wr0l0cJlKLlsW-bMdiz5a3x_ku1CdQkbV_7mcPshYV3cFRajyMjc5WCnsvB_oc9nYUMso5dnmWzJZpT-dJbiAcFW8NItBFFid9Ofjf05XPgBhBLI5Q');">
                        </div>
                    </div>
                </div>
            </header>
            <div class="p-8 space-y-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                    <div class="space-y-4 flex-1">
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Manage
                                Distributions</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">View and manage all fuel shipment
                                records across active routes.</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <div class="relative group w-full max-w-sm">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                    <span class="material-symbols-outlined text-xl">search</span>
                                </span>
                                <input
                                    class="h-11 w-full bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-800 rounded-lg pl-10 pr-4 text-sm focus:ring-2 focus:ring-primary/20 transition-all"
                                    placeholder="Search by Truck ID, Fuel, or Destination..." type="text" />
                            </div>
                            <div class="relative">
                                <input
                                    class="h-11 px-4 pr-10 bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-800 rounded-lg text-sm text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-primary/20"
                                    type="date" value="2023-10-24" />
                                <span
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                                </span>
                            </div>
                            <span class="text-slate-400 font-medium">to</span>
                            <div class="relative">
                                <input
                                    class="h-11 px-4 pr-10 bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-800 rounded-lg text-sm text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-primary/20"
                                    type="date" value="2023-10-31" />
                                <span
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="flex items-center justify-center gap-2 h-11 px-5 rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark text-slate-700 dark:text-white text-sm font-bold hover:bg-slate-50 transition-all">
                            <span class="material-symbols-outlined text-xl">filter_list</span>
                            Filters
                        </button>
                        <button
                            class="flex items-center justify-center gap-2 h-11 px-5 rounded-lg bg-primary text-white text-sm font-bold hover:bg-primary/90 shadow-lg shadow-primary/20 transition-all whitespace-nowrap">
                            <span class="material-symbols-outlined text-xl">add</span>
                            Add New Distribution
                        </button>
                    </div>
                </div>
                <div
                    class="bg-white dark:bg-background-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr
                                    class="bg-slate-50/80 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                        Truck ID</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                        Fuel Type</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">
                                        Quantity (L)</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                        Destination</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-center">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-semibold text-slate-900 dark:text-white">Oct 24,
                                            2023</span>
                                        <p class="text-[10px] text-slate-500 uppercase font-medium">08:30 AM</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-sm text-slate-600 dark:text-slate-300 font-mono">B-9912-FGH</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="size-2 rounded-full bg-blue-500"></div>
                                            <span class="text-sm text-slate-600 dark:text-slate-300">Pertalite</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="text-sm font-bold text-slate-900 dark:text-white">12,000</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm text-slate-900 dark:text-white font-medium">SPBU
                                                31.114.03</span>
                                            <span class="text-xs text-slate-500">Jakarta Selatan, DKI Jakarta</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold bg-blue-50 text-blue-600 dark:bg-blue-900/20 rounded-full">
                                            <span class="size-1.5 rounded-full bg-blue-600"></span>
                                            In Transit
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button
                                                class="text-primary hover:text-primary/80 text-sm font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-base">visibility</span>
                                                Details
                                            </button>
                                            <button
                                                class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-sm font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-base">edit</span> Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-semibold text-slate-900 dark:text-white">Oct 24,
                                            2023</span>
                                        <p class="text-[10px] text-slate-500 uppercase font-medium">06:45 AM</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-sm text-slate-600 dark:text-slate-300 font-mono">B-8221-VBN</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="size-2 rounded-full bg-red-500"></div>
                                            <span class="text-sm text-slate-600 dark:text-slate-300">Pertamax</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="text-sm font-bold text-slate-900 dark:text-white">8,000</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm text-slate-900 dark:text-white font-medium">Terminal
                                                Pelabuhan</span>
                                            <span class="text-xs text-slate-500">Tanjung Priok, Jakarta Utara</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold bg-green-50 text-green-600 dark:bg-green-900/20 rounded-full">
                                            <span class="size-1.5 rounded-full bg-green-600"></span>
                                            Delivered
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button
                                                class="text-primary hover:text-primary/80 text-sm font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-base">visibility</span>
                                                Details
                                            </button>
                                            <button
                                                class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-sm font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-base">edit</span> Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-semibold text-slate-900 dark:text-white">Oct 23,
                                            2023</span>
                                        <p class="text-[10px] text-slate-500 uppercase font-medium">09:15 PM</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="text-sm text-slate-600 dark:text-slate-300 font-mono">B-1123-JKO</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div class="size-2 rounded-full bg-slate-700"></div>
                                            <span class="text-sm text-slate-600 dark:text-slate-300">Solar Dex</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <span class="text-sm font-bold text-slate-900 dark:text-white">16,000</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm text-slate-900 dark:text-white font-medium">Industrial
                                                Area Cikupa</span>
                                            <span class="text-xs text-slate-500">Tangerang, Banten</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold bg-amber-50 text-amber-600 dark:bg-amber-900/20 rounded-full">
                                            <span class="size-1.5 rounded-full bg-amber-600"></span>
                                            Loading
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button
                                                class="text-primary hover:text-primary/80 text-sm font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-base">visibility</span>
                                                Details
                                            </button>
                                            <button
                                                class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white text-sm font-bold flex items-center gap-1">
                                                <span class="material-symbols-outlined text-base">edit</span> Edit
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm font-semibold text-slate-900 dark:text-white">Oct 23,
                                            2023</span>
                                        <p class="text-[10px] text-slate-500 uppercase font-medium">04:20 PM</p>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap font-mono text-sm text-slate-600 dark:text-slate-300">
                                        B-7721-AAA</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                        Pertalite</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-right font-bold text-slate-900 dark:text-white">
                                        12,000</td>
                                    <td class="px-6 py-4 text-sm text-slate-900 dark:text-white">SPBU 31.222.01</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-bold bg-green-50 text-green-600 dark:bg-green-900/20 rounded-full">
                                            <span class="size-1.5 rounded-full bg-green-600"></span>
                                            Delivered
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button class="text-primary font-bold text-sm">Details</button>
                                            <button
                                                class="text-slate-600 dark:text-slate-400 font-bold text-sm">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="px-6 py-5 bg-white dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 flex items-center justify-between">
                        <p class="text-sm text-slate-500 dark:text-slate-400">
                            Showing <span class="font-bold text-slate-900 dark:text-white">1</span> to <span
                                class="font-bold text-slate-900 dark:text-white">10</span> of <span
                                class="font-bold text-slate-900 dark:text-white">152</span> entries
                        </p>
                        <div class="flex gap-2">
                            <button
                                class="h-10 px-4 text-sm font-bold border border-slate-200 dark:border-slate-800 rounded-lg bg-white dark:bg-slate-900 text-slate-400 cursor-not-allowed"
                                disabled="">Previous</button>
                            <div class="flex gap-1">
                                <button
                                    class="h-10 w-10 flex items-center justify-center rounded-lg bg-primary text-white text-sm font-bold">1</button>
                                <button
                                    class="h-10 w-10 flex items-center justify-center rounded-lg border border-transparent hover:border-slate-200 dark:hover:border-slate-800 text-slate-600 dark:text-slate-400 text-sm font-bold transition-all">2</button>
                                <button
                                    class="h-10 w-10 flex items-center justify-center rounded-lg border border-transparent hover:border-slate-200 dark:hover:border-slate-800 text-slate-600 dark:text-slate-400 text-sm font-bold transition-all">3</button>
                            </div>
                            <button
                                class="h-10 px-4 text-sm font-bold border border-slate-200 dark:border-slate-800 rounded-lg bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Next</button>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-slate-500 font-medium pt-4">
                    <div class="flex items-center gap-4">
                        <p>© 2023 Distribusi BBM Enterprise</p>
                        <span class="size-1 bg-slate-300 rounded-full"></span>
                        <p>Last Data Sync: Today at 10:45 AM</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                        <a class="hover:text-primary transition-colors" href="#">System Status</a>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
