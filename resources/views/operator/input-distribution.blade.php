<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Operator Input Distribution Form</title>
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
            class="w-72 bg-white dark:bg-[#1a202c] border-r border-[#dcdfe5] dark:border-slate-800 flex flex-col fixed h-full">
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
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary/10 text-primary"
                        href="{{ route('operator.input-distribution') }}">
                        <span class="material-symbols-outlined">add_box</span>
                        <span class="text-sm font-semibold">Input Distribution Data</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3 rounded-lg text-[#636f88] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="{{ route('operator.history') }}">
                        <span class="material-symbols-outlined">history</span>
                        <span class="text-sm font-medium">History</span>
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
            <div class="max-w-[900px] mx-auto p-8">
                <nav aria-label="Breadcrumb" class="flex mb-4">
                    <ol
                        class="inline-flex items-center space-x-1 md:space-x-3 text-xs font-medium text-[#636f88] dark:text-slate-400">
                        <li class="inline-flex items-center">
                            <a class="transition-colors hover:text-primary" href="#">Dashboard</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <span class="mx-1 text-sm material-symbols-outlined">chevron_right</span>
                                <span class="font-bold text-primary">Input Distribution</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="flex flex-col gap-2 mb-8">
                    <h1 class="text-[#111318] dark:text-white text-3xl font-black leading-tight tracking-tight">Input
                        Distribution Data</h1>
                    <p class="text-[#636f88] dark:text-slate-400 text-sm font-normal">Complete the form below to
                        register a new fuel distribution entry.</p>
                </div>
                <div
                    class="bg-white dark:bg-[#1a202c] border border-[#dcdfe5] dark:border-slate-800 rounded-xl shadow-sm overflow-hidden">
                    <form action="#" method="POST">
                        <div class="p-8 border-b border-[#dcdfe5] dark:border-slate-800">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                    <span class="material-symbols-outlined text-primary">local_shipping</span>
                                </div>
                                <h2 class="text-lg font-bold text-[#111318] dark:text-white">Vehicle Information</h2>
                            </div>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-[#111318] dark:text-slate-300"
                                        for="vehicle_id">Vehicle ID / License Plate</label>
                                    <div class="flex gap-2">
                                        <input
                                            class="flex-1 block w-full rounded-lg border-[#dcdfe5] dark:border-slate-700 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm p-3"
                                            id="vehicle_id" placeholder="e.g. D 1234 ABC" type="text" />
                                        <button
                                            class="inline-flex items-center px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-lg hover:bg-slate-200 transition-colors border border-[#dcdfe5] dark:border-slate-600"
                                            type="button">
                                            <span class="mr-2 text-lg material-symbols-outlined">qr_code_scanner</span>
                                            <span class="text-xs font-bold tracking-tight uppercase">Scan QR</span>
                                        </button>
                                    </div>
                                    <p class="text-[11px] text-[#636f88] dark:text-slate-400">Scan the vehicle QR code
                                        or enter plate manually</p>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-[#111318] dark:text-slate-300"
                                        for="driver_name">Driver Name</label>
                                    <input
                                        class="block w-full rounded-lg border-[#dcdfe5] dark:border-slate-700 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm p-3"
                                        id="driver_name" placeholder="Full name of driver" type="text" />
                                </div>
                            </div>
                        </div>
                        <div
                            class="p-8 border-b border-[#dcdfe5] dark:border-slate-800 bg-slate-50/50 dark:bg-slate-800/20">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                    <span class="material-symbols-outlined text-primary">oil_barrel</span>
                                </div>
                                <h2 class="text-lg font-bold text-[#111318] dark:text-white">Fuel Details</h2>
                            </div>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-[#111318] dark:text-slate-300"
                                        for="fuel_type">Fuel Type</label>
                                    <select
                                        class="block w-full rounded-lg border-[#dcdfe5] dark:border-slate-700 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm p-3"
                                        id="fuel_type">
                                        <option value="">Select fuel type</option>
                                        <option value="pertalite">Pertalite</option>
                                        <option value="pertamax">Pertamax</option>
                                        <option value="pertamax_turbo">Pertamax Turbo</option>
                                        <option value="solar">Solar / Dexlite</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-[#111318] dark:text-slate-300"
                                        for="quantity">Quantity</label>
                                    <div class="relative">
                                        <input
                                            class="block w-full rounded-lg border-[#dcdfe5] dark:border-slate-700 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm p-3 pr-16"
                                            id="quantity" placeholder="0.00" step="0.01" type="number" />
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                            <span
                                                class="text-sm font-bold text-[#636f88] dark:text-slate-400">Liters</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 rounded-lg bg-blue-50 dark:bg-blue-900/20">
                                    <span class="material-symbols-outlined text-primary">location_on</span>
                                </div>
                                <h2 class="text-lg font-bold text-[#111318] dark:text-white">Location Info</h2>
                            </div>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-[#111318] dark:text-slate-300"
                                        for="destination">SPBU / Destination</label>
                                    <select
                                        class="block w-full rounded-lg border-[#dcdfe5] dark:border-slate-700 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm p-3"
                                        id="destination">
                                        <option value="">Select destination</option>
                                        <option value="spbu_04">SPBU 04 - Pasteur</option>
                                        <option value="spbu_07">SPBU 07 - Dago</option>
                                        <option value="spbu_12">SPBU 12 - Lembang</option>
                                        <option value="depot_central">Depot Central</option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-[#111318] dark:text-slate-300"
                                        for="notes">Additional Notes (Optional)</label>
                                    <input
                                        class="block w-full rounded-lg border-[#dcdfe5] dark:border-slate-700 dark:bg-slate-800 focus:border-primary focus:ring-primary text-sm p-3"
                                        id="notes" placeholder="Any specific instructions or remarks"
                                        type="text" />
                                </div>
                            </div>
                        </div>
                        <div
                            class="px-8 py-6 bg-slate-50 dark:bg-slate-800/40 border-t border-[#dcdfe5] dark:border-slate-800 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <button
                                class="px-6 py-3 rounded-lg border border-[#dcdfe5] dark:border-slate-700 text-[#636f88] dark:text-slate-400 font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                                type="button">
                                Cancel
                            </button>
                            <button
                                class="flex items-center justify-center gap-2 px-10 py-3 font-bold text-white transition-all rounded-lg shadow-lg bg-primary shadow-primary/25 hover:bg-blue-700"
                                type="submit">
                                <span class="text-xl material-symbols-outlined">send</span>
                                Submit Entry
                            </button>
                        </div>
                    </form>
                </div>
                <div
                    class="flex items-start gap-3 p-4 mt-6 border rounded-lg bg-amber-50 dark:bg-amber-900/10 border-amber-200 dark:border-amber-900/30">
                    <span class="material-symbols-outlined text-amber-600 dark:text-amber-500">info</span>
                    <p class="text-sm text-amber-800 dark:text-amber-300">
                        <strong>Note:</strong> Please ensure all meter readings and vehicle IDs are double-checked
                        against the manual manifest before submission. Errors may require administrator approval to
                        correct.
                    </p>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
