<?php

declare(strict_types = 1);

use App\Livewire\Instructor\InstructorForm;
use App\Models\Instructor;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(InstructorForm::class)
        ->assertStatus(200);
});

it('should be able to validate required fields', function () {
    Livewire::test(InstructorForm::class)
        ->set('user.name', '')
        ->set('user.cpf', '')
        ->set('user.phone1', '')
        ->set('user.birthdate', '')
        ->call('store')
        ->assertHasErrors([
            'user.name'      => 'required',
            'user.cpf'       => 'required',
            'user.phone1'    => 'required',
            'user.birthdate' => 'required',
        ]);
});

it('should be able to create a instructor', function () {
    Livewire::test(InstructorForm::class)
        ->set('user.name', 'User Name')
        ->set('user.cpf', '5555')
        ->set('user.birthdate', '2010-10-10')
        ->set('user.phone1', '111')
        ->set('user.gender', 'M')
        ->set('form.profession', 'profession')
        ->call('store')
        ->assertHasNoErrors()
        ->assertDispatched('instructor-created');

    $user = User::where('name', 'User Name')->first();

    expect($user)->not()->toBeNull();

    $instructor = Instructor::where('user_id', $user->id)->first();
    expect($instructor)->not->toBeNull();
    expect($instructor->user_id)->toBe($user->id);
});

it('should be able to update a instructor', function () {
    $instructor = Instructor::factory()->create();

    $newName = 'New Name';

    Livewire::test(InstructorForm::class, ['instructor' => $instructor])
        ->set('user.name', $newName)
        ->set('form.profession', 'new profession')
        ->call('update')
        ->assertHasNoErrors()
        ->assertDispatched('instructor-updated');

    expect($instructor->refresh()->user->name)->toBe($newName);
});
