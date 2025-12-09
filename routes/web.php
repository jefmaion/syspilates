<?php

declare(strict_types = 1);

use App\Livewire\Dashboard;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('profile', Profile::class)->name('profile');
});

require __DIR__ . '/auth.php';
