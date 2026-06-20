<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\CompanyController; // <-- NAYA: Company Controller add kiya
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Default dashboard route ko modify karke apna Controller laga diya
Route::get('/dashboard', [ShortUrlController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Breeze ke default Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Hamare project ke naye routes
    Route::post('/urls', [ShortUrlController::class, 'store'])->name('urls.store');
    Route::post('/invite', [InvitationController::class, 'store'])->name('invite');
    
    // <-- NAYA ROUTE: Company create karne ke liye -->
    Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
});

// Breeze ke saare login/register routes
require __DIR__.'/auth.php';

// SABSE LAST MEIN: The resolvable URL Route
Route::get('/{short_code}', [ShortUrlController::class, 'redirect'])
    ->name('urls.redirect');