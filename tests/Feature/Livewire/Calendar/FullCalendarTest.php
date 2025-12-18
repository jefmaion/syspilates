<?php

declare(strict_types = 1);

use App\Livewire\Calendar\FullCalendar;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(FullCalendar::class)
        ->assertStatus(200);
});
