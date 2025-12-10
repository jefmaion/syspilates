<?php

declare(strict_types = 1);

use App\Livewire\Modality\CreateModality;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateModality::class)
        ->assertStatus(200);
});
