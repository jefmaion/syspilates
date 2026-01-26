<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
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
        // $this->loadData();

        // $data = [
        //     'id'                        => $this->eventId,
        //     'type'                      => $this->eventType,
        //     'registration_id'          => $this->registration->id,
        //     'student_id'               => $this->registration->student_id,
        //     'modality_id'              => $this->registration->modality_id,
        //     'datetime'                 => Carbon::parse($this->eventProps['datetime'])->format('Y-m-d H:i:s'),
        //     'instructor_id'            => $this->eventProps['instructor_id'],
        //     'scheduled_datetime'       => Carbon::parse($this->eventProps['scheduled_datetime'])->format('Y-m-d H:i:s'),
        //     'registration_schedule_id' => $this->eventProps['registration_schedule_id'] ?? null,
        //     'status'                    => $this->class?->status ?? null,
        //     'evolution'                 => $this->class?->evolution ?? null,
        // ];

        $this->dispatch('show-form-register', id:$this->eventId)->to(FormRegisterClass::class);
    }

    #[On('class-saved')]
    public function saved($id, $type)
    {


        $this->eventType = $type;
        $this->eventId   = $id;


        $this->loadData();

        $this->dispatch('show-event-refresh');
        $this->dispatch('refresh-calendar');
        $this->dispatch('$refresh');
    }

    protected function loadData()
    {
        $this->registration = null;
        $this->class        = null;

        $types = array_map(
            fn ($case) => $case->value,
            ClassTypesEnum::cases()
        ) ;



        if ($this->eventType == ClassStatusEnum::SCHEDULED->value) {
            $this->registration = Registration::with(['classes.instructor', 'modality'])->find($this->eventId);
            $this->setData($this->registration->student->user, Instructor::with('user')->find($this->eventProps['instructor_id'])->user, $this->registration->classes()->where('status', '!=', ClassStatusEnum::SCHEDULED)->get(), $this->registration->modality->name, ClassStatusEnum::SCHEDULED, $this->registration->student->objective);
        }

        if (in_array($this->eventType, $types)) {
            $this->class        = Classes::with(['student.user', 'modality', 'instructor.user', 'registration.classes'])->find($this->eventId);
            $this->registration = $this->class->registration;
            $this->setData($this->class->student->user, $this->class->instructor->user, $this->registration->classes()->where('status', '!=', ClassStatusEnum::SCHEDULED)->get(), $this->class->modality->name, $this->class->status, $this->class->student->objective);
        }
    }

    protected function setData($student, $instructor, $history, $modality, $status, $objective, $class=null)
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
