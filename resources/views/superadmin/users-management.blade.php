<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>User Management - Super Admin Panel</title>
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

        .toggle-checkbox:checked {
            right: 0;
            border-color: #195de6;
        }

        .toggle-checkbox:checked+.toggle-label {
            background-color: #195de6;
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
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white" href="#">
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
                        <a class="transition-colors text-slate-500 hover:text-primary" href="#">Administration</a>
                        <span class="text-slate-300">/</span>
                        <span class="font-semibold text-slate-900 dark:text-white">User Management</span>
                    </nav>
                </div>
                <div class="flex items-center gap-6">
                    <div class="relative hidden max-w-md md:block">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                        <input
                            class="w-64 pl-10 pr-4 py-1.5 bg-slate-100 dark:bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary/50"
                            placeholder="Search users..." type="text" />
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
            <div class="p-8 space-y-6">
                <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">System Users</h2>
                        <p class="mt-1 text-sm text-slate-500">Manage and audit access permissions for all system
                            administrators and operators.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <select
                                class="px-4 py-2 pr-10 text-sm font-semibold bg-white border rounded-lg outline-none appearance-none cursor-pointer dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-white focus:ring-primary focus:border-primary">
                                <option value="">All Roles</option>
                                <option value="super-admin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-[18px]">filter_list</span>
                        </div>
                        <button
                            class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-all rounded-lg shadow-sm bg-primary hover:bg-primary/90">
                            <span class="material-symbols-outlined text-[18px]">person_add</span>
                            Add New User
                        </button>
                    </div>
                </div>
                <div
                    class="overflow-hidden bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr
                                    class="bg-slate-50 dark:bg-slate-800/50 border-y border-slate-100 dark:border-slate-800">
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Name</th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Email Address
                                    </th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Role</th>
                                    <th class="px-6 py-4 font-semibold text-center text-slate-900 dark:text-white">
                                        Status</th>
                                    <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Last Login</th>
                                    <th class="px-6 py-4 font-semibold text-right text-slate-900 dark:text-white">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 text-xs font-bold bg-blue-100 rounded-full dark:bg-blue-900/30 text-primary">
                                                AJ</div>
                                            <span class="font-medium text-slate-900 dark:text-white">Alex Johnson</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">alex.johnson@example.com</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-[10px] font-bold uppercase rounded-full tracking-wider">Super
                                            Admin</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input checked="" class="sr-only peer" type="checkbox" />
                                                <div
                                                    class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">Jun 12, 14:22:10</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="transition-colors text-slate-400 hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 text-xs font-bold text-indigo-700 bg-indigo-100 rounded-full dark:bg-indigo-900/30 dark:text-indigo-300">
                                                SM</div>
                                            <span class="font-medium text-slate-900 dark:text-white">Sarah
                                                Miller</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">s.miller@spbu-jakarta.co.id</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-[10px] font-bold uppercase rounded-full tracking-wider">Admin</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input checked="" class="sr-only peer" type="checkbox" />
                                                <div
                                                    class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">Jun 12, 11:05:45</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="transition-colors text-slate-400 hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 text-xs font-bold rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300">
                                                BK</div>
                                            <span class="font-medium text-slate-900 dark:text-white">Budi Kusuma</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">budi.k@field-ops.net</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-[10px] font-bold uppercase rounded-full tracking-wider">Operator</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input checked="" class="sr-only peer" type="checkbox" />
                                                <div
                                                    class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">Jun 11, 23:12:02</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="transition-colors text-slate-400 hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr
                                    class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30 bg-slate-50/30">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3 grayscale opacity-60">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 text-xs font-bold rounded-full bg-slate-100 dark:bg-slate-700 text-slate-500">
                                                RT</div>
                                            <span class="font-medium text-slate-900 dark:text-white">Rina Tania</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 opacity-60">r.tania@spbu-bekasi.co.id</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 bg-slate-100 dark:bg-slate-700 text-slate-500 text-[10px] font-bold uppercase rounded-full tracking-wider">Operator</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input class="sr-only peer" type="checkbox" />
                                                <div
                                                    class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500 opacity-60">May 28, 09:40:15</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="transition-colors text-slate-400 hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="transition-colors hover:bg-slate-50 dark:hover:bg-slate-800/30">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="flex items-center justify-center w-8 h-8 text-xs font-bold bg-blue-100 rounded-full dark:bg-blue-900/30 text-primary">
                                                DP</div>
                                            <span class="font-medium text-slate-900 dark:text-white">Daniel
                                                Pratama</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">daniel.p@hq.system.id</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2.5 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-[10px] font-bold uppercase rounded-full tracking-wider">Admin</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input checked="" class="sr-only peer" type="checkbox" />
                                                <div
                                                    class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary">
                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">Jun 12, 08:30:12</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="transition-colors text-slate-400 hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="flex items-center justify-between px-6 py-4 border-t border-slate-100 dark:border-slate-800">
                        <p class="text-xs font-medium tracking-tight text-slate-500">Showing 1 to 5 of 42 system users
                        </p>
                        <div class="flex items-center gap-2">
                            <button
                                class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition-colors">Previous</button>
                            <div class="flex gap-1">
                                <button class="w-8 h-8 text-xs font-bold text-white rounded-lg bg-primary">1</button>
                                <button
                                    class="w-8 h-8 text-xs font-bold transition-colors border rounded-lg border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-50">2</button>
                                <button
                                    class="w-8 h-8 text-xs font-bold transition-colors border rounded-lg border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-50">3</button>
                            </div>
                            <button
                                class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-700 text-xs font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-50 transition-colors">Next</button>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div
                        class="p-4 border border-purple-100 bg-purple-50 dark:bg-purple-900/10 rounded-xl dark:border-purple-800/50">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-purple-600 text-[18px]">security</span>
                            <h4 class="text-sm font-bold text-purple-900 dark:text-purple-300">Super Admin</h4>
                        </div>
                        <p class="text-xs leading-relaxed text-purple-700/70 dark:text-purple-400/70">Full system
                            access including user management, master data, and global configuration settings.</p>
                    </div>
                    <div
                        class="p-4 border border-blue-100 bg-blue-50 dark:bg-blue-900/10 rounded-xl dark:border-blue-800/50">
                        <div class="flex items-center gap-2 mb-2">
                            <span
                                class="material-symbols-outlined text-blue-600 text-[18px]">admin_panel_settings</span>
                            <h4 class="text-sm font-bold text-blue-900 dark:text-blue-300">Admin</h4>
                        </div>
                        <p class="text-xs leading-relaxed text-blue-700/70 dark:text-blue-400/70">Regional access. Can
                            manage QR codes and monitor distributions within their assigned jurisdiction.</p>
                    </div>
                    <div
                        class="p-4 border bg-emerald-50 dark:bg-emerald-900/10 rounded-xl border-emerald-100 dark:border-emerald-800/50">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="material-symbols-outlined text-emerald-600 text-[18px]">badge</span>
                            <h4 class="text-sm font-bold text-emerald-900 dark:text-emerald-300">Operator</h4>
                        </div>
                        <p class="text-xs leading-relaxed text-emerald-700/70 dark:text-emerald-400/70">Station-level
                            access. Primarily used for scanning and validating QR codes during fuel distribution.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
