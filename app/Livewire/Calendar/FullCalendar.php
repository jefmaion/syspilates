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

    public $config = [
        'allow_move_event_same_day' => false,
    ];

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.full-calendar');
    }
}
