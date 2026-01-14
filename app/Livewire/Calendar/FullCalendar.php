<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use Closure;
use Illuminate\View\View;
use Livewire\Component;

class FullCalendar extends Component
{
    public $id;

    public $events;

    public $endpoint = null;

    // #[On('')]
    // public function setEvents() {
    //     $this->dispatch('calendar-set-events', events: $this->events);
    // }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.full-calendar');
    }
}
