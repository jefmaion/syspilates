<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Registration;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowClass extends Component
{
    public $props = [];

    public $datetime;

    public $registration;

    public $class;

    public $instructor;

    public $status;

    public $evolution;

    #[On('calendar-show-event')]
    public function show($id, $start, $props)
    {
        // $this->reset();

        $this->props        = $props;
        $this->datetime     = $start;
        $this->registration = Registration::find($this->props['registration_id']);
        $this->instructor   = Instructor::with('user')->find($this->props['instructor_id']);

        if (isset($this->props['class_id'])) {
            $this->class = Classes::find($this->props['class_id']);
        }

        $this->dispatch('show-modal', modal: 'modal-show-class');
    }

    public function makePresence()
    {
        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    public function editClass()
    {
        $this->status    = $this->class->status;
        $this->evolution = $this->class->evolution;

        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    public function save()
    {
        if ($this->props['type'] == 'scheduled') {
            $class = Classes::create([
                'registration_id'          => $this->registration->id,
                'student_id'               => $this->registration->student_id,
                'instructor_id'            => $this->props['instructor_id'],
                'modality_id'              => $this->registration->modality_id,
                'datetime'                 => $this->datetime,
                'scheduled_datetime'       => $this->props['scheduled_datetime'],
                'registration_schedule_id' => $this->props['registration_schedule_id'],
                'status'                   => $this->status,
                'evolution'                => $this->evolution,
            ]);
        } else {
            $class = Classes::find($this->props['class_id']);
            $class->update([
                'status'    => $this->status,
                'evolution' => $this->evolution,
            ]);
        }

        $this->dispatch('hide-modal', modal: 'modal-register-class');
        $this->dispatch('refresh-calendar');
        $this->dispatch('show-event-refresh');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-class');
    }
}
