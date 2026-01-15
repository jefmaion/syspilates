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

    public $id;

    public $date;

    public $type;

    public $event;

    public $classes = [];

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-event');
    }

    #[On('show-event-refresh')]
    public function refresh($id)
    {
        $this->show($id, now(), 'class', null);
    }

    #[On('calendar-show-event')]
    public function show($id, $start, $type, $event)
    {
        $this->id    = $id;
        $this->type  = $type;
        $this->event = $event;
        $this->date  = Carbon::parse($start);

        $this->classes = [];

        switch ($this->type) {
            case 'scheduled':
                $this->registration = Registration::with(['classes.instructor.user'])->find($this->id);

                break;

            case 'class':
                $this->registration = Registration::with(['classes.instructor.user'])->whereHas('classes', function ($query) {return $query->where('id', $this->id);})->first();
                $this->classes      = $this->registration->classes;

                break;

            default:
                # code...
                break;
        }

        $this->dispatch('show-modal', modal: 'modal-show-event');
    }
}
