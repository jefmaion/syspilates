<?php

declare(strict_types = 1);

use App\Livewire\Instructor\InstructorPage;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('renders successfully', function () {
    Livewire::test(InstructorPage::class)
        ->assertStatus(200);
});

it('route exists', function () {
    actingAs(User::factory()->create());

    $this->get(route('instructor'))->assertStatus(200);
});
