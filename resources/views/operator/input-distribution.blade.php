<!DOCTYPE html>
<html class="light" lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Pertamina - Input Distribusi QR Code</title>
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
                    fontFamily: { "sans": ["Outfit", "sans-serif"] },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(0, 94, 184, 0.05)',
                        'glow-blue': '0 0 20px rgba(0, 94, 184, 0.3)',
                        'glow-red': '0 0 20px rgba(237, 22, 31, 0.4)',
                    },
                    animation: {
                        'scanline': 'scanline 2s linear infinite',
                        'pulse-ring': 'pulseRing 3s cubic-bezier(0.215, 0.61, 0.355, 1) infinite',
                    },
                    keyframes: {
                        scanline: {
                            '0%': { transform: 'translateY(-100%)' },
                            '100%': { transform: 'translateY(200px)' },
                        },
                        pulseRing: {
                            '0%': { transform: 'scale(0.8)', opacity: '0.5' },
                            '100%': { transform: 'scale(1.5)', opacity: '0' },
                        }
                    }
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
            background: rgba(255, 255, 255, 0.75);
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

        .scanner-frame {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: inset 0 0 40px rgba(0, 0, 0, 0.5);
        }

        .scanner-frame::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #ed161f;
            box-shadow: 0 0 20px 4px #ed161f;
            animation: scanline 2.5s infinite linear;
            z-index: 10;
            pointer-events: none;
        }

        .input-glass {
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(203, 213, 225, 0.6);
            transition: all 0.3s ease;
        }

        .input-glass:focus {
            background: #ffffff;
            border-color: #005eb8;
            box-shadow: 0 0 0 4px rgba(0, 94, 184, 0.1);
            transform: scale(1.01);
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark min-h-screen text-slate-800 dark:text-slate-100 overflow-x-hidden">
    <!-- Ambient Background -->
    <div
        class="fixed top-[20%] right-[-10%] w-[50%] h-[50%] rounded-full bg-pertamina-red/5 blur-[120px] pointer-events-none -z-10">
    </div>
    <div
        class="fixed top-0 left-0 w-full h-80 bg-gradient-to-b from-pertamina-blue/5 to-transparent pointer-events-none -z-10">
    </div>
    <div class="flex min-h-screen relative z-10">
        <!-- Sidebar -->
        <aside class="w-72 glass-panel border-r border-slate-200/50 flex flex-col fixed h-full z-20">
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
                        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mt-0.5">Operator Portal
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
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-pertamina-blue/10 text-pertamina-blue font-bold transition-all relative group"
                        href="{{ route('operator.input-distribution') }}">
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full">
                        </div>
                        <span class="material-symbols-outlined">qr_code_scanner</span>
                        <span class="text-sm">Scan &amp; Input Data</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group"
                        href="{{ route('operator.history') }}">
                        <span
                            class="material-symbols-outlined group-hover:scale-110 transition-transform">history</span>
                        <span class="text-sm">Distribution Log</span>
                    </a>
                </nav>

                <!-- Profile -->
                <div class="mt-auto pt-8">
                    <div class="glass-panel rounded-2xl p-4 flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=005eb8&color=fff"
                                    alt="User" class="rounded-full size-10 border-2 border-white" />
                                <div
                                    class="absolute bottom-0 right-0 size-3 bg-pertamina-green rounded-full border-2 border-white">
                                </div>
                            </div>
                            <div class="flex flex-col overflow-hidden">
                                <p class="text-sm font-bold text-slate-900 dark:text-white truncate">
                                    {{ auth()->user()->name }}</p>
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

        <!-- Main Form Area -->
        <main class="flex-1 ml-72">
            <div class="max-w-[900px] mx-auto p-10">
                <!-- Header -->
                <div class="mb-10 text-center flex flex-col items-center">
                    <div
                        class="inline-flex items-center justify-center size-16 rounded-3xl bg-pertamina-blue/10 text-pertamina-blue mb-4 shadow-glass">
                        <span class="material-symbols-outlined text-3xl">qr_code_2</span>
                    </div>
                    <h2 class="text-4xl font-extrabold tracking-tight text-slate-900 mb-2">
                        Pindai <span class="gradient-text">QR Code Distribusi</span>
                    </h2>
                    <p class="text-slate-500 font-medium text-lg max-w-2xl">
                        Arahkan kamera ke QR Code armada untuk mencatat detail manifest secara otomatis. Cepat, aman,
                        dan efisien.
                    </p>
                </div>

                <!-- Main Scanner UI Focus -->
                <div
                    class="scanner-frame h-80 mb-10 p-4 border border-slate-700/50 flex flex-col items-center justify-center relative shadow-2xl">
                    <div
                        class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20 pointer-events-none">
                    </div>
                    <!-- Viewfinder corners -->
                    <div class="absolute top-8 left-8 w-16 h-16 border-t-4 border-l-4 border-white/50 rounded-tl-3xl">
                    </div>
                    <div class="absolute top-8 right-8 w-16 h-16 border-t-4 border-r-4 border-white/50 rounded-tr-3xl">
                    </div>
                    <div
                        class="absolute bottom-8 left-8 w-16 h-16 border-b-4 border-l-4 border-white/50 rounded-bl-3xl">
                    </div>
                    <div
                        class="absolute bottom-8 right-8 w-16 h-16 border-b-4 border-r-4 border-white/50 rounded-br-3xl">
                    </div>

                    <button
                        class="relative group z-10 flex flex-col items-center gap-4 hover:scale-105 transition-transform duration-300">
                        <div
                            class="absolute inset-0 rounded-full bg-pertamina-red/30 animate-pulse-ring pointer-events-none">
                        </div>
                        <div
                            class="size-24 rounded-full bg-gradient-to-tr from-pertamina-red to-orange-500 shadow-glow-red flex items-center justify-center text-white border-4 border-white/20">
                            <span class="material-symbols-outlined text-4xl">document_scanner</span>
                        </div>
                        <span class="text-white font-bold text-xl tracking-wide shadow-black drop-shadow-md">AKTIFKAN
                            KAMERA SCANNER</span>
                    </button>
                    <p class="absolute bottom-4 text-slate-400 text-sm italic z-10 text-center max-w-sm">
                        Memerlukan izin akses kamera. Pastikan pencahayaan cukup untuk pemindaian instan.
                    </p>
                </div>

                <div class="flex items-center gap-4 mb-8">
                    <div class="h-px bg-slate-200 flex-1"></div>
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Atau Input Manual
                        Manifest</span>
                    <div class="h-px bg-slate-200 flex-1"></div>
                </div>

                <!-- Form Area -->
                <form class="glass-panel p-8 rounded-[2rem] shadow-glass border border-white/60 mb-8" method="POST"
                    action="{{ route('operator.distributions.store') }}">
                    @csrf
                    @if(session('success'))
                        <div
                            class="mb-4 flex items-center gap-3 px-4 py-3 bg-pertamina-green/10 border border-pertamina-green/30 rounded-xl text-pertamina-green font-semibold text-sm">
                            <span class="material-symbols-outlined">check_circle</span> {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                            <ul class="list-disc pl-4 space-y-1">
                                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <!-- Vehicle & Driver info -->
                        <div class="flex flex-col gap-5">
                            <h3 class="flex items-center gap-2 text-lg font-bold text-slate-800 mb-2">
                                <span class="material-symbols-outlined text-pertamina-blue">local_shipping</span>
                                Informasi Armada
                            </h3>
                            <div class="space-y-1.5 group">
                                <label
                                    class="text-sm font-bold text-slate-600 block pl-1 group-focus-within:text-pertamina-blue transition-colors">No.
                                    Polisi Kendaraan</label>
                                <input type="text" name="vehicle_plate" placeholder="Cth. B 1234 CD"
                                    value="{{ old('vehicle_plate') }}"
                                    class="w-full h-12 px-4 rounded-xl input-glass outline-none text-slate-800 font-semibold placeholder:font-normal placeholder:text-slate-400"
                                    required />
                            </div>
                            <div class="space-y-1.5 group">
                                <label
                                    class="text-sm font-bold text-slate-600 block pl-1 group-focus-within:text-pertamina-blue transition-colors">Nama
                                    Pengemudi</label>
                                <input type="text" name="driver_name" placeholder="Nama Lengkap Sopir"
                                    value="{{ old('driver_name') }}"
                                    class="w-full h-12 px-4 rounded-xl input-glass outline-none text-slate-800 font-semibold placeholder:font-normal placeholder:text-slate-400"
                                    required />
                            </div>
                        </div>

                        <!-- Fuel Info -->
                        <div class="flex flex-col gap-5">
                            <h3 class="flex items-center gap-2 text-lg font-bold text-slate-800 mb-2">
                                <span class="material-symbols-outlined text-pertamina-red">oil_barrel</span> Detail
                                Muatan
                            </h3>
                            <div class="space-y-1.5 group">
                                <label
                                    class="text-sm font-bold text-slate-600 block pl-1 group-focus-within:text-pertamina-blue transition-colors">Jenis
                                    BBM</label>
                                <select name="fuel_type_id"
                                    class="w-full h-12 px-4 rounded-xl input-glass outline-none text-slate-800 font-semibold appearance-none cursor-pointer border-slate-300"
                                    required>
                                    <option value="" disabled selected>Pilih Jenis BBM</option>
                                    @foreach($fuelTypes as $ft)
                                        <option value="{{ $ft->id }}">{{ $ft->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1.5 group">
                                <label
                                    class="text-sm font-bold text-slate-600 block pl-1 group-focus-within:text-pertamina-blue transition-colors">Volume
                                    Angkut (Liter)</label>
                                <div class="relative">
                                    <input type="number" name="volume_liter" placeholder="0"
                                        value="{{ old('volume_liter') }}"
                                        class="w-full h-12 pl-4 pr-16 rounded-xl input-glass outline-none text-slate-800 font-semibold text-right"
                                        required min="1" />
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 font-bold bg-slate-100 px-2 py-0.5 rounded">L</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Destination -->
                    <div class="pb-8 border-b border-slate-200/50 mb-8">
                        <div class="space-y-1.5 group max-w-lg">
                            <label
                                class="text-sm font-bold text-slate-600 block pl-1 group-focus-within:text-pertamina-blue transition-colors flex items-center gap-1">
                                <span class="material-symbols-outlined text-[18px] text-slate-400">location_on</span>
                                Tujuan Distribusi (SPBU/Depot)
                            </label>
                            <select name="spbu_id"
                                class="w-full h-12 px-4 rounded-xl input-glass outline-none text-slate-800 font-semibold appearance-none border-slate-300"
                                required>
                                <option value="" disabled selected>Pilih SPBU Tujuan</option>
                                @foreach($spbus as $spbu)
                                    <option value="{{ $spbu->id }}">{{ $spbu->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Submit Area -->
                    <div class="flex items-center justify-between gap-4">
                        <div
                            class="flex items-center gap-3 max-w-sm text-amber-600 bg-amber-50 px-4 py-3 rounded-xl border border-amber-200/50">
                            <span class="material-symbols-outlined shrink-0 text-amber-500">info</span>
                            <p class="text-[11px] font-medium leading-tight text-amber-700">Pastikan seluruh data sesuai
                                dengan manifest fisik sebelum disimpan ke dalam sistem internal.</p>
                        </div>
                        <button type="submit"
                            class="flex items-center gap-2 h-14 px-10 rounded-2xl bg-gradient-to-r from-pertamina-blue to-blue-600 hover:to-blue-500 text-white font-bold text-lg shadow-glow-blue hover:scale-105 transition-all">
                            <span class="material-symbols-outlined text-xl">save</span> Simpan Data
                        </button>
                    </div>
                </form>

            </div>
        </main>
    </div>
</body>

</html>