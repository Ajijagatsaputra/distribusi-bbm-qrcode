<!DOCTYPE html>
<html class="light" lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pertamina - Driver Surat Jalan</title>
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
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-pertamina-blue/10 text-pertamina-blue font-bold transition-all relative group"
                        href="{{ route('operator.surat-jalan') }}">
                        <div
                            class="absolute left-0 top-1/2 -translate-y-1/2 w-1.5 h-8 bg-pertamina-blue rounded-r-full">
                        </div>
                        <span class="material-symbols-outlined">description</span>
                        <span class="text-sm">Surat Jalan</span>
                    </a>
                    <a class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-slate-500 hover:text-pertamina-blue hover:bg-white/50 dark:hover:bg-slate-800/50 font-medium transition-all group"
                        href="{{ route('operator.history') }}">
                        <span
                            class="material-symbols-outlined group-hover:scale-110 transition-transform">history</span>
                        <span class="text-sm">Riwayat Pengiriman</span>
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
            <div class="max-w-[1200px] mx-auto p-4 sm:p-6 lg:p-10 space-y-10">
                <!-- Top Header -->
                <header class="flex flex-col gap-2">
                    <h2
                        class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                        Daftar <span class="gradient-text">Surat Jalan Anda</span>
                    </h2>
                    <p class="text-slate-500 text-base font-medium">Pantau penugasan pengiriman BBM dan konfirmasi
                        selesai melalui scan QR Code di SPBU tujuan.</p>
                </header>

                {{-- NOTIFICATION TOAST --}}
                <div id="toastNotification"
                    class="fixed top-24 right-8 z-50 flex items-center gap-3 px-4 py-3 text-sm font-semibold text-white bg-slate-900 rounded-xl shadow-2xl transition-all transform translate-x-full opacity-0">
                    <span class="material-symbols-outlined text-pertamina-green">check_circle</span>
                    <span id="toastMessage">Konfirmasi Berhasil!</span>
                </div>

                {{-- ACTIVE ASSIGNMENT BANNER / SCANNER --}}
                @if($active)
                    <div
                        class="glass-panel p-8 rounded-[2rem] border border-white/50 shadow-glass bg-gradient-to-br from-white/90 to-slate-50/50">
                        <div class="flex flex-col lg:flex-row justify-between gap-8 items-start">
                            <div class="space-y-4 max-w-xl">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1 bg-amber-100 text-amber-800 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    @if($active->status === 'menunggu')
                                        Menunggu Verifikasi Depo
                                    @elseif($active->status === 'terverifikasi')
                                        Terverifikasi (Siap Berangkat)
                                    @elseif($active->status === 'dikirim')
                                        Dalam Perjalanan (Kirim)
                                    @else
                                        Status: {{ ucfirst($active->status) }}
                                    @endif
                                </span>
                                <h3 class="text-3xl font-extrabold text-slate-900">Tugas Aktif Hari Ini</h3>
                                <p class="text-sm font-semibold text-slate-500">Kode Surat Jalan: <span
                                        class="font-mono text-pertamina-blue font-bold">{{ $active->kode_surat_jalan }}</span>
                                </p>

                                <div class="grid grid-cols-2 gap-6 pt-4 border-t border-slate-200/50">
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold uppercase">SPBU Tujuan</p>
                                        <p class="text-base font-bold text-slate-800">{{ $active->spbu->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $active->spbu->location }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400 font-bold uppercase">Muatan BBM</p>
                                        <p class="text-base font-bold text-slate-800">{{ $active->fuelType->name }}</p>
                                        <p class="text-xs text-slate-500">{{ number_format($active->volume_liter) }} Liter
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- SCANNER ACTION AREA --}}
                            <div
                                class="w-full lg:w-96 glass-panel p-6 rounded-2xl border border-slate-200/50 bg-white flex flex-col items-center justify-center space-y-4">
                                @if($active->status === 'dikirim')
                                    <div class="text-center space-y-2">
                                        <span
                                            class="material-symbols-outlined text-pertamina-blue text-4xl animate-bounce">qr_code_scanner</span>
                                        <h4 class="font-bold text-slate-900">Bongkar BBM di SPBU</h4>
                                        <p class="text-xs text-slate-500">Pindai QR Code di SPBU untuk menyelesaikan pengiriman
                                        </p>
                                    </div>
                                    <button onclick="startScanner('{{ $active->id }}')"
                                        class="w-full h-12 bg-pertamina-blue hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-glow-blue flex items-center justify-center gap-2">
                                        <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                                        <span>Aktifkan Scanner</span>
                                    </button>
                                    <button onclick="openMockInput('{{ $active->id }}')"
                                        class="w-full text-xs text-slate-500 hover:text-pertamina-blue font-bold transition-all underline">
                                        Input Token Manual (Simulasi)
                                    </button>
                                @elseif($active->status === 'terverifikasi')
                                    <div class="text-center p-4 space-y-2">
                                        <span class="material-symbols-outlined text-amber-500 text-4xl">local_shipping</span>
                                        <h4 class="font-bold text-slate-900">Menunggu Lepas Kirim</h4>
                                        <p class="text-xs text-slate-500">Silakan hubungi Admin Depo untuk menandai
                                            keberangkatan Anda ke jalan.</p>
                                    </div>
                                @else
                                    <div class="text-center p-4 space-y-2">
                                        <span class="material-symbols-outlined text-amber-500 text-4xl">hourglass_empty</span>
                                        <h4 class="font-bold text-slate-900">Menunggu Verifikasi Depo</h4>
                                        <p class="text-xs text-slate-500">Tunjukkan Surat Jalan fisik kepada petugas Depo untuk
                                            diverifikasi.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="glass-panel p-6 rounded-2xl border border-white/50 text-center py-10 space-y-2">
                        <span class="material-symbols-outlined text-slate-300 text-5xl">task_alt</span>
                        <h3 class="text-lg font-bold text-slate-950">Semua Penugasan Selesai</h3>
                        <p class="text-sm text-slate-500">Tidak ada surat jalan aktif yang ditugaskan kepada Anda saat ini.
                        </p>
                    </div>
                @endif

                {{-- HISTORY TABEL --}}
                <div class="glass-panel rounded-3xl overflow-hidden shadow-glass border border-white/40">
                    <div class="p-6 border-b border-slate-200/50 bg-white/40">
                        <h3 class="text-xl font-bold text-slate-900">Riwayat Penugasan Surat Jalan</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">Kode
                                        SJ</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                        Tanggal</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">SPBU
                                        Tujuan</th>
                                    <th class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider">BBM
                                        & Volume</th>
                                    <th
                                        class="px-6 py-4 text-slate-500 text-xs font-bold uppercase tracking-wider text-center">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/50 bg-white/10">
                                @forelse($suratJalans as $sj)
                                    <tr class="hover:bg-white/60 transition-colors">
                                        <td class="px-6 py-4 font-mono font-bold text-slate-900">{{ $sj->kode_surat_jalan }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600">
                                            {{ \Carbon\Carbon::parse($sj->tanggal_kirim)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-slate-800">{{ $sj->spbu->name }}</div>
                                            <div class="text-xs text-slate-500">{{ $sj->spbu->location }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-slate-850">{{ $sj->fuelType->name }}</div>
                                            <div class="text-xs text-slate-500">{{ number_format($sj->volume_liter) }} Liter
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @php
                                                $color = $sj->statusColor();
                                                $label = $sj->statusLabel();
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1.5
                                                            @if($color === 'amber') bg-amber-100 text-amber-800
                                                            @elseif($color === 'blue') bg-blue-100 text-blue-800
                                                            @elseif($color === 'purple') bg-purple-100 text-purple-800
                                                            @elseif($color === 'green') bg-green-100 text-green-800
                                                            @else bg-red-100 text-red-800
                                                            @endif">
                                                <span class="w-1.5 h-1.5 rounded-full
                                                                @if($color === 'amber') bg-amber-500
                                                                @elseif($color === 'blue') bg-blue-500
                                                                @elseif($color === 'purple') bg-purple-500
                                                                @elseif($color === 'green') bg-green-500
                                                                @else bg-red-500
                                                                @endif"></span>
                                                {{ $label }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-12 text-slate-400 font-medium">Belum ada
                                            riwayat surat jalan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- CAMERA SCANNER MODAL --}}
    <div id="scannerModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="closeScanner()"></div>
            <div class="relative w-full max-w-md bg-white rounded-3xl p-6 shadow-2xl z-10 space-y-4">
                <div class="flex items-center justify-between border-b pb-4">
                    <h3 class="text-lg font-bold text-slate-900">Scan QR Code SPBU</h3>
                    <button onclick="closeScanner()" class="p-1 hover:bg-slate-100 rounded-lg"><span
                            class="material-symbols-outlined">close</span></button>
                </div>
                <div id="reader" class="overflow-hidden rounded-2xl bg-black aspect-square w-full"></div>
                <p class="text-xs text-slate-500 text-center">Arahkan kamera ke QR Code bukti bongkar SPBU yang
                    diberikan petugas setempat.</p>
            </div>
        </div>
    </div>

    {{-- MOCK INPUT MODAL --}}
    <div id="mockModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="closeMockInput()"></div>
            <div class="relative w-full max-w-md bg-white rounded-3xl p-6 shadow-2xl z-10 space-y-4">
                <div class="flex items-center justify-between border-b pb-4">
                    <h3 class="text-lg font-bold text-slate-900">Simulasi / Token Manual</h3>
                    <button onclick="closeMockInput()" class="p-1 hover:bg-slate-100 rounded-lg"><span
                            class="material-symbols-outlined">close</span></button>
                </div>
                <div class="space-y-3">
                    <label class="text-sm font-bold text-slate-700 block">Masukkan Token UUID QR Code</label>
                    <input type="text" id="mock_token" placeholder="Cth: 550e8400-e29b-41d4-a716-446655440000"
                        class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-slate-800 font-semibold" />
                    <p class="text-xs text-slate-400">Anda dapat melihat daftar token aktif di menu QR Code Management
                        Admin Depo.</p>
                </div>
                <button onclick="submitMockToken()"
                    class="w-full h-12 bg-pertamina-blue hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-glow-blue flex items-center justify-center">
                    Submit Token
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        let html5QrcodeScanner = null;
        let activeSjId = null;

        function showToast(message) {
            const toast = document.getElementById('toastNotification');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('translate-x-full', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
            }, 3000);
        }

        function startScanner(sjId) {
            activeSjId = sjId;
            document.getElementById('scannerModal').classList.remove('hidden');

            html5QrcodeScanner = new Html5Qrcode("reader");
            html5QrcodeScanner.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: { width: 250, height: 250 } },
                onScanSuccess,
                onScanFailure
            ).catch(err => {
                console.error("Camera fail: ", err);
                alert("Gagal mengakses kamera. Silakan gunakan metode input manual.");
                closeScanner();
            });
        }

        function closeScanner() {
            document.getElementById('scannerModal').classList.add('hidden');
            if (html5QrcodeScanner) {
                html5QrcodeScanner.stop().then(() => {
                    html5QrcodeScanner = null;
                }).catch(err => console.error(err));
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
            closeScanner();
            verifyToken(decodedText);
        }

        function onScanFailure(error) {
            // Quietly retry
        }

        function openMockInput(sjId) {
            activeSjId = sjId;
            document.getElementById('mockModal').classList.remove('hidden');
        }

        function closeMockInput() {
            document.getElementById('mockModal').classList.add('hidden');
        }

        function submitMockToken() {
            const token = document.getElementById('mock_token').value.trim();
            if (!token) {
                alert('Harap masukkan token!');
                return;
            }
            closeMockInput();
            verifyToken(token);
        }

        function verifyToken(token) {
            fetch(`/operator/surat-jalan/${activeSjId}/complete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify({ token: token })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        showToast('Pengiriman Sukses Dikonfirmasi!');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        alert('Gagal: ' + data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Error memproses request.');
                });
        }

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
    </script>
</body>

</html>