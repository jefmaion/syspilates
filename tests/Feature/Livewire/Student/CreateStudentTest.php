<?php

declare(strict_types = 1);

use App\Livewire\Student\CreateStudent;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('render studentc class successfully', function () {
    Livewire::test(CreateStudent::class)
        ->assertStatus(200);
});

it('should be name required', function () {
    Livewire::test(CreateStudent::class)
        ->set('user.name', '')
        ->call('save')
        ->assertHasErrors(['user.name' => 'required']);
});

it('should be birthdate required', function () {
    Livewire::test(CreateStudent::class)
        ->set('user.birthdate', '')
        ->call('save')
        ->assertHasErrors(['user.birthdate' => 'required']);
});

it('should be birthdate is a valid date', function () {
    Livewire::test(CreateStudent::class)
        ->set('user.birthdate', 'asd')
        ->call('save')
        ->assertHasErrors(['user.birthdate' => 'date']);
});

it('should be able to create a student', function () {
    Livewire::test(CreateStudent::class)
        ->set('user.name', 'Jefferson')
        ->set('user.email', 'testedeemail@teste.com')
        ->set('user.birthdate', fake()->date())
        ->set('user.gender', 'M')
        ->set('user.cpf', fake()->randomDigit())
        ->set('user.phone1', '123')
        ->set('form.profession', 'Driver')
        ->call('save')
        ->assertDispatched('student-created');

    $user = User::where('email', 'testedeemail@teste.com')->first();

    expect($user)->not()->toBeNull();
    expect($user->name)->toBe('Jefferson');

    $student = Student::where('user_id', $user->id)->first();
    expect($student)->not->toBeNull();
    expect($student->user_id)->toBe($user->id);
});
