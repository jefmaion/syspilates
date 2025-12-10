<?php

declare(strict_types = 1);

use App\Livewire\Dashboard;
use App\Livewire\Modality\CreateModality;
use App\Livewire\Modality\ModalityPage;
use App\Livewire\Modality\UpdateModality;
use App\Livewire\Profile;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
    Route::get('modality', ModalityPage::class)->name('modality');
    Route::get('modality/create', CreateModality::class)->name('modality.create');
    Route::get('modality/{modality}/edit', UpdateModality::class)->name('modality.edit');

    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('profile', Profile::class)->name('profile');
});

require __DIR__ . '/auth.php';
