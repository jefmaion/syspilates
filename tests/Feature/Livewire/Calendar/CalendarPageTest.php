<?php

declare(strict_types = 1);

use App\Livewire\Calendar\CalendarPage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CalendarPage::class)
        ->assertStatus(200);
});
