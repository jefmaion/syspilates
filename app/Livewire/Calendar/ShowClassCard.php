<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\Instructor;
use App\Models\Registration;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowClassCard extends Component
{
    public $eventType;

    public $eventId;

    public $eventProps;

    public $eventDatetime;

    // ----

    public $data = [];

    public $eventObjective;

    public $eventHistory;

    public $eventInstructor;

    public $eventStudent;

    public $eventModality;

    public $eventStatus;

    public $registration = null;

    public $class = null;

    #[On('show-class-card')]
    public function open($props = null)
    {
        $this->reset();

        if (empty($props)) {
            return;
        }

        $this->eventProps    = $props;
        $this->eventId       = $this->eventProps['event_id'];
        $this->eventType     = $this->eventProps['type'];
        $this->eventDatetime = Carbon::parse($this->eventProps['datetime']);

        $this->loadData();

        $this->dispatch('show-modal', modal:'modal-show-card');
    }

    public function registerClass()
    {
        $this->dispatch('show-form-register', data:$this->all());
    }

    #[On('class-saved')]
    public function saved($id)
    {
        $this->eventType = 'class';
        $this->eventId   = $id;

        $this->dispatch('refresh-calendar');
        $this->dispatch('$refresh');
        $this->loadData();
    }

    protected function loadData()
    {
        $this->registration = null;
        $this->class        = null;

        if ($this->eventType == 'scheduled') {
            $this->registration = Registration::with(['classes.instructor', 'modality'])->find($this->eventId);
            $this->setData($this->registration->student->user, Instructor::with('user')->find($this->eventProps['instructor_id'])->user, $this->registration->classes, $this->registration->modality->name, ClassStatusEnum::SCHEDULED, $this->registration->student->objective);
        }

        if ($this->eventType == 'class') {
            $this->class        = Classes::with(['student.user', 'modality', 'instructor.user'])->find($this->eventId);
            $this->registration = Registration::with(['classes.instructor'])->find($this->class->registration_id);

            $this->setData($this->class->student->user, $this->class->instructor->user, $this->registration->classes, $this->class->modality->name, $this->class->status, $this->class->student->objective);
        }
    }

    protected function setData($student, $instructor, $history, $modality, $status, $objective)
    {
        $this->eventObjective  = $objective;
        $this->eventHistory    = $history;
        $this->eventInstructor = $instructor;
        $this->eventStudent    = $student;
        $this->eventModality   = $modality;
        $this->eventStatus     = $status;

        $this->data = [
            'datetime'   => $this->eventDatetime,
            'status'     => $status,
            'modality'   => $modality,
            'student'    => $student,
            'instructor' => $instructor,
            'history'    => $history,
            'objective'  => $objective,
        ];

        // dd($this->data);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.show-class-card');
    }
}
