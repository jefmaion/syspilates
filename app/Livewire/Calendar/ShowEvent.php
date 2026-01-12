<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\Registration;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowEvent extends Component
{
    public Registration $registration;

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-event');
    }

    #[On('calendar-show-event')]
    public function show($id, $type)
    {
        $this->registration = Registration::find($id);

        $this->dispatch('show-modal', modal: 'modal-show-event');
    }
}
