<?php

declare(strict_types = 1);

use App\Livewire\Instructor\InstructorShow;
use App\Models\Instructor;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('renders successfully', function () {
    $instructor = Instructor::factory()->create();

    Livewire::test(InstructorShow::class, ['instructor' => $instructor])
        ->assertStatus(200);
});

it('should be route defined', function () {
    actingAs(User::factory()->create());

    $instructor = Instructor::factory()->create();
    $this->get(route('instructor.show', $instructor))
        ->assertOk();
});
