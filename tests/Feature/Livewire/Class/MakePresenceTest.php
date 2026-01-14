<?php

declare(strict_types = 1);

use App\Livewire\Class\MakePresence;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(MakePresence::class)
        ->assertStatus(200);
});
