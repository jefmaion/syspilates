<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;
use App\Models\ExperimentalClass;
use App\Models\Instructor;
use App\Models\Registration;
use Carbon\Carbon;
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

    public $exp;

    public $instructor;

    public $status;

    public $evolution;

    #[On('calendar-show-event')]
    public function show($id, $start, $props)
    {
        // $this->reset();

        $this->props    = $props;
        $this->datetime = Carbon::parse($start);

        $this->class        = null;
        $this->exp          = null;
        $this->registration = null;
        $this->instructor   = null;

        if ($this->props['type'] == 'exp') {
            $this->exp = ExperimentalClass::with(['modality', 'instructor.user'])->find($this->props['exp_class_id']);

            return $this->dispatch('show-modal', modal: 'modal-show-exp');
        }

        $this->registration = Registration::find($this->props['registration_id']);
        $this->instructor   = Instructor::with('user')->find($this->props['instructor_id']);

        if (isset($this->props['class_id'])) {
            $this->class = Classes::with(['makeupClass.makeup', 'originMakeupClass.origin'])->find($this->props['class_id']);
        }

        $this->dispatch('show-modal', modal: 'modal-show-class');
    }

    public function makePresence()
    {
        $this->reset('status', 'evolution');

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

        if ($this->status == ClassStatusEnum::JUSTIFIED->value || $this->status == ClassStatusEnum::CANCELED->value) {
            if (ClassMakeup::where('origin_class_id', $class->id)->count() > 0) {
                return;
            }

            ClassMakeup::create([
                'student_id'      => $class->student_id,
                'registration_id' => $class->registration_id,
                'origin_class_id' => $class->id,
                'reason'          => $this->status,
                'expires_at'      => now()->addDays(20),
                'status'          => 'active',
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
