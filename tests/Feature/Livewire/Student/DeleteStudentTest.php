<?php

declare(strict_types = 1);

use App\Livewire\Student\DeleteStudent;
use App\Models\Student;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(DeleteStudent::class)
        ->assertStatus(200);
});

it('should be able to delete a student', function () {
    $student = Student::factory()->create();

    $user = $student->user;

    Livewire::test(DeleteStudent::class)
        ->call('select', $student)
        ->call('delete')
        ->assertDispatched('student-deleted');

    expect(Student::where('id', $student->id)->first())->toBeNull();
    expect(User::where('id', $user->id)->first())->toBeNull();
});
