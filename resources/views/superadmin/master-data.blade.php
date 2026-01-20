<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Master Data Management - BBM System</title>
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

        [data-tab-content] {
            display: none;
        }

        [data-tab-content].active {
            display: block;
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
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary text-white" href="#">
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
                    class="flex items-center gap-3 px-3 py-2.5 w-full rounded-lg text-slate-400 hover:text-red-400 hover:bg-red-400/10 transition-colors"
                    onclick="event.preventDefault(); document.location.href = '{{ url('/') }}'" type="button">
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
                        <span class="font-semibold text-slate-900 dark:text-white">Master Data</span>
                    </nav>
                </div>
                <div class="flex items-center gap-6">
                    <div class="relative hidden max-w-md md:block">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[20px]">search</span>
                        <input
                            class="w-64 pl-10 pr-4 py-1.5 bg-slate-100 dark:bg-slate-800 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary/50"
                            placeholder="Search Master Data..." type="text" />
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
                <div class="flex items-end justify-between">
                    <div>
                        <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Master Data
                            Management</h2>
                        <p class="mt-1 text-sm text-slate-500">Configure and manage SPBU locations and fuel
                            specifications.</p>
                    </div>
                </div>
                <div
                    class="overflow-hidden bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                    <div class="flex items-center justify-between px-6 border-b border-slate-100 dark:border-slate-800">
                        <div class="flex gap-8">
                            <button
                                class="flex items-center gap-2 py-4 text-sm font-bold border-b-2 border-primary text-primary"
                                onclick="switchTab('spbu-locations')">
                                <span class="material-symbols-outlined text-[20px]">pin_drop</span>
                                SPBU Locations
                            </button>
                            <button
                                class="flex items-center gap-2 py-4 text-sm font-medium border-b-2 border-transparent text-slate-500 hover:text-slate-900 dark:hover:text-white"
                                onclick="switchTab('fuel-types')">
                                <span class="material-symbols-outlined text-[20px]">gas_meter</span>
                                Fuel Types
                            </button>
                        </div>
                        <div class="py-3">
                            <button
                                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-primary/90"
                                id="add-btn-spbu">
                                <span class="material-symbols-outlined text-[18px]">add_location</span>
                                Add SPBU
                            </button>
                            <button
                                class="flex items-center hidden gap-2 px-4 py-2 text-sm font-semibold text-white transition-colors rounded-lg bg-primary hover:bg-primary/90"
                                id="add-btn-fuel">
                                <span class="material-symbols-outlined text-[18px]">add_circle</span>
                                Add Fuel Type
                            </button>
                        </div>
                    </div>
                    <div class="active" data-tab-content="" id="spbu-locations">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead>
                                    <tr
                                        class="border-b bg-slate-50 dark:bg-slate-800/50 border-slate-100 dark:border-slate-800">
                                        <th class="w-24 px-6 py-4 font-semibold text-slate-900 dark:text-white">ID</th>
                                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Station Name
                                        </th>
                                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Address</th>
                                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Coordinates
                                        </th>
                                        <th class="px-6 py-4 font-semibold text-right text-slate-900 dark:text-white">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    <tr>
                                        <td class="px-6 py-4 font-mono text-xs font-bold text-primary">31.12101</td>
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">Pertalite
                                            Station Kuningan</td>
                                        <td class="px-6 py-4 text-slate-500">Jl. HR Rasuna Said No.10, Jakarta Selatan
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase rounded">
                                                <span class="material-symbols-outlined text-[12px]">check_circle</span>
                                                Linked
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-red-500">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-mono text-xs font-bold text-primary">31.12105</td>
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">BBM Center
                                            Gatot Subroto</td>
                                        <td class="px-6 py-4 text-slate-500">Jl. Jend. Gatot Subroto Kav 32, Jakarta
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase rounded">
                                                <span class="material-symbols-outlined text-[12px]">check_circle</span>
                                                Linked
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-red-500">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-mono text-xs font-bold text-primary">31.12108</td>
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">SPBU Sudirman
                                            Central</td>
                                        <td class="px-6 py-4 text-slate-500">Kawasan SCBD Lot 11, Jakarta Pusat</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2 py-1 bg-amber-100 text-amber-700 text-[10px] font-bold uppercase rounded">
                                                <span class="material-symbols-outlined text-[12px]">warning</span>
                                                Pending
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-red-500">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div data-tab-content="" id="fuel-types">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead>
                                    <tr
                                        class="border-b bg-slate-50 dark:bg-slate-800/50 border-slate-100 dark:border-slate-800">
                                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Fuel Name
                                        </th>
                                        <th class="px-6 py-4 font-semibold text-right text-slate-900 dark:text-white">
                                            Price per Liter (IDR)</th>
                                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Status</th>
                                        <th class="px-6 py-4 font-semibold text-slate-900 dark:text-white">Last Updated
                                        </th>
                                        <th class="px-6 py-4 font-semibold text-right text-slate-900 dark:text-white">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    <tr>
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">Pertalite</td>
                                        <td class="px-6 py-4 font-mono text-right text-slate-700 dark:text-slate-300">
                                            10,000.00</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase rounded">Available</span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500">2 days ago</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">Pertamax</td>
                                        <td class="px-6 py-4 font-mono text-right text-slate-700 dark:text-slate-300">
                                            12,950.00</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase rounded">Available</span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500">1 week ago</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">Bio Solar</td>
                                        <td class="px-6 py-4 font-mono text-right text-slate-700 dark:text-slate-300">
                                            6,800.00</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase rounded">Available</span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500">3 days ago</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">Pertamax Turbo
                                        </td>
                                        <td class="px-6 py-4 font-mono text-right text-slate-700 dark:text-slate-300">
                                            14,400.00</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 bg-slate-100 text-slate-500 text-[10px] font-bold uppercase rounded">Inactive</span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-500">1 month ago</td>
                                        <td class="px-6 py-4 text-right">
                                            <button class="mx-2 transition-colors text-slate-400 hover:text-primary">
                                                <span class="material-symbols-outlined text-[20px]">edit</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div
                        class="flex items-center justify-between px-6 py-4 border-t border-slate-100 dark:border-slate-800">
                        <p class="text-xs font-medium tracking-tight text-slate-500">Showing 1-10 of 24 records</p>
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
    <script>
        function switchTab(tabId) {
            // Update content visibility
            document.querySelectorAll('[data-tab-content]').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(tabId).classList.add('active');
            // Update button styles
            const buttons = document.querySelectorAll('.flex.gap-8 button');
            buttons.forEach(btn => {
                btn.classList.remove('border-primary', 'text-primary', 'font-bold');
                btn.classList.add('border-transparent', 'text-slate-500', 'font-medium');
            });
            const activeBtn = event.currentTarget;
            activeBtn.classList.add('border-primary', 'text-primary', 'font-bold');
            activeBtn.classList.remove('border-transparent', 'text-slate-500', 'font-medium');
            // Update Action Button
            if (tabId === 'spbu-locations') {
                document.getElementById('add-btn-spbu').classList.remove('hidden');
                document.getElementById('add-btn-fuel').classList.add('hidden');
            } else {
                document.getElementById('add-btn-spbu').classList.add('hidden');
                document.getElementById('add-btn-fuel').classList.remove('hidden');
            }
        }
    </script>

</body>

</html>
