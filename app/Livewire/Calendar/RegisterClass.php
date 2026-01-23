<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\Registration;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class RegisterClass extends Component
{
    public $registration;

    public $action;

    public $create = false;

    public $class;

    public $date;

    public $status;

    public $evolution;

    public $instructor_id;

    public $student_id;

    #[On('create-class')]
    public function create($datetime, $id)
    {
        $this->reset();

        $this->date         = Carbon::parse($datetime);
        $this->registration = Registration::find($id);
        $this->create       = true;

        $this->instructor_id = $this->registration->getInstructorByWeekday($this->date->format('w'))->instructor->id;
        $this->student_id    = $this->registration->student_id;

        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    #[On('make-presence')]
    public function makePresence($datetime, $id, $instructor_id, $props)
    {
        dd($props);
        $this->reset();

        $this->action = 'presence';
        $this->create = true;

        $this->date          = Carbon::parse($datetime);
        $this->registration  = Registration::find($id);
        $this->instructor_id = $instructor_id;
        $this->student_id    = $this->registration->student_id;
        $this->status        = ClassStatusEnum::PRESENCE;

        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    #[On('make-absense')]
    public function makeAbsense($datetime, $id)
    {
        $this->reset();

        $this->action = 'absense';
        $this->create = true;

        $this->date          = Carbon::parse($datetime);
        $this->registration  = Registration::find($id);
        $this->instructor_id = $this->registration->getInstructorByWeekday($this->date->format('w'))->instructor->id;
        $this->student_id    = $this->registration->student_id;

        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    #[On('show-class')]
    public function show($id)
    {
        $this->create       = false;
        $this->class        = Classes::with('registration')->find($id);
        $this->registration = $this->class->registration;

        $this->student_id    = $this->class->student_id;
        $this->instructor_id = $this->class->instructor_id ?? $this->registration->getInstructorByWeekday(date('w', strtotime($this->class->date)));
        $this->status        = $this->class->status->value;
        $this->evolution     = $this->class->evolution;

        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    // public function save()
    // {
    //     if ($this->create) {
    //         $date        = Carbon::parse($this->date);
    //         $this->class = Classes::create([
    //             'registration_id' => $this->registration->id,
    //             'student_id'      => $this->registration->student_id,
    //             'instructor_id'   => $this->instructor_id,
    //             'modality_id'     => $this->registration->modality_id,
    //             'date'            => $date->format('Y-m-d'),
    //             'time'            => $date->format('H:i:s'),
    //             'datetime'        => $date,
    //             'status'          => $this->status,
    //             'evolution'       => $this->evolution,
    //         ]);
    //     } else {
    //         $this->class->update([
    //             'instructor_id' => $this->instructor_id,
    //             'status'        => $this->status,
    //             'evolution'     => $this->evolution,
    //         ]);
    //     }

    //     $this->dispatch('hide-modal', modal: 'modal-register-class');
    //     // $this->dispatch('hide-modal', modal: 'modal-show-event');
    //     $this->dispatch('refresh-calendar');
    //     $this->dispatch('show-event-refresh');
    // }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.register-class');
    }
}
