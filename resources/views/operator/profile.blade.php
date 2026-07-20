<!DOCTYPE html>
<html class="light" lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pertamina - Driver Profile Settings</title>
    @pwaHead('logo.png', '#005eb8')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "pertamina-blue": "#005eb8",
                        "pertamina-red": "#ed161f",
                        "pertamina-green": "#7abb3a",
                        "background-light": "#f4f7fb",
                        "background-dark": "#0f172a",
                    },
                    fontFamily: {
                        "sans": ["Outfit", "sans-serif"]
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(0, 94, 184, 0.05)',
                        'glow-blue': '0 0 20px rgba(0, 94, 184, 0.3)',
                        'glow-red': '0 0 20px rgba(237, 22, 31, 0.3)',
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .dark .glass-panel {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #005eb8, #0099ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark min-h-screen text-slate-800 dark:text-slate-100 overflow-x-hidden">
    <!-- Ambient Backgrounds -->
    <div
        class="fixed top-0 left-0 w-full h-80 bg-gradient-to-b from-pertamina-blue/10 to-transparent pointer-events-none -z-10">
    </div>

    <div class="flex flex-col lg:flex-row min-h-screen">
        <!-- Sidebar Backdrop for Mobile -->
        <div id="sidebar-overlay" onclick="toggleSidebar()"
            class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm z-20 hidden lg:hidden"></div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-72 glass-panel border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col fixed h-full z-30 transition-transform duration-300 -translate-x-full lg:translate-x-0">
            <div class="flex flex-col h-full px-6 py-8">
                <!-- Brand -->
                <div class="flex items-center gap-4 mb-12 px-2">
                    <div
                        class="flex items-center justify-center text-white rounded-xl bg-gradient-to-br from-pertamina-blue to-blue-700 shadow-glow-blue size-12 shrink-0">
                        <span class="material-symbols-outlined text-2xl">local_gas_station</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-900 dark:text-white">
                            BBM<span class="text-pertamina-red">Distribusi</span></h1>
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5">Driver Portal
                        </p>
                    </div>
                </div>

                <!-- Nav -->
                <nav class="flex flex-col flex-1 gap-2">
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group"
                        href="{{ route('operator.dashboard') }}">
                        <span
                            class="material-symbols-outlined group-hover:scale-110 transition-transform">dashboard</span>
                        <span class="text-sm">Dashboard Overview</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group"
                        href="{{ route('operator.surat-jalan') }}">
                        <span
                            class="material-symbols-outlined group-hover:scale-110 transition-transform">description</span>
                        <span class="text-sm">Surat Jalan</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group"
                        href="{{ route('operator.history') }}">
                        <span
                            class="material-symbols-outlined group-hover:scale-110 transition-transform">history</span>
                        <span class="text-sm">Riwayat Pengiriman</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-pertamina-blue/10 text-pertamina-blue font-bold transition-all relative group"
                        href="{{ route('operator.profile') }}">
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full">
                        </div>
                        <span class="material-symbols-outlined">person</span>
                        <span class="text-sm">Profile Settings</span>
                    </a>
                </nav>

                <!-- Profile -->
                <div class="mt-auto pt-8">
                    <div class="glass-panel rounded-2xl p-4 flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=005eb8&color=fff"
                                    alt="User" class="rounded-full size-10 border-2 border-white shadow-sm" />
                                <div
                                    class="absolute bottom-0 right-0 size-3 bg-pertamina-green rounded-full border-2 border-white">
                                </div>
                            </div>
                            <div class="flex flex-col overflow-hidden">
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">
                                    {{ auth()->user()->name }}
                                </p>
                                <p class="text-xs text-slate-500 font-medium">Driver BBM</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-pertamina-red hover:bg-pertamina-red hover:text-white font-semibold transition-all border border-pertamina-red/20 shadow-sm">
                                <span class="material-symbols-outlined text-sm">logout</span>
                                <span class="text-sm">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Header -->
        <header
            class="lg:hidden w-full h-16 glass-panel border-b border-slate-200/50 dark:border-slate-800/50 fixed top-0 left-0 flex items-center justify-between px-6 z-20">
            <div class="flex items-center gap-3">
                <div
                    class="flex items-center justify-center text-white rounded-lg bg-gradient-to-br from-pertamina-blue to-blue-700 size-10 shrink-0">
                    <span class="material-symbols-outlined text-xl">local_gas_station</span>
                </div>
                <span class="text-base font-bold text-slate-900 dark:text-white">BBM<span
                        class="text-pertamina-red">Distribusi</span></span>
            </div>
            <button onclick="toggleSidebar()"
                class="p-2 text-slate-500 hover:text-pertamina-blue hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-all">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>
        </header>

        <!-- Main Content -->
        <main class="flex-1 w-full min-w-0 lg:ml-72 min-h-screen pt-20 lg:pt-0">
            <div class="max-w-[1000px] mx-auto p-4 sm:p-6 lg:p-10 space-y-10">
                <!-- Top Header -->
                <header class="flex flex-col gap-2">
                    <h2
                        class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        Pengaturan <span class="gradient-text">Profil Anda</span>
                    </h2>
                    <p class="text-slate-500 text-base font-medium">Kelola data akun pengemudi dan preferensi keamanan
                        Anda.</p>
                </header>

                {{-- TOAST NOTIFICATION --}}
                <div id="toastNotification"
                    class="fixed top-24 right-8 z-50 flex items-center gap-3 px-4 py-3 text-sm font-semibold text-white bg-slate-900 rounded-xl shadow-2xl transition-all transform translate-x-full opacity-0">
                    <span class="material-symbols-outlined text-pertamina-green">check_circle</span>
                    <span id="toastMessage">Profil Berhasil Diperbarui!</span>
                </div>

                {{-- PROFILE FORM --}}
                <div class="glass-panel rounded-3xl overflow-hidden shadow-glass border border-white/40">
                    <form id="profileForm" onsubmit="handleProfileSubmit(event)" class="divide-y divide-slate-200/50">
                        <div class="p-6 sm:p-8 space-y-8">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-pertamina-blue/10">
                                    <span
                                        class="text-xl material-symbols-outlined text-pertamina-blue">person_outline</span>
                                </div>
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white">Informasi Personal</h4>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center gap-6 pb-4">
                                <div class="relative group">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=005eb8&color=fff"
                                        alt="Avatar"
                                        class="rounded-full size-24 border-4 border-white shadow-md dark:border-slate-800" />
                                    <button
                                        class="absolute bottom-0 right-0 flex items-center justify-center text-white transition-all border-2 border-white rounded-full shadow-lg size-8 bg-pertamina-blue hover:bg-blue-700 dark:border-slate-900 shadow-pertamina-blue/30"
                                        type="button">
                                        <span class="text-sm material-symbols-outlined">photo_camera</span>
                                    </button>
                                </div>
                                <div class="text-center sm:text-left space-y-1">
                                    <h5 class="text-base font-bold text-slate-900 dark:text-white">
                                        {{ auth()->user()->name }}</h5>
                                    <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Driver
                                        Pengiriman BBM</p>
                                    <span
                                        class="inline-flex items-center gap-1 px-2.5 py-0.5 text-[10px] font-bold bg-pertamina-green/10 text-pertamina-green rounded-full border border-pertamina-green/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-pertamina-green"></span>
                                        Status: Aktif
                                    </span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Nama
                                        Lengkap</label>
                                    <input
                                        class="w-full h-12 px-4 text-sm rounded-xl border border-slate-200 bg-white text-slate-800 font-semibold focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue transition-all"
                                        type="text" value="{{ auth()->user()->name }}" required />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email
                                        Address</label>
                                    <input
                                        class="w-full h-12 px-4 text-sm rounded-xl border border-slate-200 bg-white text-slate-800 font-semibold focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue transition-all"
                                        type="email" value="{{ auth()->user()->email }}" required />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">ID Pengemudi
                                        (NIP)</label>
                                    <input
                                        class="w-full h-12 px-4 text-sm font-mono rounded-xl bg-slate-100/50 border border-slate-200 text-slate-500 cursor-not-allowed"
                                        readonly type="text" value="DRV-00{{ auth()->user()->id }}-BBM" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Peran
                                        Sistem</label>
                                    <input
                                        class="w-full h-12 px-4 text-sm rounded-xl bg-slate-100/50 border border-slate-200 text-slate-500 cursor-not-allowed"
                                        readonly type="text" value="Driver / Operator" />
                                </div>
                            </div>
                        </div>

                        <div class="p-6 sm:p-8 space-y-8">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-orange-500/10">
                                    <span class="text-xl material-symbols-outlined text-orange-500">lock_reset</span>
                                </div>
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white">Ubah Password</h4>
                            </div>

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Password
                                        Sekarang</label>
                                    <input
                                        class="w-full h-12 px-4 text-sm rounded-xl border border-slate-200 bg-white text-slate-800 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue transition-all"
                                        placeholder="••••••••" type="password" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Password
                                        Baru</label>
                                    <input
                                        class="w-full h-12 px-4 text-sm rounded-xl border border-slate-200 bg-white text-slate-800 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue transition-all"
                                        placeholder="••••••••" type="password" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-700 dark:text-slate-300">Konfirmasi
                                        Password Baru</label>
                                    <input
                                        class="w-full h-12 px-4 text-sm rounded-xl border border-slate-200 bg-white text-slate-800 focus:ring-2 focus:ring-pertamina-blue/20 focus:border-pertamina-blue transition-all"
                                        placeholder="••••••••" type="password" />
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-3 p-6 sm:p-8 bg-slate-50/50 dark:bg-slate-800/30">
                            <button
                                class="px-6 py-3 text-sm font-bold bg-white border border-slate-200 shadow-sm rounded-xl text-slate-700 hover:bg-slate-50 transition-all"
                                type="button" onclick="window.location.reload()">Reset</button>
                            <button
                                class="px-8 py-3 text-sm font-bold text-white shadow-lg rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:to-blue-500 shadow-glow-blue transition-all"
                                type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <!-- Custom PWA Install Banner -->
    <div id="pwa-install-banner"
        class="hidden fixed bottom-6 left-6 right-6 lg:left-80 lg:right-10 bg-gradient-to-r from-pertamina-blue to-blue-700 text-white rounded-3xl p-6 shadow-2xl z-40 border border-white/20">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-white/10 rounded-2xl border border-white/20 shrink-0">
                    <span class="material-symbols-outlined text-3xl text-white">install_mobile</span>
                </div>
                <div>
                    <h4 class="text-lg font-bold">Pasang Aplikasi PWA</h4>
                    <p class="text-xs text-blue-100 font-medium">Instal aplikasi untuk akses cepat tanpa internet &
                        notifikasi langsung.</p>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto shrink-0">
                <button id="pwa-install-btn"
                    class="flex-1 sm:flex-none px-6 py-3 bg-white text-pertamina-blue font-bold text-sm rounded-xl hover:bg-blue-50 transition-all shadow-sm">
                    Pasang Sekarang
                </button>
                <button onclick="document.getElementById('pwa-install-banner').classList.add('hidden')"
                    class="p-3 bg-white/10 hover:bg-white/20 text-white rounded-xl transition-all">
                    <span class="material-symbols-outlined text-sm">close</span>
                </button>
            </div>
        </div>
    </div>

    @laravelPWA
    @pwaUpdateNotifier

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }
        }

        function showToast(message) {
            const toast = document.getElementById('toastNotification');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('translate-x-full', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
            }, 3000);
        }

        function handleProfileSubmit(e) {
            e.preventDefault();
            showToast('Profil Berhasil Diperbarui!');
        }

        window.addEventListener('pwa-installable', (e) => {
            const banner = document.getElementById('pwa-install-banner');
            if (banner) {
                banner.classList.remove('hidden');
            }
        });
    </script>
</body>

</html>