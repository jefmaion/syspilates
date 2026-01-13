<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\Registration;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowEvent extends Component
{
    public Registration $registration;

    public $date;

    public $type;

    public $event;

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-event');
    }

    #[On('calendar-show-event')]
    public function show($event)
    {
        $this->type  = $event['extendedProps']['type'];
        $this->event = $event;

        // switch ($event['extendedProps']['type']) {
        //     case 'schedule':
        //         $this->registration = Registration::with('classes')->find($event['id']);
        //         $this->date         = Carbon::parse($event['start']);
        //         $this->dispatch('show-modal', modal: 'modal-show-event');

        //         break;

        //     case 'class':
        //         $this->dispatch('show-class', id: $event['id']);

        //         break;

        //     default:
        //         # code...
        //         break;
        // }

        $this->registration = Registration::with(['classes.instructor.user'])->find($event['extendedProps']['registration_id']);
        $this->date         = Carbon::parse($event['start']);
        $this->dispatch('show-modal', modal: 'modal-show-event');
    }
}
