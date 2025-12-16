<?php

declare(strict_types = 1);

use App\Livewire\Registration\RegistrationPage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(RegistrationPage::class)
        ->assertStatus(200);
});
