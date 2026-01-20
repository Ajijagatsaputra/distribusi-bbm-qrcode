<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin Dashboard Overview - Distribusi BBM</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap"
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
        <!-- Sidebar Navigation -->
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
                <a class="flex items-center gap-3 px-4 py-3 font-semibold transition-all rounded-xl bg-primary/10 text-primary"
                    href="#">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm">Dashboard</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 transition-all rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800"
                    href="{{ route('admin.distribution-data') }}">
                    <span class="material-symbols-outlined">local_shipping</span>
                    <span class="text-sm">Distribution Data</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 transition-all rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800"
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
                    onclick="event.preventDefault(); document.location.href = '{{ url('/') }}'"
                    href="{{ url('/') }}">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm">Logout</span>
                </a>
            </div>
        </aside>
        <!-- Main Content Area -->
        <main class="flex flex-col flex-1 min-h-screen ml-72">
            <!-- Top Navigation -->
            <header
                class="sticky top-0 z-40 flex items-center justify-between h-20 px-8 bg-white border-b dark:bg-background-dark border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-6">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Dashboard Overview</h2>
                    <div class="relative group">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                            <span class="text-xl material-symbols-outlined">search</span>
                        </span>
                        <input
                            class="h-10 pl-10 pr-4 text-sm transition-all border-none rounded-lg w-80 bg-slate-100 dark:bg-slate-800 focus:ring-2 focus:ring-primary/20"
                            placeholder="Search distribution data..." type="text" />
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="flex items-center justify-center transition-all rounded-lg size-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <button
                        class="flex items-center justify-center transition-all rounded-lg size-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-700">
                        <span class="material-symbols-outlined">help</span>
                    </button>
                    <div class="w-px h-8 mx-2 bg-slate-200 dark:border-slate-800"></div>
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold leading-none text-slate-900 dark:text-white">Budi Santoso
                            </p>
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Admin Logistik</p>
                        </div>
                        <div class="bg-center bg-cover border rounded-full size-10 border-slate-200"
                            data-alt="User avatar profile picture"
                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBaxsyFU2s-cKzz4FWJMKlmZTryMxQe8wCPCL7L9fe0eQgsyljihrG2JuY8c5EyHYNYW_wTamxfdToLg0zvby2PsBRDr6QfB5yFg4oVbZohnuc5RRHAGduc6I0fpnfKf9My8o_G5iBSwY5rMDKBPb_ymOd7wr0l0cJlKLlsW-bMdiz5a3x_ku1CdQkbV_7mcPshYV3cFRajyMjc5WCnsvB_oc9nYUMso5dnmWzJZpT-dJbiAcFW8NItBFFid9Ofjf05XPgBhBLI5Q');">
                        </div>
                    </div>
                </div>
            </header>
            <!-- Content Page Wrapper -->
            <div class="p-8 space-y-8">
                <!-- Page Heading -->
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h3 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white">Welcome back, Budi
                        </h3>
                        <p class="mt-1 text-base text-slate-500 dark:text-slate-400">Monitoring fuel distribution
                            logistics and reporting for today.</p>
                    </div>
                    <div class="flex gap-3">
                        <button
                            class="flex items-center gap-2 px-5 text-sm font-bold transition-all bg-white border rounded-lg h-11 border-slate-200 dark:border-slate-800 dark:bg-background-dark text-slate-900 dark:text-white hover:bg-slate-50">
                            <span class="text-xl material-symbols-outlined">download</span>
                            Export Reports
                        </button>
                        <button
                            class="flex items-center gap-2 px-5 text-sm font-bold text-white transition-all rounded-lg shadow-lg h-11 bg-primary hover:bg-primary/90 shadow-primary/20">
                            <span class="text-xl material-symbols-outlined">add</span>
                            Add New Distribution
                        </button>
                    </div>
                </div>
                <!-- Stats Widgets -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <div
                        class="p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex items-center justify-center text-blue-600 rounded-lg size-10 bg-blue-50 dark:bg-blue-900/20">
                                <span class="material-symbols-outlined">oil_barrel</span>
                            </div>
                            <span
                                class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-950/20 px-2.5 py-1 rounded-full">+12.5%</span>
                        </div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Total Fuel Distributed (L)</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">1,240,500</p>
                    </div>
                    <div
                        class="p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex items-center justify-center rounded-lg size-10 bg-amber-50 dark:bg-amber-900/20 text-amber-600">
                                <span class="material-symbols-outlined">route</span>
                            </div>
                            <span
                                class="text-xs font-bold text-slate-500 bg-slate-100 dark:bg-slate-800 px-2.5 py-1 rounded-full">Static</span>
                        </div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Active Routes</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">18</p>
                    </div>
                    <div
                        class="p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex items-center justify-center rounded-lg size-10 bg-rose-50 dark:bg-rose-900/20 text-rose-600">
                                <span class="material-symbols-outlined">pending_actions</span>
                            </div>
                            <span
                                class="text-xs font-bold text-rose-600 bg-rose-50 dark:bg-rose-950/20 px-2.5 py-1 rounded-full">-2%</span>
                        </div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Pending Reports</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">5</p>
                    </div>
                    <div
                        class="p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-4">
                            <div
                                class="flex items-center justify-center rounded-lg size-10 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600">
                                <span class="material-symbols-outlined">task_alt</span>
                            </div>
                            <span
                                class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-950/20 px-2.5 py-1 rounded-full">+5.4%</span>
                        </div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Completed Deliveries</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white">42</p>
                    </div>
                </div>
                <!-- Chart and Activity Section -->
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <!-- Main Chart -->
                    <div
                        class="p-6 bg-white border shadow-sm lg:col-span-2 dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white">Fuel Volume Trends</h4>
                                <p class="text-sm text-slate-500">Distribution volume for the last 7 days</p>
                            </div>
                            <select
                                class="text-sm rounded-lg border-slate-200 dark:border-slate-800 dark:bg-slate-900 focus:ring-primary/20">
                                <option>Last 7 Days</option>
                                <option>Last 30 Days</option>
                            </select>
                        </div>
                        <div class="relative w-full h-64">
                            <svg class="w-full h-full" preserveaspectratio="none" viewbox="0 0 400 150">
                                <defs>
                                    <lineargradient id="chartGradient" x1="0" x2="0" y1="0"
                                        y2="1">
                                        <stop offset="0%" stop-color="#195de6" stop-opacity="0.2"></stop>
                                        <stop offset="100%" stop-color="#195de6" stop-opacity="0"></stop>
                                    </lineargradient>
                                </defs>
                                <!-- Line -->
                                <path
                                    d="M0,100 C40,80 80,120 120,70 C160,20 200,50 240,40 C280,30 320,80 360,60 L400,20"
                                    fill="none" stroke="#195de6" stroke-linecap="round" stroke-width="3"></path>
                                <!-- Gradient Area -->
                                <path
                                    d="M0,100 C40,80 80,120 120,70 C160,20 200,50 240,40 C280,30 320,80 360,60 L400,20 V150 H0 Z"
                                    fill="url(#chartGradient)"></path>
                            </svg>
                        </div>
                        <div class="flex justify-between px-2 mt-4">
                            <p class="text-xs font-bold text-slate-400">Mon</p>
                            <p class="text-xs font-bold text-slate-400">Tue</p>
                            <p class="text-xs font-bold text-slate-400">Wed</p>
                            <p class="text-xs font-bold text-slate-400">Thu</p>
                            <p class="text-xs font-bold text-slate-400">Fri</p>
                            <p class="text-xs font-bold text-slate-400">Sat</p>
                            <p class="text-xs font-bold text-slate-400">Sun</p>
                        </div>
                    </div>
                    <!-- Recent Activity Feed -->
                    <div
                        class="flex flex-col p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <h4 class="mb-6 text-lg font-bold text-slate-900 dark:text-white">Recent Reports</h4>
                        <div class="flex-1 space-y-6">
                            <div class="flex gap-4">
                                <div
                                    class="flex items-center justify-center rounded-full size-10 shrink-0 bg-slate-100 dark:bg-slate-800">
                                    <span class="text-xl material-symbols-outlined text-primary">file_present</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Daily Report -
                                        Terminal Jakarta</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Submitted by John Doe • 2h ago</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="flex items-center justify-center rounded-full size-10 shrink-0 bg-slate-100 dark:bg-slate-800">
                                    <span class="text-xl material-symbols-outlined text-primary">upload_file</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Manifest #882193
                                        Updated</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Route: Jakarta -&gt; Bandung • 4h ago</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="flex items-center justify-center rounded-full size-10 shrink-0 bg-slate-100 dark:bg-slate-800">
                                    <span class="text-xl material-symbols-outlined text-primary">assignment_late</span>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Incident Report
                                        Pending</p>
                                    <p class="text-xs text-slate-500 mt-0.5">Vehicle: B-9122-TX • 1d ago</p>
                                </div>
                            </div>
                        </div>
                        <button
                            class="w-full mt-6 py-2.5 text-sm font-bold text-primary bg-primary/5 hover:bg-primary/10 rounded-lg transition-all">
                            View All Reports
                        </button>
                    </div>
                </div>
                <!-- Data Table Section -->
                <div
                    class="overflow-hidden bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                    <div class="flex items-center justify-between p-6 border-b border-slate-200 dark:border-slate-800">
                        <h4 class="text-lg font-bold text-slate-900 dark:text-white">Recent Distributions</h4>
                        <div class="flex gap-2">
                            <button class="p-2 transition-all rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800">
                                <span class="material-symbols-outlined text-slate-500">filter_list</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-800/50">
                                    <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500">
                                        Date</th>
                                    <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500">
                                        Truck ID</th>
                                    <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500">
                                        Fuel Type</th>
                                    <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500">
                                        Destination</th>
                                    <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500">
                                        Status</th>
                                    <th class="px-6 py-4 text-xs font-bold tracking-wider uppercase text-slate-500">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-white">Oct 24,
                                        2023</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">B-9912-FGH</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">Pertalite</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">SPBU 31.114.03
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 text-xs font-bold bg-blue-50 text-blue-600 dark:bg-blue-900/20 rounded-full">In
                                            Transit</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="text-sm font-bold text-primary hover:underline">Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-white">Oct 24,
                                        2023</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">B-8221-VBN</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">Pertamax</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">Terminal Pelabuhan
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 text-xs font-bold bg-green-50 text-green-600 dark:bg-green-900/20 rounded-full">Delivered</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="text-sm font-bold text-primary hover:underline">Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-white">Oct 23,
                                        2023</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">B-1123-JKO</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">Solar Dex</td>
                                    <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">Industrial Area
                                        Cikupa</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 text-xs font-bold bg-amber-50 text-amber-600 dark:bg-amber-900/20 rounded-full">Loading</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="text-sm font-bold text-primary hover:underline">Details</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between px-6 py-4 bg-slate-50 dark:bg-slate-800/50">
                        <p class="text-sm text-slate-500">Showing 3 of 152 distributions</p>
                        <div class="flex gap-2">
                            <button
                                class="px-3 py-1 text-sm font-bold bg-white border rounded border-slate-200 dark:border-slate-800 dark:bg-background-dark disabled:opacity-50"
                                disabled="">Prev</button>
                            <button
                                class="px-3 py-1 text-sm font-bold bg-white border rounded border-slate-200 dark:border-slate-800 dark:bg-background-dark">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
