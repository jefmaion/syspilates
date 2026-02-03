<?php

declare(strict_types = 1);

use App\Livewire\Calendar\CalendarPage;
use App\Livewire\Dashboard;
use App\Livewire\Instructor\InstructorForm;
use App\Livewire\Instructor\InstructorPage;
use App\Livewire\Instructor\InstructorShow;
use App\Livewire\Modality\CreateModality;
use App\Livewire\Modality\ModalityPage;
use App\Livewire\Modality\UpdateModality;
use App\Livewire\Profile;
use App\Livewire\Registration\CreateRegistration;
use App\Livewire\Registration\RegistrationPage;
use App\Livewire\Registration\RegistrationShow;
use App\Livewire\Student\StudentForm;
use App\Livewire\Student\StudentPage;
use App\Livewire\Student\StudentShow;
use App\Livewire\Transaction\TransactionPage;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
    Route::get('modality', ModalityPage::class)->name('modality');
    Route::get('modality/create', CreateModality::class)->name('modality.create');
    Route::get('modality/{modality}/edit', UpdateModality::class)->name('modality.edit');

    Route::get('student', StudentPage::class)->name('student');
    Route::get('student/create', StudentForm::class)->name('student.create');
    Route::get('student/{student}/edit', StudentForm::class)->name('student.edit');
    Route::get('student/{student}/show', StudentShow::class)->name('student.show');

    Route::get('instructor', InstructorPage::class)->name('instructor');
    Route::get('instructor/create', InstructorForm::class)->name('instructor.create');
    Route::get('instructor/{instructor}/edit', InstructorForm::class)->name('instructor.edit');
    Route::get('instructor/{instructor}/show', InstructorShow::class)->name('instructor.show');

    Route::get('registration', RegistrationPage::class)->name('registration');
    Route::get('registration/create', CreateRegistration::class)->name('registration.create');
    Route::get('registration/{registration}/show', RegistrationShow::class)->name('registration.show');

    Route::get('transaction', TransactionPage::class)->name('transaction');

    Route::get('calendar', CalendarPage::class)->name('calendar');
    Route::get('calendar/events', [CalendarPage::class, 'events'])->name('events');

    // Route::get('instructor', InstructorPage::class)->name('instructor');
    // Route::get('instructor/create', CreateInstructor::class)->name('instructor.create');
    // Route::get('instructor/{instructor}/edit', UpdateInstructor::class)->name('instructor.edit');

    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('profile', Profile::class)->name('profile');
});

require __DIR__ . '/auth.php';
