<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowClass extends Component
{
    #[On('calendar-show-event')]
    public function show($id, $start, $type)
    {
        dd($id, $start, $type);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-class');
    }
}
