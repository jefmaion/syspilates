<?php

declare(strict_types = 1);

use App\Livewire\Registration\Actions\CancelRegistration;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CancelRegistration::class)
        ->assertStatus(200);
});
