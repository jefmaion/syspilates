<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\Classes;
use App\Models\Registration;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowEvent extends Component
{
    public Registration $registration;

    public $id;

    public $date;

    public $type;

    public $props;

    public $event;

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-event');
    }

    #[On('show-event-refresh')]
    public function refresh()
    {
        $this->dispatch('$refresh');
    }

    #[On('calendar-show-event')]
    public function show($id, $start, $props)
    {
        $this->id    = $id;
        $this->props = $props;
        $this->type  = $this->props['type'];
        $this->date  = Carbon::parse($start);

        // dd($this->date->dayOfWeek());

        $this->event        = null;
        $this->registration = Registration::with(['classes.instructor.user', 'modality'])->find($props['registration_id']);

        if ($this->type == 'class') {
            $this->event = Classes::with(['registration'])->find($this->id);
        }

        $this->dispatch('show-modal', modal: 'modal-show-event');
    }
}
