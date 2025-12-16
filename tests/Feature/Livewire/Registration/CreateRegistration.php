<?php

declare(strict_types = 1);

use App\Livewire\Registration\CreateRegistration;
use App\Models\Modality;
use App\Models\Registration;
use App\Models\Student;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateRegistration::class)
        ->assertStatus(200);
});

it('validate form', function () {
    Student::factory()->create();
    Modality::factory()->create();

    $registration = Registration::factory()->create();

    Livewire::test(CreateRegistration::class)
        ->set('form.modality_id', $registration->modality_id)
        ->set('form.student_id', $registration->student_id)
        ->call('create')
        ->assertHasErrors([
            'form.modality_id' => 'unique',
        ]);
});

it('should be able to create a registration', function () {
    $student  = Student::factory()->create();
    $modality = Modality::factory()->create();

    Livewire::test(CreateRegistration::class)
        ->set('form.modality_id', $modality->id)
        ->set('form.student_id', $student->id)
        ->call('create')
        ->assertHasNoErrors([
            'form.modality_id' => 'required',
            'form.student_id'  => 'required',
        ]);

    $registration = Registration::first();

    expect($registration->student_id)->toBe($student->id);
    expect($registration->modality_id)->toBe($modality->id);
});
