<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PermitController;
use Illuminate\Support\Facades\Route;

// Public Verification Page for QR Code
Route::get('/verify/{token}', [PermitController::class, 'verifyQr'])->name('verify.qr');

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [PermitController::class, 'dashboard'])->name('dashboard');
    
    // Submissions
    Route::get('/permit/create', [PermitController::class, 'create'])->name('permit.create');
    Route::post('/permit/store', [PermitController::class, 'store'])->name('permit.store');
    Route::get('/permit/{id}', [PermitController::class, 'show'])->name('permit.show');
    
    // Admin Management
    Route::post('/admin/students/add', [PermitController::class, 'addStudent'])->name('admin.add_student');
    Route::post('/admin/teachers/add', [PermitController::class, 'addTeacher'])->name('admin.add_teacher');

    // Actions
    Route::post('/permit/{id}/admin-verify', [PermitController::class, 'verifyAdmin'])->name('permit.admin_verify');
    Route::post('/permit/{id}/walas-approve', [PermitController::class, 'approveWalas'])->name('permit.walas_approve');
    
    // Digital Letter Print
    Route::get('/permit/{id}/print', [PermitController::class, 'printDigital'])->name('permit.print');
});
