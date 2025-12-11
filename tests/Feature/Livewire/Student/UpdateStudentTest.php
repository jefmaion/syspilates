<?php

declare(strict_types = 1);

use App\Livewire\Student\UpdateStudent;
use App\Models\Student;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(UpdateStudent::class)
        ->assertStatus(200);
});

it('should be render a component', function () {
    $student = Student::factory()->create();
    Livewire::test(UpdateStudent::class, ['student' => $student])->assertStatus(200);
});

it('should be load and fill forms', function () {
    $student = Student::factory()->create();

    Livewire::test(UpdateStudent::class)
        ->call('select', $student)
        ->assertSet('user.name', $student->user->name)
        ->assertSet('user.birthdate', $student->user->birthdate->format('Y-m-d'))
        ->assertSet('form.profession', $student->profession)
        ->assertSet('form.objective', $student->objective);
});

it('should be update a user name', function () {
    $student = Student::factory()->create();
    $name    = $student->user->name;

    Livewire::test(UpdateStudent::class)
        ->call('select', $student)
        ->set('user.name', 'Novo Nome')
        ->call('save')
        ->assertDispatched('student-updated');

    expect($student->refresh()->user->name)->not->toBe($name);
});

it('should be update a student profession', function () {
    $student    = Student::factory()->create();
    $profession = $student->profession;

    Livewire::test(UpdateStudent::class)
        ->call('select', $student)
        ->set('form.profession', 'New Profession')
        ->call('save')
        ->assertDispatched('student-updated');

    expect($student->refresh()->profession)->not->toBe($profession);
});

it('should be validate a change with a existing data', function () {
    $student1 = Student::factory()->create();
    $student2 = Student::factory()->create();

    Livewire::test(UpdateStudent::class)
        ->call('select', $student1)
        ->set('user.cpf', $student2->user->cpf)
        ->call('save')
        ->assertHasErrors(['user.cpf' => 'unique']);
});
