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

class RegisterClass extends Component
{
    public $registration;

    public $create = false;

    public $class;

    public $date;

    public $status;

    public $evolution;

    public $instructor_id;

    #[On('create-class')]
    public function create($datetime, $id)
    {
        // $this->reset();

        $this->date         = Carbon::parse($datetime);
        $this->registration = Registration::find($id);
        $this->create       = true;

        $this->instructor_id = $this->registration->getInstructorByWeekday($this->date->format('w'))->instructor->id;

        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    #[On('show-class')]
    public function show($id)
    {
        $this->create       = false;
        $this->class        = Classes::with('registration')->find($id);
        $this->registration = $this->class->registration;

        $this->instructor_id = $this->class->instructor_id ?? $this->registration->getInstructorByWeekday(date('w', strtotime($this->class->date)));
        $this->status        = $this->class->status->value;
        $this->evolution     = $this->class->evolution;

        $this->dispatch('show-modal', modal: 'modal-register-class');
    }

    public function save()
    {
        if ($this->create) {
            $date       = Carbon::parse($this->date);
            $instructor = $this->registration->schedule()->where('weekday', $date->format('w'))->first();

            Classes::create([
                'registration_id' => $this->registration->id,
                // 'instructor_id'   => $instructor->instructor_id,
                'instructor_id' => $this->instructor_id,
                'date'          => $date->format('Y-m-d'),
                'time'          => $date->format('H:i:s'),
                'status'        => $this->status,
                'evolution'     => $this->evolution,
            ]);
        } else {
            $this->class->update([
                'instructor_id' => $this->instructor_id,
                'status'        => $this->status,
                'evolution'     => $this->evolution,
            ]);
        }

        $this->dispatch('hide-modal', modal: 'modal-register-class');
        $this->dispatch('refresh-calendar');
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.register-class');
    }
}
