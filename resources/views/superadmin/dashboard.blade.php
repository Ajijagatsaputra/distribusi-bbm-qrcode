<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Super Admin Monitoring Dashboard - BBM System</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
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
                        "sidebar-dark": "#1f2937",
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

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
    <div class="flex min-h-screen">
        <aside class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 text-white bg-sidebar-dark">
            <div class="flex items-center gap-3 p-6 border-b border-slate-700/50">
                <div class="bg-primary p-1.5 rounded-lg">
                    <span class="text-white material-symbols-outlined">local_gas_station</span>
                </div>
                <div>
                    <h1 class="text-sm font-bold tracking-tight uppercase">BBM QR-Track</h1>
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest">Super Admin Panel</p>
                </div>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white" href="#">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    <span class="text-sm font-medium">Dashboard Overview</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
                    href="#">
                    <span class="material-symbols-outlined text-[20px]">qr_code_2</span>
                    <span class="text-sm font-medium">QR Code Management</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
                    href="{{ route('superadmin.users-management') }}">
                    <span class="material-symbols-outlined text-[20px]">group</span>
                    <span class="text-sm font-medium">User Management</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
                    href="{{ route('superadmin.master-data') }}">
                    <span class="material-symbols-outlined text-[20px]">database</span>
                    <span class="text-sm font-medium">Master Data</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
                    href="#">
                    <span class="material-symbols-outlined text-[20px]">monitoring</span>
                    <span class="text-sm font-medium">Live Monitoring</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
                    href="{{ route('superadmin.audit-reports') }}">
                    <span class="material-symbols-outlined text-[20px]">description</span>
                    <span class="text-sm font-medium">Audit Reports</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
                    href="#">
                    <span class="material-symbols-outlined text-[20px]">settings</span>
                    <span class="text-sm font-medium">System Settings</span>
                </a>
            </nav>
            <div class="p-4 border-t border-slate-700/50">
                <button
                    class="flex items-center w-full gap-3 px-4 py-3 text-red-500 transition-colors rounded-lg hover:bg-red-50 dark:hover:bg-red-900/10"
                    onclick="event.preventDefault(); document.location.href = '{{ url('/') }}'" type="button">
                    <a href="{{ url('/') }}"></a>
                    <span class="material-symbols-outlined">logout</span>
                    <span class="text-sm font-semibold">Logout</span>
                </button>
            </div>
        </aside>
        <main class="flex flex-col flex-1 min-h-screen ml-64">
            <header
                class="sticky top-0 z-40 flex items-center justify-between h-16 px-8 bg-white border-b dark:bg-background-dark border-slate-200 dark:border-slate-800">
                <div class="flex items-center gap-4">
                    <nav class="flex items-center gap-2 text-sm">
                        <a class="transition-colors text-slate-500 hover:text-primary" href="#">Main</a>
                        <span class="text-slate-300">/</span>
                        <span class="font-semibold text-slate-900 dark:text-white">QR Monitoring Dashboard</span>
                    </nav>
                </div>
                <div class="flex items-center gap-6">
                    <div class="relative hidden max-w-md md:block">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                        <input
                            class="w-64 pl-10 pr-4 py-1.5 bg-slate-100 dark:bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary/50"
                            placeholder="Search QR or Logs..." type="text" />
                    </div>
                    <div class="flex items-center gap-3 pl-6 border-l border-slate-200 dark:border-slate-800">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Alex Johnson</p>
                            <p class="text-[11px] text-slate-500 uppercase font-medium tracking-wider">Super Admin</p>
                        </div>
                        <div class="w-10 h-10 bg-cover border-2 rounded-full bg-slate-200 dark:bg-slate-700 border-primary/20"
                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDVsMmElA30a4SFaX8HIJjnqNnM6e3mraHTnJ4lsWfEQYgfdLUcPFOpOU_AgG7OE4KMJ4A8ssHEq-sc2Qb3eGYSDOlFJTQnaRRAHKcae2Jz3bRcDC-TPCXjv_lGpmVq84gxnv-p07GpgU78VxEIqVBIMhNvr2hxNLvPQiLFzDYqfNmD6gWUuEmLTq0RDg6BZeEvhRq-8FELtJ-soXhrpKARbzV5jKwLdjGGGVDQWRSSeBt_M7YqvhyZ5rXGJ2yvFv_gEuzor-S9xg')">
                        </div>
                    </div>
                </div>
            </header>
            <div class="p-8 space-y-8">
                <div class="flex items-end justify-between">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">QR Monitoring
                            Overview</h2>
                        <p class="mt-1 text-sm text-slate-500">Real-time status of QR-based fuel distribution
                            validation.</p>
                    </div>
                    <div
                        class="flex items-center gap-2 bg-emerald-50 dark:bg-emerald-900/20 px-3 py-1.5 rounded-lg border border-emerald-100 dark:border-emerald-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span
                            class="text-xs font-semibold tracking-wider uppercase text-emerald-700 dark:text-emerald-400">Live
                            System Active</span>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div
                        class="flex flex-col gap-2 p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="flex items-start justify-between">
                            <p class="text-sm font-medium text-slate-500">Total QR Generated</p>
                            <div class="p-2 bg-blue-100 rounded-lg dark:bg-blue-900/30">
                                <span class="material-symbols-outlined text-primary text-[20px]">qr_code</span>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white">12,842</p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <span
                                class="flex items-center text-xs font-bold text-green-600 bg-green-100 px-1.5 py-0.5 rounded">
                                <span class="material-symbols-outlined text-[14px]">trending_up</span> 8.4%
                            </span>
                            <span class="text-xs text-slate-400">newly issued today</span>
                        </div>
                    </div>
                    <div
                        class="flex flex-col gap-2 p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="flex items-start justify-between">
                            <p class="text-sm font-medium text-slate-500">Successful Scans</p>
                            <div class="p-2 rounded-lg bg-emerald-100 dark:bg-emerald-900/30">
                                <span class="material-symbols-outlined text-emerald-600 text-[20px]">check_circle</span>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white">11,205</p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <span
                                class="flex items-center text-xs font-bold text-emerald-600 bg-emerald-100 px-1.5 py-0.5 rounded">
                                <span class="material-symbols-outlined text-[14px]">task_alt</span> 98.2%
                            </span>
                            <span class="text-xs text-slate-400">validation success rate</span>
                        </div>
                    </div>
                    <div
                        class="flex flex-col gap-2 p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="flex items-start justify-between">
                            <p class="text-sm font-medium text-slate-500">Validation Failures</p>
                            <div class="p-2 bg-red-100 rounded-lg dark:bg-red-900/30">
                                <span class="material-symbols-outlined text-red-600 text-[20px]">error</span>
                            </div>
                        </div>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white">142</p>
                        <div class="flex items-center gap-1.5 mt-2">
                            <span
                                class="flex items-center text-xs font-bold text-red-600 bg-red-100 px-1.5 py-0.5 rounded">
                                <span class="material-symbols-outlined text-[14px]">warning</span> 1.8%
                            </span>
                            <span class="text-xs text-slate-400">flagged for review</span>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <div
                        class="overflow-hidden bg-white border shadow-sm lg:col-span-2 dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div
                            class="flex items-center justify-between p-6 border-b border-slate-100 dark:border-slate-800">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Scan Activity (Last 7
                                    Days)</h3>
                                <p class="text-sm text-slate-500">Total QR validations processed daily</p>
                            </div>
                            <div class="flex gap-2">
                                <button class="px-3 py-1.5 text-xs font-bold bg-primary text-white rounded-lg">Activity
                                    Log</button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="relative h-[280px] w-full">
                                <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 800 280">
                                    <defs>
                                        <linearGradient id="scanGradient" x1="0" x2="0"
                                            y1="0" y2="1">
                                            <stop offset="0%" stop-color="#195de6" stop-opacity="0.2"></stop>
                                            <stop offset="100%" stop-color="#195de6" stop-opacity="0"></stop>
                                        </linearGradient>
                                    </defs>
                                    <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0"
                                        x2="800" y1="0" y2="0"></line>
                                    <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0"
                                        x2="800" y1="70" y2="70"></line>
                                    <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0"
                                        x2="800" y1="140" y2="140"></line>
                                    <line stroke="#e2e8f0" stroke-dasharray="4" stroke-width="1" x1="0"
                                        x2="800" y1="210" y2="210"></line>
                                    <line stroke="#e2e8f0" stroke-width="1" x1="0" x2="800"
                                        y1="280" y2="280"></line>
                                    <path d="M0,220 L133,180 L266,210 L399,140 L532,160 L665,80 L800,50 V280 H0 Z"
                                        fill="url(#scanGradient)"></path>
                                    <path d="M0,220 L133,180 L266,210 L399,140 L532,160 L665,80 L800,50" fill="none"
                                        stroke="#195de6" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="3"></path>
                                    <circle cx="0" cy="220" fill="#fff" r="4" stroke="#195de6"
                                        stroke-width="2"></circle>
                                    <circle cx="133" cy="180" fill="#fff" r="4" stroke="#195de6"
                                        stroke-width="2"></circle>
                                    <circle cx="266" cy="210" fill="#fff" r="4" stroke="#195de6"
                                        stroke-width="2"></circle>
                                    <circle cx="399" cy="140" fill="#fff" r="4" stroke="#195de6"
                                        stroke-width="2"></circle>
                                    <circle cx="532" cy="160" fill="#fff" r="4" stroke="#195de6"
                                        stroke-width="2"></circle>
                                    <circle cx="665" cy="80" fill="#fff" r="4" stroke="#195de6"
                                        stroke-width="2"></circle>
                                    <circle cx="800" cy="50" fill="#fff" r="4" stroke="#195de6"
                                        stroke-width="2"></circle>
                                </svg>
                                <div
                                    class="flex justify-between mt-4 px-2 text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                                    <span>06 Jun</span>
                                    <span>07 Jun</span>
                                    <span>08 Jun</span>
                                    <span>09 Jun</span>
                                    <span>10 Jun</span>
                                    <span>11 Jun</span>
                                    <span>Today</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col overflow-hidden bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">QR Validation Feed</h3>
                            <p class="text-sm text-slate-500">Live scan events</p>
                        </div>
                        <div class="flex-1 p-6 space-y-6 overflow-y-auto">
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5"></div>
                                    <div class="absolute top-4 left-1 w-[1px] h-full bg-slate-200 dark:bg-slate-800">
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Successful
                                        Validation</p>
                                    <p class="text-xs text-slate-500 mt-0.5">QR #QR-8892 • Station Jakarta South</p>
                                    <p class="text-[10px] font-medium text-slate-400 mt-1 uppercase tracking-tighter">
                                        Just Now</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="w-2 h-2 rounded-full bg-red-500 mt-1.5"></div>
                                    <div class="absolute top-4 left-1 w-[1px] h-full bg-slate-200 dark:bg-slate-800">
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Validation Failure
                                    </p>
                                    <p class="text-xs text-slate-500 mt-0.5">Expired QR #QR-7721 • Depot Bekasi</p>
                                    <p class="text-[10px] font-medium text-slate-400 mt-1 uppercase tracking-tighter">
                                        12 mins ago</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="w-2 h-2 rounded-full bg-primary mt-1.5"></div>
                                    <div class="absolute top-4 left-1 w-[1px] h-full bg-slate-200 dark:bg-slate-800">
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Batch QR Generated
                                    </p>
                                    <p class="text-xs text-slate-500 mt-0.5">500 New Codes for Fleet B</p>
                                    <p class="text-[10px] font-medium text-slate-400 mt-1 uppercase tracking-tighter">1
                                        hour ago</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5"></div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">System Check
                                        Completed</p>
                                    <p class="text-xs text-slate-500 mt-0.5">QR Scanning Engine Status: 100%</p>
                                    <p class="text-[10px] font-medium text-slate-400 mt-1 uppercase tracking-tighter">3
                                        hours ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 text-center bg-slate-50 dark:bg-slate-800/50">
                            <a class="text-xs font-bold tracking-widest uppercase text-primary hover:underline"
                                href="#">Access Full Log</a>
                        </div>
                    </div>
                </div>
                <div
                    class="overflow-hidden bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                    <div class="flex flex-col justify-between gap-4 p-6 md:flex-row md:items-center">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Recent QR-Based Distributions</h3>
                        <div class="flex gap-2">
                            <button
                                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition-colors bg-white border rounded-lg border-slate-200 dark:border-slate-700 hover:bg-slate-50 text-slate-700 dark:text-white">
                                <span class="material-symbols-outlined text-[18px]">download</span> Export CSV
                            </button>
                            <button
                                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-primary/90">
                                <span class="material-symbols-outlined text-[18px]">add_a_photo</span> Generate New QR
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr
                                    class="bg-slate-50 dark:bg-slate-800/50 border-y border-slate-100 dark:border-slate-800">
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">QR Code ID</th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Scan Timestamp
                                    </th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Vehicle/User
                                    </th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Location</th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Fuel Type</th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Status</th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr>
                                    <td class="px-6 py-4 font-mono text-xs font-bold text-primary">#QR-TX-98012</td>
                                    <td class="px-6 py-4 text-slate-500">Jun 12, 14:22:10</td>
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">B 1234 ABC (Truck)
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">SPBU 31.12101</td>
                                    <td class="px-6 py-4 font-medium text-slate-500">Bio Solar</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase rounded">Valid</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button
                                            class="text-xs font-bold text-primary hover:text-blue-700">Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-mono text-xs font-bold text-primary">#QR-TX-98011</td>
                                    <td class="px-6 py-4 text-slate-500">Jun 12, 13:55:04</td>
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">D 8892 XYZ (Van)
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">SPBU 31.12105</td>
                                    <td class="px-6 py-4 font-medium text-slate-500">Pertalite</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 bg-red-100 text-red-700 text-[10px] font-bold uppercase rounded">Invalid</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button
                                            class="text-xs font-bold text-primary hover:text-blue-700">Details</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-mono text-xs font-bold text-primary">#QR-TX-98010</td>
                                    <td class="px-6 py-4 text-slate-500">Jun 12, 13:40:22</td>
                                    <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">L 4421 OP (Truck)
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">SPBU 31.12101</td>
                                    <td class="px-6 py-4 font-medium text-slate-500">Dexlite</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase rounded">Valid</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button
                                            class="text-xs font-bold text-primary hover:text-blue-700">Details</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="flex items-center justify-between px-6 py-4 border-t border-slate-100 dark:border-slate-800">
                        <p class="text-xs font-medium tracking-tight text-slate-500">Viewing live feed of QR
                            transactions</p>
                        <div class="flex gap-1">
                            <button
                                class="p-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50">
                                <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                            </button>
                            <button
                                class="p-1.5 rounded-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50">
                                <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
