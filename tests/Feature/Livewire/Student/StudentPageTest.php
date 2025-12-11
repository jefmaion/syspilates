<?php

declare(strict_types = 1);

use App\Livewire\Student\StudentPage;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('renders successfully', function () {
    Livewire::test(StudentPage::class)
        ->assertStatus(200);
});

it('route exists', function () {
    actingAs(User::factory()->create());

    $this->get(route('student'))->assertStatus(200);
});
