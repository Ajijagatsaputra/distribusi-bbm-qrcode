<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

// ─── Root → redirect to login ───────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('login'));

// ─── SUPERADMIN ──────────────────────────────────────────────────────────────
Route::prefix('superadmin')->name('superadmin.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DistributionController::class, 'superadminDashboard'])->name('dashboard');

    // Users management
    Route::get('/users-management', [UserController::class, 'index'])->name('users-management');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Master Data
    Route::get('/master-data', [MasterDataController::class, 'index'])->name('master-data');

    // Master BBM (Fuel Types)
    Route::post('/master-data/fuel', [MasterDataController::class, 'storeFuel'])->name('master-data.fuel.store');
    Route::put('/master-data/fuel/{fuelType}', [MasterDataController::class, 'updateFuel'])->name('master-data.fuel.update');
    Route::delete('/master-data/fuel/{fuelType}', [MasterDataController::class, 'destroyFuel'])->name('master-data.fuel.destroy');

    // Master Armada (Vehicle Types)
    Route::post('/master-data/vehicle', [MasterDataController::class, 'storeVehicle'])->name('master-data.vehicle.store');
    Route::put('/master-data/vehicle/{vehicleType}', [MasterDataController::class, 'updateVehicle'])->name('master-data.vehicle.update');
    Route::delete('/master-data/vehicle/{vehicleType}', [MasterDataController::class, 'destroyVehicle'])->name('master-data.vehicle.destroy');

    // Master SPBU
    Route::post('/master-data/spbu', [MasterDataController::class, 'storeSpbu'])->name('master-data.spbu.store');
    Route::put('/master-data/spbu/{spbu}', [MasterDataController::class, 'updateSpbu'])->name('master-data.spbu.update');
    Route::delete('/master-data/spbu/{spbu}', [MasterDataController::class, 'destroySpbu'])->name('master-data.spbu.destroy');

    // Live Monitoring & Audit Reports
    Route::get('/live-monitoring', [DistributionController::class, 'liveMonitoring'])->name('live-monitoring');
    Route::get('/audit-reports', [DistributionController::class, 'auditReports'])->name('audit-reports');
    Route::get('/forecasting', [DistributionController::class, 'forecasting'])->name('forecasting');
    Route::post('/forecasting/ai-analysis', [DistributionController::class, 'generateAiAnalysis'])->name('forecasting.ai-analysis');

    // Surat Jalan Management (Admin Pusat)
    Route::get('/surat-jalan', [SuratJalanController::class, 'index'])->name('surat-jalan.index');
    Route::get('/surat-jalan/create', [SuratJalanController::class, 'create'])->name('surat-jalan.create');
    Route::post('/surat-jalan', [SuratJalanController::class, 'store'])->name('surat-jalan.store');
    Route::patch('/surat-jalan/{suratJalan}/cancel', [SuratJalanController::class, 'destroy'])->name('surat-jalan.cancel');

    // SPBU Orders Management (Admin Pusat)
    Route::get('/orders', [PesananController::class, 'superadminIndex'])->name('orders.index');
    Route::patch('/orders/{pesanan}/reject', [PesananController::class, 'superadminReject'])->name('orders.reject');
});

// ─── ADMIN DEPO ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DistributionController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/distribution-data', [DistributionController::class, 'adminIndex'])->name('distribution-data');
    Route::get('/reports', [DistributionController::class, 'auditReports'])->name('reports');
    Route::get('/forecasting', [DistributionController::class, 'forecasting'])->name('forecasting');
    Route::post('/forecasting/ai-analysis', [DistributionController::class, 'generateAiAnalysis'])->name('forecasting.ai-analysis');
    Route::get('/profile', fn() => view('admin.profile'))->name('profile');

    // Verifikasi Surat Jalan (Admin Depo)
    Route::get('/verifikasi', [SuratJalanController::class, 'depoIndex'])->name('verifikasi');
    Route::patch('/surat-jalan/{suratJalan}/verify', [SuratJalanController::class, 'verify'])->name('surat-jalan.verify');
    Route::patch('/surat-jalan/{suratJalan}/dikirim', [SuratJalanController::class, 'markDikirim'])->name('surat-jalan.dikirim');

    // Input Distribusi & QR (Admin Depo)
    Route::get('/input-distribusi', [DistributionController::class, 'create'])->name('input-distribusi');
    Route::post('/distributions', [DistributionController::class, 'store'])->name('distributions.store');
    Route::get('/qr-management', [QrCodeController::class, 'index'])->name('qr-management');
    Route::post('/qr-codes', [QrCodeController::class, 'store'])->name('qr-codes.store');
    Route::patch('/qr-codes/{qrCode}', [QrCodeController::class, 'update'])->name('qr-codes.update');
    Route::delete('/qr-codes/{qrCode}', [QrCodeController::class, 'destroy'])->name('qr-codes.destroy');
});

// ─── DRIVER (Operator) ───────────────────────────────────────────────────────
Route::prefix('operator')->name('operator.')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DistributionController::class, 'operatorDashboard'])->name('dashboard');

    // Surat Jalan milik driver sendiri
    Route::get('/surat-jalan', [SuratJalanController::class, 'driverIndex'])->name('surat-jalan');
    Route::post('/surat-jalan/{suratJalan}/complete', [SuratJalanController::class, 'completeByDriver'])->name('surat-jalan.complete');

    // History distribusi milik driver sendiri
    Route::get('/history', [DistributionController::class, 'history'])->name('history');
    Route::get('/profile', fn() => view('operator.profile'))->name('profile');
});

// ─── ADMIN SPBU ──────────────────────────────────────────────────────────────
Route::prefix('spbu')->name('spbu.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PesananController::class, 'dashboard'])->name('dashboard');
    Route::get('/orders', [PesananController::class, 'index'])->name('orders.index');
    Route::post('/orders', [PesananController::class, 'store'])->name('orders.store');
    Route::get('/verify', [PesananController::class, 'showScanPage'])->name('verify.scan');
    Route::post('/verify/submit', [PesananController::class, 'verifyBarcode'])->name('verify.submit');
});

// ─── QR VALIDATE (JSON) ──────────────────────────────────────────────────────
Route::post('/qr/validate', [QrCodeController::class, 'validateQr'])
    ->middleware('auth')
    ->name('qr.validate');

// ─── PROFILE ─────────────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
