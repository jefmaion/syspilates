<?php

declare(strict_types = 1);

use App\Livewire\Student\StudentShow;
use App\Models\Student;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('renders successfully', function () {
    Livewire::test(StudentShow::class)
        ->assertStatus(200);
});

it('should be route defined', function () {
    actingAs(User::factory()->create());

    $student = Student::factory()->create();
    $this->get(route('student.show', $student))
        ->assertOk();
});
