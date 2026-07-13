@extends('layouts.spbu')

@section('title', 'Verifikasi Penerimaan Barcode')

@section('content')
<div class="animate-slide-in max-w-4xl mx-auto space-y-8">
    {{-- HEADER --}}
    <div>
        <h2 class="mb-2 text-3xl font-black tracking-tight text-slate-900 dark:text-white">
            Verifikasi <span class="text-pertamina-blue">Penerimaan</span>
        </h2>
        <p class="text-sm text-slate-650 dark:text-slate-400">
            Scan barcode/QR code Surat Jalan yang dibawa driver untuk memverifikasi kedatangan dan menyelesaikan
            pengiriman.
        </p>
    </div>

    {{-- SCAN AREA CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
        {{-- INPUT SECTION --}}
        <div
            class="md:col-span-3 p-8 bg-white border border-slate-200/50 rounded-2xl dark:bg-slate-900/70 dark:border-slate-800 shadow-glass flex flex-col justify-between min-h-[380px]">
            <div class="space-y-6">
                <div class="flex items-center gap-3.5">
                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-pertamina-blue to-blue-600 shadow-glow-blue text-white animate-pulse">
                        <span class="material-symbols-outlined text-2xl">qr_code_scanner</span>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-slate-900 dark:text-white">Pemindai Surat Jalan</h3>
                        <p class="text-xs text-slate-500 font-medium">Input/Scan kode barcode di bawah ini</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <input type="text" id="barcodeInput" autocomplete="off"
                                placeholder="Pindai atau masukkan nomor Surat Jalan..."
                                class="w-full px-6 py-4 pl-12 text-lg font-bold font-mono tracking-wider transition-all border outline-none rounded-2xl border-slate-300 dark:border-slate-700 dark:bg-slate-850 text-slate-900 dark:text-white focus:border-pertamina-blue focus:ring-4 focus:ring-pertamina-blue/20"
                                onkeydown="if(event.key === 'Enter') processBarcode()">
                            <span
                                class="absolute -translate-y-1/2 text-2xl text-slate-400 left-4 top-1/2 material-symbols-outlined">barcode_scanner</span>
                        </div>
                        <button type="button" onclick="startScanner()"
                            class="px-5 rounded-2xl bg-amber-500 hover:bg-amber-600 text-white font-bold transition-all shadow-md flex items-center justify-center gap-1.5 outline-none shrink-0"
                            title="Scan via Kamera">
                            <span class="material-symbols-outlined text-2xl">photo_camera</span>
                            <span class="hidden sm:inline text-sm">Scan Kamera</span>
                        </button>
                    </div>

                    <button type="button" onclick="processBarcode()"
                        class="w-full flex items-center justify-center gap-2 py-4 rounded-xl bg-gradient-to-r from-pertamina-blue to-blue-700 text-white font-bold transition-all shadow-lg hover:scale-102 shadow-glow-blue outline-none">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        Verifikasi Kode
                    </button>
                </div>
            </div>

            <div
                class="mt-8 p-4 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-slate-100 dark:border-slate-800">
                <div class="flex items-start gap-2.5">
                    <span class="material-symbols-outlined text-[18px] text-pertamina-blue mt-0.5">info</span>
                    <p class="text-[11px] font-semibold text-slate-500 dark:text-slate-400 leading-relaxed">
                        <strong>Tips:</strong> Jika menggunakan hand-scanner, posisikan kursor input di kolom di atas,
                        lalu scan barcode driver. Input akan otomatis terproses setelah barcode dibaca.
                    </p>
                </div>
            </div>
        </div>

        {{-- STATUS & INFO SECTION --}}
        <div class="md:col-span-2 space-y-6">
            <div id="scanFeedback"
                class="p-8 bg-slate-50 border border-dashed border-slate-350 rounded-2xl dark:bg-slate-900/30 dark:border-slate-800 flex flex-col items-center justify-center text-center min-h-[380px] transition-all duration-300">
                <div id="idleState" class="space-y-4">
                    <div
                        class="flex items-center justify-center mx-auto size-20 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-400">
                        <span class="text-4xl material-symbols-outlined">hourglass_empty</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-700 dark:text-slate-300">Menunggu Pemindaian</h4>
                        <p class="text-xs text-slate-500 mt-1 max-w-[200px] mx-auto font-medium">Lakukan scan Surat
                            Jalan driver untuk melihat informasi detail di sini</p>
                    </div>
                </div>

                <div id="loadingState" class="hidden space-y-4">
                    <div
                        class="animate-spin rounded-full h-12 w-12 border-4 border-pertamina-blue border-t-transparent mx-auto">
                    </div>
                    <p class="text-sm text-slate-500 font-bold">Memverifikasi kode...</p>
                </div>

                <div id="successState" class="hidden space-y-6 w-full">
                    <div
                        class="flex items-center justify-center mx-auto size-16 rounded-full bg-pertamina-green/10 text-pertamina-green">
                        <span class="text-3xl material-symbols-outlined">check_circle</span>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 dark:text-white text-lg">Penerimaan Berhasil!</h4>
                        <p id="successMessage" class="text-xs text-slate-500 mt-1 font-semibold"></p>
                    </div>

                    <div
                        class="p-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700/50 text-left text-xs space-y-2">
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">No. Surat
                                Jalan</span><span class="font-bold font-mono text-slate-900 dark:text-white"
                                id="resCode">-</span></div>
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">Nama
                                Driver</span><span class="font-bold text-slate-900 dark:text-white"
                                id="resDriver">-</span></div>
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">Jenis
                                BBM</span><span class="font-bold text-slate-900 dark:text-white" id="resFuel">-</span>
                        </div>
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">Volume</span><span
                                class="font-bold text-slate-900 dark:text-white" id="resVolume">-</span></div>
                        <div class="flex justify-between font-semibold"><span class="text-slate-400">No.
                                Kendaraan</span><span class="font-bold text-slate-900 dark:text-white"
                                id="resPlate">-</span></div>
                    </div>
                </div>

                <div id="errorState" class="hidden space-y-4">
                    <div
                        class="flex items-center justify-center mx-auto size-16 rounded-full bg-pertamina-red/10 text-pertamina-red">
                        <span class="text-3xl material-symbols-outlined">error</span>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-900 dark:text-white text-lg">Verifikasi Gagal</h4>
                        <p id="errorMessage" class="text-xs text-slate-500 mt-1 font-semibold max-w-[220px] mx-auto">
                        </p>
                    </div>
                    <button type="button" onclick="resetScanner()"
                        class="px-4 py-2 text-xs font-bold text-slate-700 bg-white border border-slate-200 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-350 rounded-lg hover:bg-slate-50">
                        Coba Lagi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CAMERA SCANNER MODAL --}}
<div id="scannerModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm" onclick="closeScanner()"></div>
        <div
            class="relative w-full max-w-md bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-2xl z-10 space-y-4 border border-slate-200 dark:border-slate-800">
            <div class="flex items-center justify-between border-b border-slate-250 dark:border-slate-800 pb-4">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Scan Barcode / QR Surat Jalan</h3>
                <button onclick="closeScanner()" class="p-1 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg"><span
                        class="material-symbols-outlined text-slate-500">close</span></button>
            </div>
            <div id="reader" class="overflow-hidden rounded-2xl bg-black aspect-square w-full"></div>
            <p class="text-xs text-slate-500 text-center">Arahkan kamera ke QR Code / Barcode Surat Jalan yang
                ditunjukkan oleh Driver.</p>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        window.onload = function () {
            document.getElementById('barcodeInput').focus();
        };

        let html5QrcodeScanner = null;

        function startScanner() {
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
            document.getElementById('barcodeInput').value = decodedText;
            processBarcode();
        }

        function onScanFailure(error) {
            // Quietly retry
        }

        function resetScanner() {
            document.getElementById('barcodeInput').value = '';
            document.getElementById('barcodeInput').focus();

            document.getElementById('idleState').classList.remove('hidden');
            document.getElementById('loadingState').classList.add('hidden');
            document.getElementById('successState').classList.add('hidden');
            document.getElementById('errorState').classList.add('hidden');

            const feedback = document.getElementById('scanFeedback');
            feedback.className = "p-8 bg-slate-50 border border-dashed border-slate-350 rounded-2xl dark:bg-slate-900/30 dark:border-slate-800 flex flex-col items-center justify-center text-center min-h-[380px] transition-all duration-300";
        }

        function processBarcode() {
            const input = document.getElementById('barcodeInput');
            const code = input.value.trim();

            if (!code) {
                input.focus();
                return;
            }

            // Show loading state
            document.getElementById('idleState').classList.add('hidden');
            document.getElementById('loadingState').classList.remove('hidden');
            document.getElementById('successState').classList.add('hidden');
            document.getElementById('errorState').classList.add('hidden');

            fetch("{{ route('spbu.verify.submit') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ barcode: code })
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loadingState').classList.add('hidden');
                    const feedback = document.getElementById('scanFeedback');

                    if (data.success) {
                        // Success
                        document.getElementById('successState').classList.remove('hidden');
                        document.getElementById('successMessage').textContent = data.message;

                        document.getElementById('resCode').textContent = data.data.kode_surat_jalan;
                        document.getElementById('resDriver').textContent = data.data.driver;
                        document.getElementById('resFuel').textContent = data.data.fuel_type;
                        document.getElementById('resVolume').textContent = Number(data.data.volume).toLocaleString('id-ID') + ' L';
                        document.getElementById('resPlate').textContent = data.data.vehicle_plate;

                        feedback.className = "p-8 bg-emerald-50/50 border border-emerald-300 rounded-2xl dark:bg-emerald-950/10 dark:border-emerald-800/50 flex flex-col items-center justify-center text-center min-h-[380px] transition-all duration-300";

                        // Clear input after a short delay
                        setTimeout(() => {
                            input.value = '';
                        }, 1000);
                    } else {
                        // Failure
                        document.getElementById('errorState').classList.remove('hidden');
                        document.getElementById('errorMessage').textContent = data.message;
                        feedback.className = "p-8 bg-red-50/50 border border-red-300 rounded-2xl dark:bg-red-950/10 dark:border-red-800/50 flex flex-col items-center justify-center text-center min-h-[380px] transition-all duration-300";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loadingState').classList.add('hidden');
                    document.getElementById('errorState').classList.remove('hidden');
                    document.getElementById('errorMessage').textContent = "Terjadi kegagalan koneksi atau server error.";

                    const feedback = document.getElementById('scanFeedback');
                    feedback.className = "p-8 bg-red-50/50 border border-red-300 rounded-2xl dark:bg-red-950/10 dark:border-red-800/50 flex flex-col items-center justify-center text-center min-h-[380px] transition-all duration-300";
                });
        }
    </script>
@endpush