<?php

use Illuminate\Support\Facades\Route;
use App\Models\Portfolio;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPortfolioController;
use App\Http\Controllers\ChatController; // <-- TAMBAHAN 1: Memanggil ChatController


// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', function () {
    $portfolios = Portfolio::with('galleries')->get();
    return view('welcome', compact('portfolios'));
});

// <-- TAMBAHAN 2: Membuka jalur untuk menerima pesan dari kotak chat
Route::post('/chat', [ChatController::class, 'sendMessage']); 


// ==========================================
// ADMIN AUTH ROUTES
// ==========================================
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// ==========================================
// ADMIN PANEL ROUTES (Protected by auth)
// ==========================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Portofolio CRUD
    Route::resource('portfolios', AdminPortfolioController::class)->except(['show']);

    // Hapus item gallery individual
    Route::delete('galleries/{gallery}', [AdminPortfolioController::class, 'destroyGallery'])->name('galleries.destroy');
});