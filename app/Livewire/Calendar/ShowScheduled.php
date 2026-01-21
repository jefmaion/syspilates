<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use Closure;
use Illuminate\View\View;
use Livewire\Component;

class ShowScheduled extends Component
{
    // public function rendered()
    // {
    //     $this->dispatch('show-modal', modal:'modal-show-events');
    // }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-scheduled');
    }
}
