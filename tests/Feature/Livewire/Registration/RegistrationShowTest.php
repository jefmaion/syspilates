<?php

declare(strict_types = 1);

use App\Livewire\Registration\RegistrationShow;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(RegistrationShow::class)
        ->assertStatus(200);
});
