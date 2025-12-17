<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use Closure;
use Illuminate\View\View;
use Livewire\Component;

class CalendarPage extends Component
{
    public function render(): View | Closure | string
    {
        return view('livewire.calendar.calendar-page');
    }
}
