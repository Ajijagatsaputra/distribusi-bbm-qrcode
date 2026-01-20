<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin - User Profile Settings - Distribusi BBM</title>
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
                <a class="flex items-center gap-3 px-4 py-3 transition-all rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-800"
                    href="{{ route('admin.reports') }}">
                    <span class="material-symbols-outlined">description</span>
                    <span class="text-sm">Reports</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 font-semibold transition-all rounded-xl bg-primary/10 text-primary"
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
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">User Profile Settings</h2>
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
            <div class="flex-1 p-8">
                <div class="max-w-4xl mx-auto space-y-8">
                    <div>
                        <h3 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">Profile Settings
                        </h3>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage your account information and
                            security preferences.</p>
                    </div>
                    <div
                        class="overflow-hidden bg-white border shadow-sm dark:bg-background-dark rounded-xl border-slate-200 dark:border-slate-800">
                        <form class="divide-y divide-slate-100 dark:divide-slate-800">
                            <div class="p-8">
                                <div class="flex items-center gap-2 mb-8">
                                    <span class="material-symbols-outlined text-primary">person_outline</span>
                                    <h4 class="text-lg font-bold text-slate-900 dark:text-white">Personal Information
                                    </h4>
                                </div>
                                <div class="space-y-8">
                                    <div class="flex items-center gap-8">
                                        <div class="relative group">
                                            <div class="bg-center bg-cover border-4 rounded-full shadow-sm size-24 border-slate-50 dark:border-slate-800 ring-1 ring-slate-200 dark:ring-slate-700"
                                                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBaxsyFU2s-cKzz4FWJMKlmZTryMxQe8wCPCL7L9fe0eQgsyljihrG2JuY8c5EyHYNYW_wTamxfdToLg0zvby2PsBRDr6QfB5yFg4oVbZohnuc5RRHAGduc6I0fpnfKf9My8o_G5iBSwY5rMDKBPb_ymOd7wr0l0cJlKLlsW-bMdiz5a3x_ku1CdQkbV_7mcPshYV3cFRajyMjc5WCnsvB_oc9nYUMso5dnmWzJZpT-dJbiAcFW8NItBFFid9Ofjf05XPgBhBLI5Q');">
                                            </div>
                                            <button
                                                class="absolute bottom-0 right-0 flex items-center justify-center text-white transition-all border-2 border-white rounded-full shadow-lg size-8 bg-primary dark:border-background-dark hover:bg-primary/90"
                                                type="button">
                                                <span class="text-lg material-symbols-outlined">photo_camera</span>
                                            </button>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-3">
                                                <p class="text-sm font-bold text-slate-900 dark:text-white">Profile
                                                    Photo</p>
                                                <span
                                                    class="px-2.5 py-0.5 text-[10px] font-black uppercase tracking-wider bg-blue-50 text-blue-600 dark:bg-blue-900/20 rounded-full border border-blue-100 dark:border-blue-800">Admin
                                                    Logistik</span>
                                            </div>
                                            <p class="mt-1 text-xs text-slate-500">Update your profile picture for the
                                                system.</p>
                                            <button class="mt-3 text-sm font-bold text-primary hover:underline"
                                                type="button">Update Profile</button>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                        <div class="space-y-2">
                                            <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Full
                                                Name</label>
                                            <input
                                                class="w-full px-4 text-sm transition-all rounded-lg h-11 bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 focus:ring-2 focus:ring-primary/20 focus:border-primary"
                                                type="text" value="Budi Santoso" />
                                        </div>
                                        <div class="space-y-2">
                                            <label
                                                class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email
                                                Address</label>
                                            <input
                                                class="w-full px-4 text-sm transition-all rounded-lg h-11 bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 focus:ring-2 focus:ring-primary/20 focus:border-primary"
                                                type="email" value="budi.santoso@pertamina.com" />
                                        </div>
                                        <div class="space-y-2">
                                            <label
                                                class="text-sm font-semibold text-slate-700 dark:text-slate-300">Employee
                                                ID</label>
                                            <input
                                                class="w-full px-4 text-sm rounded-lg cursor-not-allowed h-11 bg-slate-100 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800 text-slate-500"
                                                readonly="" type="text" value="ADM-12993-LOG" />
                                        </div>
                                        <div class="space-y-2">
                                            <label
                                                class="text-sm font-semibold text-slate-700 dark:text-slate-300">Department</label>
                                            <input
                                                class="w-full px-4 text-sm rounded-lg cursor-not-allowed h-11 bg-slate-100 dark:bg-slate-800/50 border-slate-200 dark:border-slate-800 text-slate-500"
                                                readonly="" type="text" value="Logistics Operations" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="flex items-center gap-2 mb-8">
                                    <span class="material-symbols-outlined text-primary">lock_reset</span>
                                    <h4 class="text-lg font-bold text-slate-900 dark:text-white">Security</h4>
                                </div>
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Current
                                            Password</label>
                                        <input
                                            class="w-full px-4 text-sm transition-all rounded-lg h-11 bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 focus:ring-2 focus:ring-primary/20 focus:border-primary"
                                            placeholder="••••••••" type="password" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">New
                                            Password</label>
                                        <input
                                            class="w-full px-4 text-sm transition-all rounded-lg h-11 bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 focus:ring-2 focus:ring-primary/20 focus:border-primary"
                                            placeholder="••••••••" type="password" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Confirm
                                            New Password</label>
                                        <input
                                            class="w-full px-4 text-sm transition-all rounded-lg h-11 bg-slate-50 dark:bg-slate-900 border-slate-200 dark:border-slate-800 focus:ring-2 focus:ring-primary/20 focus:border-primary"
                                            placeholder="••••••••" type="password" />
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-3 p-4 mt-4 border rounded-lg bg-amber-50 dark:bg-amber-950/20 border-amber-100 dark:border-amber-900/30">
                                    <span class="material-symbols-outlined text-amber-600">info</span>
                                    <p class="text-xs text-amber-800 dark:text-amber-400">Password must be at least 8
                                        characters long and include a mix of letters, numbers, and symbols.</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-end gap-3 p-8 bg-slate-50 dark:bg-slate-800/30">
                                <button
                                    class="px-6 text-sm font-bold transition-all rounded-lg h-11 text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800"
                                    type="button">
                                    Discard Changes
                                </button>
                                <button
                                    class="px-8 text-sm font-bold text-white transition-all rounded-lg shadow-lg h-11 bg-primary hover:bg-primary/90 shadow-primary/20"
                                    type="submit">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div
                            class="p-6 bg-white border shadow-sm dark:bg-background-dark border-slate-200 dark:border-slate-800 rounded-xl">
                            <h5 class="flex items-center gap-2 font-bold text-slate-900 dark:text-white">
                                <span
                                    class="text-xl material-symbols-outlined text-primary">notifications_active</span>
                                Notification Settings
                            </h5>
                            <p class="mt-1 mb-4 text-xs text-slate-500">Choose which distribution updates you want to
                                receive.</p>
                            <button class="text-sm font-bold text-primary hover:underline">Manage
                                Notifications</button>
                        </div>
                        <div
                            class="p-6 bg-white border shadow-sm dark:bg-background-dark border-slate-200 dark:border-slate-800 rounded-xl">
                            <h5 class="flex items-center gap-2 font-bold text-slate-900 dark:text-white">
                                <span class="text-xl material-symbols-outlined text-rose-500">delete_forever</span>
                                Account Status
                            </h5>
                            <p class="mt-1 mb-4 text-xs text-slate-500">Contact Super Admin to deactivate or delete
                                your account access.</p>
                            <span
                                class="text-xs font-bold text-green-600 bg-green-50 dark:bg-green-950/20 px-2.5 py-1 rounded-full">Account
                                Active</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>
