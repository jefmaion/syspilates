<?php

declare(strict_types=1);

namespace App\Livewire\Calendar;

use App\Enums\ClassTypesEnum;
use App\Enums\RegistrationStatusEnum;
use App\Models\Classes;
use App\Models\ExperimentalClass;
use App\Models\Student;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CalendarPage extends Component
{
    public $currentType;

    public $currentId;

    public $currentProps;

    public $modality_id;

    public $showSlotMenu = false;

    public $slotMenuX;

    public $slotMenuY;

    public $slotDatetime = null;

    public $makeupStudents = [];

    public $makeupStudentId;

    public $makeupClasses;

    public $makeupInstructorId;

    public $makeupId;

    public $calendarConfig = [
        'allow_move_event_same_day' => true,
    ];

    public $expName;

    public $expPhone;

    public $expModalityId;

    public $expInstructorId;

    public $expComments;

    public $showEvent = false;

    public function events()
    {
        $start = Carbon::parse(request()->get('start'));
        $end   = Carbon::parse(request()->get('end'));

        $class = Classes::with(['student.user', 'registration'])->whereBetween('scheduled_datetime', [$start, $end])->whereHas('registration', function ($q) {
            return $q->justActives();
        });

        $experimental = ExperimentalClass::with('modality')->whereBetween('datetime', [$start, $end]);

        if (request()->filled('modality_id')) {
            $class->where('modality_id', request()->get('modality_id'));
            $experimental->where('modality_id', request()->get('modality_id'));
        }

        if (request()->filled('student')) {
            $class->where('student_id', request()->get('student'));
        }

        if (request()->filled('instructor')) {
            $class->where('instructor_id', request()->get('instructor'));
            $experimental->where('instructor_id', request()->get('instructor'));
        }

        if (request()->filled('status')) {
            $class->where('status', request()->get('status'));
            $experimental->where('status', request()->get('status'));
        }

        if (request()->filled('type')) {
            $class->where('type', request()->get('type'));
        }

        $classes       = $class->get();
        $experimentals = $experimental->get();

        $events = [];

        $eventClass = 'p-1 mt-1 me-1 rounded-3 ';

        foreach ($classes as $class) {
            $badge   = null;
            $bgColor = 'bg-' . $class->status->color() .  ' text-' . $class->status->color() . '-lt-fg';

            if ($class->registration->status == RegistrationStatusEnum::CANCELED) {
                $bgColor .= '-lt';
            }

            if ($class->type !== ClassTypesEnum::REGULAR) {
                $badge = '<span class="badge bg-dark text-dark-fg">' . $class->type->nick() . '</span> ';
            }

            $events[] = [
                'id'                 => 'class-' . $class->id,
                'start'              => $class->datetime->format('Y-m-d H:i:s'),
                'title'              => $badge . ' ' . ($class->student->user->nickname ?? $class->student->user->shortName),
                'className'          => $eventClass . $bgColor,
                'textColor'          => 'white',
                'event_id'           => $class->id,
                'type'               => $class->type,
                'instructor_id'      => $class->instructor_id,
                'datetime'           => $class->datetime->format('Y-m-d H:i:s'),
                'scheduled_datetime' => $class->scheduled_datetime->format('Y-m-d H:i:s'),
                '_type'              => $class->type->value,
            ];
        }

        $events = array_values($events);

        foreach ($experimentals as $exp) {
            $events[] = $this->parseEvent(
                'exp-' . $exp->id,
                $exp->datetime->format('Y-m-d H:i:s'),
                $exp->name . ' (' . $exp->modality->acronym . ')',
                $exp->id,
                ClassTypesEnum::EXPERIMENTAL,
                $exp->instructor_id,
                $exp->datetime->format('Y-m-d H:i:s'),
                true,
                $eventClass
            );
        }

        return response()->json($events);
    }

    private function parseEvent($id, $start, $title, $eventId, $type, $instructorId, $datetime, $move, $eventClass = '')
    {
        return [
            'id'        => $id,
            'start'     => $start,
            'title'     => $title,
            'className' => $eventClass . 'bg-purple',
            'textColor' => 'white',

            'event_id'      => $eventId,
            'type'          => $type,
            'instructor_id' => $instructorId,
            'datetime'      => $datetime,
            'move'          => $move,
        ];
    }

    #[On('calendar-show-event')]
    public function open($id, $start, $props)
    {
        $this->currentId = $id;

        if ($props['type'] == ClassTypesEnum::EXPERIMENTAL->value) {
            return $this->dispatch('show-experimental-class', id: $props['event_id']);
        }

        $this->dispatch('show-class-card', id: $props['event_id'], type: $props['type'], datetime: $props['datetime']);
    }

    #[On('calendar-slot-clicked')]
    public function onCalendarSlotClicked($datetime, $x, $y)
    {
        $this->slotMenuX    = $x;
        $this->slotMenuY    = $y;
        $this->slotDatetime = $datetime;
        $this->showSlotMenu = true;
    }

    #[On('calendar-event-dropped')]
    public function createClassOnMove($id, $start, $props)
    {
        $event = Classes::find($props['event_id']);

        if ($props['type'] == ClassTypesEnum::EXPERIMENTAL->value) {
            $event = ExperimentalClass::find($props['event_id']);
        }

        $event->update([
            'datetime' => Carbon::parse($start),
        ]);

        $this->dispatch('refresh-calendar');
    }

    public function render(): View | Closure | string
    {
        $students = Student::whereHas('registrations', function ($q) {
            return $q->justActives();
        })->with('user')->get()->sortBy('user.name')->pluck('user.name', 'id');

        return view('livewire.calendar.calendar-page', [
            'students' => $students,
        ]);
    }
}
