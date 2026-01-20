<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Reports Management - Distribusi BBM</title>
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

<body class="antialiased bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
    <div class="flex min-h-screen">
        <aside
            class="fixed z-50 flex flex-col h-full bg-white border-r w-72 dark:bg-background-dark border-slate-200 dark:border-slate-800">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center text-white rounded-lg size-10 bg-primary">
                        <span class="material-symbols-outlined">local_gas_station</span>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold leading-none text-slate-900 dark:text-white">Distribusi BBM</h1>
                        <p class="mt-1 text-xs font-medium tracking-wider uppercase text-slate-500 dark:text-slate-400">
                            Admin Panel</p>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1">
                <a class="flex items-center gap-3 px-4 py-3 transition-all rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800"
                    href="{{ route('admin.dashboard') }}">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm">Dashboard</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 transition-all rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800"
                    href="{{ route('admin.distribution-data') }}">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="text-sm">Distribution Data</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 font-semibold transition-all rounded-xl bg-primary/10 text-primary"
                    href="{{ route('admin.reports') }}">
                    <span class="material-symbols-outlined">description</span>
                    <span class="text-sm">Reports</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 transition-all rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800"
                    href="{{ route('admin.profile') }}">
                    <span class="material-symbols-outlined">person</span>
                    <span class="text-sm">Profile</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <a class="flex items-center gap-3 px-4 py-3 transition-all rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800"
                    href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="text-sm">Settings</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 text-red-500 transition-all rounded-xl hover:bg-red-50 dark:hover:bg-red-950/20"
                    href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm">Logout</span>
                </a>
            </div>
        </aside>
        <main class="flex flex-col flex-1 min-h-screen ml-72">
            <header
                class="sticky top-0 z-40 flex items-center justify-between h-20 px-8 bg-white border-b dark:bg-background-dark border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-6">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Reports Management</h2>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="flex items-center justify-center transition-all rounded-lg size-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div class="w-px h-8 mx-2 bg-slate-200 dark:border-slate-800"></div>
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold leading-none text-slate-900 dark:text-white">Budi Santoso
                            </p>
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Admin Logistik</p>
                        </div>
                        <div class="bg-center bg-cover border rounded-full size-10 border-slate-200"
                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBaxsyFU2s-cKzz4FWJMKlmZTryMxQe8wCPCL7L9fe0eQgsyljihrG2JuY8c5EyHYNYW_wTamxfdToLg0zvby2PsBRDr6QfB5yFg4oVbZohnuc5RRHAGduc6I0fpnfKf9My8o_G5iBSwY5rMDKBPb_ymOd7wr0l0cJlKLlsW-bMdiz5a3x_ku1CdQkbV_7mcPshYV3cFRajyMjc5WCnsvB_oc9nYUMso5dnmWzJZpT-dJbiAcFW8NItBFFid9Ofjf05XPgBhBLI5Q');">
                        </div>
                    </div>
                </div>
            </header>
            <div class="p-8 space-y-8">
                <div>
                    <h3 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">System Reports</h3>
                    <p class="mt-1 text-base text-slate-500 dark:text-slate-400">Generate and export fuel distribution
                        analytics and operational reports.</p>
                </div>
                <div
                    class="p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary">filter_list</span>
                        <h4 class="font-bold text-slate-900 dark:text-white">Global Report Filters</h4>
                    </div>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div>
                            <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">Date
                                Range</label>
                            <div class="flex items-center gap-2">
                                <input
                                    class="w-full text-sm rounded-lg h-11 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-primary focus:border-primary"
                                    type="date" />
                                <span class="text-slate-400">to</span>
                                <input
                                    class="w-full text-sm rounded-lg h-11 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-primary focus:border-primary"
                                    type="date" />
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-bold text-slate-700 dark:text-slate-300">SPBU
                                Location</label>
                            <select
                                class="w-full text-sm rounded-lg h-11 bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-primary focus:border-primary">
                                <option value="">All SPBU Locations</option>
                                <option>SPBU 31.114.03 - Jakarta Barat</option>
                                <option>SPBU 34.125.01 - Jakarta Selatan</option>
                                <option>Terminal Pelabuhan Tanjung Priok</option>
                                <option>Industrial Area Cikupa</option>
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button
                                class="flex items-center justify-center w-full gap-2 px-6 text-sm font-bold text-white transition-all rounded-lg h-11 bg-slate-900 dark:bg-slate-700 hover:bg-slate-800">
                                <span class="text-lg material-symbols-outlined">refresh</span>
                                Apply Filters to All
                            </button>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <div
                        class="overflow-hidden transition-shadow bg-white border dark:bg-background-dark border-slate-200 dark:border-slate-800 rounded-xl hover:shadow-lg group">
                        <div class="p-8">
                            <div
                                class="flex items-center justify-center mb-6 text-blue-600 size-14 bg-blue-50 dark:bg-blue-950/30 rounded-2xl">
                                <span class="text-3xl material-symbols-outlined">summarize</span>
                            </div>
                            <h4 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Daily Distribution Summary
                            </h4>
                            <p class="mb-8 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                                Detailed overview of all fuel distributions completed within the selected period,
                                including truck IDs, volumes, and timestamps.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <button
                                    class="flex items-center justify-center flex-1 gap-2 text-sm font-bold text-white transition-all rounded-lg h-11 bg-primary hover:bg-primary/90">
                                    <span class="text-lg material-symbols-outlined">analytics</span>
                                    Generate
                                </button>
                                <button
                                    class="flex items-center justify-center gap-2 px-5 text-sm font-bold transition-all border rounded-lg h-11 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                                    <span class="text-lg material-symbols-outlined">picture_as_pdf</span>
                                    Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="overflow-hidden transition-shadow bg-white border dark:bg-background-dark border-slate-200 dark:border-slate-800 rounded-xl hover:shadow-lg group">
                        <div class="p-8">
                            <div
                                class="flex items-center justify-center mb-6 size-14 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 rounded-2xl">
                                <span class="text-3xl material-symbols-outlined">oil_barrel</span>
                            </div>
                            <h4 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Fuel Type Volume Report
                            </h4>
                            <p class="mb-8 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                                Categorized analysis of distributed volumes by fuel type (Pertalite, Pertamax, Solar
                                Dex) to monitor inventory consumption.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <button
                                    class="flex items-center justify-center flex-1 gap-2 text-sm font-bold text-white transition-all rounded-lg h-11 bg-primary hover:bg-primary/90">
                                    <span class="text-lg material-symbols-outlined">analytics</span>
                                    Generate
                                </button>
                                <button
                                    class="flex items-center justify-center gap-2 px-5 text-sm font-bold transition-all border rounded-lg h-11 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                                    <span class="text-lg material-symbols-outlined">picture_as_pdf</span>
                                    Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="overflow-hidden transition-shadow bg-white border dark:bg-background-dark border-slate-200 dark:border-slate-800 rounded-xl hover:shadow-lg group">
                        <div class="p-8">
                            <div
                                class="flex items-center justify-center mb-6 size-14 bg-amber-50 dark:bg-amber-950/30 text-amber-600 rounded-2xl">
                                <span class="text-3xl material-symbols-outlined">badge</span>
                            </div>
                            <h4 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Operator Performance</h4>
                            <p class="mb-8 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                                Efficiency metrics for logistics operators and drivers, tracking delivery times,
                                incident records, and task completion rates.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <button
                                    class="flex items-center justify-center flex-1 gap-2 text-sm font-bold text-white transition-all rounded-lg h-11 bg-primary hover:bg-primary/90">
                                    <span class="text-lg material-symbols-outlined">analytics</span>
                                    Generate
                                </button>
                                <button
                                    class="flex items-center justify-center gap-2 px-5 text-sm font-bold transition-all border rounded-lg h-11 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                                    <span class="text-lg material-symbols-outlined">picture_as_pdf</span>
                                    Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        class="overflow-hidden transition-shadow bg-white border dark:bg-background-dark border-slate-200 dark:border-slate-800 rounded-xl hover:shadow-lg group">
                        <div class="p-8">
                            <div
                                class="flex items-center justify-center mb-6 text-indigo-600 size-14 bg-indigo-50 dark:bg-indigo-950/30 rounded-2xl">
                                <span class="text-3xl material-symbols-outlined">map</span>
                            </div>
                            <h4 class="mb-2 text-xl font-bold text-slate-900 dark:text-white">Destination-wise Analysis
                            </h4>
                            <p class="mb-8 text-sm leading-relaxed text-slate-500 dark:text-slate-400">
                                Geographical breakdown of distribution volume across different SPBU locations and
                                industrial hubs for demand forecasting.
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <button
                                    class="flex items-center justify-center flex-1 gap-2 text-sm font-bold text-white transition-all rounded-lg h-11 bg-primary hover:bg-primary/90">
                                    <span class="text-lg material-symbols-outlined">analytics</span>
                                    Generate
                                </button>
                                <button
                                    class="flex items-center justify-center gap-2 px-5 text-sm font-bold transition-all border rounded-lg h-11 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800">
                                    <span class="text-lg material-symbols-outlined">picture_as_pdf</span>
                                    Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between py-6 border-t border-slate-200 dark:border-slate-800">
                    <div class="flex items-center gap-4 text-slate-500 dark:text-slate-400">
                        <span class="material-symbols-outlined">history</span>
                        <span class="text-sm">Last report generated: <strong>Today, 09:42 AM</strong> (Daily
                            Summary)</span>
                    </div>
                    <button class="text-sm font-bold text-primary hover:underline">View All Export History</button>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
