<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/superadmin/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('superadmin.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/operator/dashboard', function () {
        return view('operator.dashboard');
    })->name('operator.dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/operator/input-distribution', function () {
        return view('operator.input-distribution');
    })->name('operator.input-distribution');

    Route::get('/operator/history', function () {
        return view('operator.history');
    })->name('operator.history');
});

Route::middleware(['auth'])->group(function () {

 Route::get('/superadmin/qr-code-management', function () {
        return view('superadmin.qr-code-management');
    })->name('superadmin.qr-code-management');


    Route::get('/superadmin/users-management', function () {
        return view('superadmin.users-management');
    })->name('superadmin.users-management');

    Route::get('/superadmin/master-data', function () {
        return view('superadmin.master-data');
    })->name('superadmin.master-data');

    Route::get('/superadmin/audit-reports', function () {
        return view('superadmin.audit-reports');
    })->name('superadmin.audit-reports');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/distribution-data', function () {
        return view('admin.distribution-data');
    })->name('admin.distribution-data');

    Route::get('/admin/reports', function () {
        return view('admin.reports');
    })->name('admin.reports');

    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');
});
Route::prefix('operator')->name('operator.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('operator.dashboard'))->name('dashboard');
    Route::get('/input-distribution', fn() => view('operator.input-distribution'))->name('input-distribution');
    Route::get('/history', fn() => view('operator.history'))->name('history');
    Route::get('/profile', fn() => view('operator.profile'))->name('profile');
});



require __DIR__ . '/auth.php';
