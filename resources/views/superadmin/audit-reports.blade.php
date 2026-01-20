<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Audit Reports and Data Export - BBM System</title>
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

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #334155;
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
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-colors"
                    href="{{ route('superadmin.dashboard') }}">
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
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white" href="#">
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
                    class="flex items-center gap-3 px-3 py-2.5 w-full rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-400/10 transition-colors">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                    <span class="text-sm font-medium">Logout</span>
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
                        <span class="font-semibold text-slate-900 dark:text-white">Audit Reports &amp; Data
                            Export</span>
                    </nav>
                </div>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3 pl-6">
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
            <div class="p-8 space-y-6">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Audit Reports</h2>
                        <p class="mt-1 text-sm text-slate-500">Generate and export fuel distribution audit logs.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button
                            class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600 transition-colors bg-white border rounded-lg shadow-sm dark:bg-slate-800 border-slate-200 dark:border-slate-700 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10">
                            <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
                            Export to PDF
                        </button>
                        <button
                            class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg shadow-sm bg-primary hover:bg-primary/90">
                            <span class="material-symbols-outlined text-[20px]">table_view</span>
                            Export to Excel
                        </button>
                    </div>
                </div>
                <div
                    class="p-6 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                    <div class="flex items-center gap-2 mb-4 font-semibold text-slate-700 dark:text-slate-200">
                        <span class="material-symbols-outlined text-primary">filter_alt</span>
                        <h3>Report Parameters</h3>
                    </div>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold tracking-wider uppercase text-slate-500">Date Range</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">calendar_today</span>
                                <input
                                    class="w-full py-2 pl-10 pr-4 text-sm rounded-lg bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-primary/50"
                                    readonly="" type="text" value="Jun 01, 2024 - Jun 12, 2024" />
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold tracking-wider uppercase text-slate-500">SPBU /
                                Location</label>
                            <select
                                class="w-full px-4 py-2 text-sm rounded-lg bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-primary/50">
                                <option>All Stations</option>
                                <option>SPBU 31.12101 - Jakarta South</option>
                                <option>SPBU 31.12105 - Jakarta West</option>
                                <option>Depot Bekasi Main</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold tracking-wider uppercase text-slate-500">Fuel Type</label>
                            <select
                                class="w-full px-4 py-2 text-sm rounded-lg bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-primary/50">
                                <option>All Fuel Types</option>
                                <option>Bio Solar</option>
                                <option>Pertalite</option>
                                <option>Dexlite</option>
                                <option>Pertamax Turbo</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold tracking-wider uppercase text-slate-500">Operator</label>
                            <select
                                class="w-full px-4 py-2 text-sm rounded-lg bg-slate-50 dark:bg-slate-800 border-slate-200 dark:border-slate-700 focus:ring-2 focus:ring-primary/50">
                                <option>All Operators</option>
                                <option>Budi Santoso</option>
                                <option>Siti Aminah</option>
                                <option>Rudi Hermawan</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end pt-6 mt-6 border-t border-slate-100 dark:border-slate-800">
                        <button
                            class="px-6 py-2 mr-3 text-sm font-semibold transition-colors rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200">Reset
                            Filters</button>
                        <button
                            class="px-8 py-2 text-sm font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-primary/90">Apply
                            Filters</button>
                    </div>
                </div>
                <div
                    class="overflow-hidden bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                    <div
                        class="flex items-center justify-between p-6 border-b border-slate-100 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                        <h3 class="font-bold text-slate-900 dark:text-white">Report Preview (Showing 250 records)</h3>
                        <div class="flex items-center gap-4 text-xs font-medium text-slate-500">
                            <span class="flex items-center gap-1"><span
                                    class="w-2 h-2 bg-blue-500 rounded-full"></span> Bio Solar</span>
                            <span class="flex items-center gap-1"><span
                                    class="w-2 h-2 rounded-full bg-emerald-500"></span> Pertalite</span>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-[13px]">
                            <thead>
                                <tr
                                    class="bg-slate-50 dark:bg-slate-800/50 border-y border-slate-100 dark:border-slate-800">
                                    <th
                                        class="px-6 py-3 font-semibold tracking-tighter uppercase text-slate-900 dark:text-white">
                                        Transaction ID</th>
                                    <th
                                        class="px-6 py-3 font-semibold tracking-tighter uppercase text-slate-900 dark:text-white">
                                        Timestamp</th>
                                    <th
                                        class="px-6 py-3 font-semibold tracking-tighter uppercase text-slate-900 dark:text-white">
                                        QR Code</th>
                                    <th
                                        class="px-6 py-3 font-semibold tracking-tighter uppercase text-slate-900 dark:text-white">
                                        Location</th>
                                    <th
                                        class="px-6 py-3 font-semibold tracking-tighter uppercase text-slate-900 dark:text-white">
                                        Fuel Type</th>
                                    <th
                                        class="px-6 py-3 font-semibold tracking-tighter text-right uppercase text-slate-900 dark:text-white">
                                        Volume (L)</th>
                                    <th
                                        class="px-6 py-3 font-semibold tracking-tighter uppercase text-slate-900 dark:text-white">
                                        Operator</th>
                                    <th
                                        class="px-6 py-3 font-semibold tracking-tighter uppercase text-slate-900 dark:text-white">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr>
                                    <td class="px-6 py-3 font-mono text-xs font-bold text-slate-900 dark:text-white">
                                        TRX-20240612-001</td>
                                    <td class="px-6 py-3 text-slate-500">12/06/2024 14:22:10</td>
                                    <td class="px-6 py-3 font-medium text-primary">QR-TX-98012</td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">SPBU 31.12101</td>
                                    <td class="px-6 py-3"><span
                                            class="px-2 py-0.5 bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400 rounded-full text-[11px] font-bold">Bio
                                            Solar</span></td>
                                    <td class="px-6 py-3 font-bold text-right text-slate-900 dark:text-white">125.00
                                    </td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">Budi Santoso</td>
                                    <td class="px-6 py-3"><span class="font-bold text-green-600">SUCCESS</span></td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-3 font-mono text-xs font-bold text-slate-900 dark:text-white">
                                        TRX-20240612-002</td>
                                    <td class="px-6 py-3 text-slate-500">12/06/2024 14:15:45</td>
                                    <td class="px-6 py-3 font-medium text-primary">QR-TX-98015</td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">SPBU 31.12105</td>
                                    <td class="px-6 py-3"><span
                                            class="px-2 py-0.5 bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400 rounded-full text-[11px] font-bold">Pertalite</span>
                                    </td>
                                    <td class="px-6 py-3 font-bold text-right text-slate-900 dark:text-white">24.50
                                    </td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">Siti Aminah</td>
                                    <td class="px-6 py-3"><span class="font-bold text-green-600">SUCCESS</span></td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-3 font-mono text-xs font-bold text-slate-900 dark:text-white">
                                        TRX-20240612-003</td>
                                    <td class="px-6 py-3 text-slate-500">12/06/2024 14:10:02</td>
                                    <td class="px-6 py-3 font-medium text-primary">QR-TX-98018</td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">SPBU 31.12101</td>
                                    <td class="px-6 py-3"><span
                                            class="px-2 py-0.5 bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300 rounded-full text-[11px] font-bold">Dexlite</span>
                                    </td>
                                    <td class="px-6 py-3 font-bold text-right text-slate-900 dark:text-white">88.25
                                    </td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">Budi Santoso</td>
                                    <td class="px-6 py-3"><span class="font-bold text-red-600">FAILED</span></td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-3 font-mono text-xs font-bold text-slate-900 dark:text-white">
                                        TRX-20240612-004</td>
                                    <td class="px-6 py-3 text-slate-500">12/06/2024 13:58:33</td>
                                    <td class="px-6 py-3 font-medium text-primary">QR-TX-98020</td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">Depot Bekasi Main</td>
                                    <td class="px-6 py-3"><span
                                            class="px-2 py-0.5 bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400 rounded-full text-[11px] font-bold">Bio
                                            Solar</span></td>
                                    <td class="px-6 py-3 font-bold text-right text-slate-900 dark:text-white">500.00
                                    </td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">Rudi Hermawan</td>
                                    <td class="px-6 py-3"><span class="font-bold text-green-600">SUCCESS</span></td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-3 font-mono text-xs font-bold text-slate-900 dark:text-white">
                                        TRX-20240612-005</td>
                                    <td class="px-6 py-3 text-slate-500">12/06/2024 13:45:12</td>
                                    <td class="px-6 py-3 font-medium text-primary">QR-TX-98022</td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">SPBU 31.12101</td>
                                    <td class="px-6 py-3"><span
                                            class="px-2 py-0.5 bg-emerald-50 text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-400 rounded-full text-[11px] font-bold">Pertalite</span>
                                    </td>
                                    <td class="px-6 py-3 font-bold text-right text-slate-900 dark:text-white">15.00
                                    </td>
                                    <td class="px-6 py-3 text-slate-600 dark:text-slate-400">Budi Santoso</td>
                                    <td class="px-6 py-3"><span class="font-bold text-green-600">SUCCESS</span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="font-bold bg-slate-50 dark:bg-slate-800/50">
                                    <td class="px-6 py-3 text-xs tracking-wider text-right uppercase text-slate-900 dark:text-white"
                                        colspan="5">Total Distribution (Preview)</td>
                                    <td class="px-6 py-3 text-right text-primary">752.75 L</td>
                                    <td class="px-6 py-3" colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div
                        class="flex items-center justify-between px-6 py-4 bg-white border-t border-slate-100 dark:border-slate-800 dark:bg-background-dark">
                        <p class="text-xs font-medium text-slate-500">Showing records 1 to 5 of 250 found</p>
                        <div class="flex gap-2">
                            <button
                                class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors disabled:opacity-50"
                                disabled="">Previous</button>
                            <button
                                class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">Next</button>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div
                        class="flex items-center gap-4 p-5 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div
                            class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full dark:bg-blue-900/30 text-primary">
                            <span class="material-symbols-outlined">local_shipping</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold tracking-widest uppercase text-slate-500">Total Fleet Scans</p>
                            <p class="text-xl font-bold text-slate-900 dark:text-white">1,248 Scans</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-4 p-5 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600">
                            <span class="material-symbols-outlined">oil_barrel</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold tracking-widest uppercase text-slate-500">Total Volume
                                Distributed</p>
                            <p class="text-xl font-bold text-slate-900 dark:text-white">45,820.50 L</p>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-4 p-5 bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600">
                            <span class="material-symbols-outlined">verified_user</span>
                        </div>
                        <div>
                            <p class="text-xs font-bold tracking-widest uppercase text-slate-500">Validation Accuracy
                            </p>
                            <p class="text-xl font-bold text-slate-900 dark:text-white">99.2%</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
