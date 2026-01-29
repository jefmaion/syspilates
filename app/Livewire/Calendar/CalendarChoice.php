<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CalendarChoice extends Component
{
    #[On('show-calendar-choice')]
    public function show()
    {
        $this->dispatch('show-modal', modal:'modal-calendar-choice');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.calendar-choice');
    }
}
