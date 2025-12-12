<?php

declare(strict_types = 1);

use App\Livewire\Student\StudentForm;
use App\Models\Student;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(StudentForm::class)
        ->assertStatus(200);
});

it('should be able to validate required fields', function () {
    Livewire::test(StudentForm::class)
        ->set('user.name', '')
        ->set('user.cpf', '')
        ->set('user.phone1', '')
        ->set('user.birthdate', '')
        ->call('create')
        ->assertHasErrors([
            'user.name'      => 'required',
            'user.cpf'       => 'required',
            'user.phone1'    => 'required',
            'user.birthdate' => 'required',
        ]);
});

it('should be able to create a student', function () {
    Livewire::test(StudentForm::class)
        ->set('user.name', 'User Name')
        ->set('user.cpf', '5555')
        ->set('user.birthdate', '2010-10-10')
        ->set('user.phone1', '111')
        ->set('form.profession', 'profession')
        ->call('create')
        ->assertHasNoErrors()
        ->assertRedirect('/student');

    $user = User::where('name', 'User Name')->first();

    expect($user)->not()->toBeNull();

    $student = Student::where('user_id', $user->id)->first();
    expect($student)->not->toBeNull();
    expect($student->user_id)->toBe($user->id);
});

it('should be able to update a student', function () {
    $student = Student::factory()->create();

    $newName = 'New Name';

    Livewire::test(StudentForm::class, ['student' => $student])
        ->set('user.name', $newName)
        ->set('form.profession', 'new profession')
        ->call('update')
        ->assertHasNoErrors()
        ->assertRedirect('/student');

    expect($student->refresh()->user->name)->toBe($newName);
});
