<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;
use App\Models\ExperimentalClass;
use App\Models\Registration;
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

        $registration = Registration::with(['schedule', 'student.user', 'classes.student.user'])->withinRange($start, $end)->justActives();
        $class        = Classes::with('student.user')->whereBetween('scheduled_datetime', [$start, $end]);
        $experimental = ExperimentalClass::whereBetween('datetime', [$start, $end]);

        if (request()->filled('modality_id')) {
            $registration->where('modality_id', request()->get('modality_id'));
            $class->where('modality_id', request()->get('modality_id'));
            $experimental->where('modality_id', request()->get('modality_id'));
        }

        if (request()->filled('student')) {
            $registration->where('student_id', request()->get('student'));
            $class->where('student_id', request()->get('student'));
        }

        if (request()->filled('instructor')) {
            $registration->whereHas('schedule', function ($q) {
                return $q->where('instructor_id', request()->get('instructor'));
            });
            $class->where('instructor_id', request()->get('instructor'));
            $experimental->where('instructor_id', request()->get('instructor'));
        }

        $registrations = $registration->get();
        $classes       = $class->get();
        $experimentals = $experimental->get();

        $events = [];

        $eventClass = 'p-1 mt-1 me-1 ';

        $bullet = '<span class="mx-1"><span class="bg-%s status-dot"></span></span>';

        foreach ($registrations as $reg) {
            foreach ($reg->getScheduleClasses($start, $end) as $key => $item) {
                $events[$key] = [
                    'id'        => 'scheduled-' . $reg->id,
                    'start'     => $item['datetime'],
                    'title'     => ClassStatusEnum::SCHEDULED->icon() . $reg->student->user->shortName,
                    'className' => $eventClass . 'bg-' . ClassStatusEnum::SCHEDULED->color(),
                    'textColor' => 'white',

                    'event_id'                 => $reg->id,
                    'type'                     => 'scheduled',
                    'instructor_id'            => $item['instructor_id'],
                    'registration_schedule_id' => $item['id'],
                    'datetime'                 => $item['datetime'],
                    'scheduled_datetime'       => $item['datetime'],
                    '_type'                    => ClassTypesEnum::REGULAR->value,
                ];
            }
        }

        foreach ($classes as $class) {
            $key = $class->scheduled_datetime->format('Y-m-d') . '.' . $class->registration_schedule_id;

            $badge   = null;
            $bgColor = 'bg-' . $class->status->color();

            if ($class->type !== ClassTypesEnum::REGULAR) {
                $badge = '<span class="badge bg-orange text-orange-fg">' . $class->type->nick() . '</span> ';
                // $bgColor = 'bg-' . $class->type->color();
            }

            $item = [
                'id'        => 'class-' . $class->id,
                'start'     => $class->datetime->format('Y-m-d H:i:s'),
                'title'     => $class->student->user->shortName . ' ' . $badge,
                'className' => $eventClass . $bgColor,
                'textColor' => 'white',

                'event_id'      => $class->id,
                'type'          => 'class',
                'instructor_id' => $class->instructor_id,
                // 'registration_schedule_id' => $class->registration_schedule_id,
                'datetime'           => $class->datetime->format('Y-m-d H:i:s'),
                'scheduled_datetime' => $class->scheduled_datetime->format('Y-m-d H:i:s'),
                '_type'              => $class->type->value,
            ];

            $events[$key] = $item;
        }

        $events = array_values($events);

        foreach ($experimentals as $exp) {
            $badge    = ' <span class="badge bg-orange text-orange-fg">' . ClassTypesEnum::EXPERIMENTAL->nick() . '</span> ';
            $events[] = [
                'id'        => 'exp-' . $exp->id,
                'start'     => $exp->datetime->format('Y-m-d H:i:s'),
                'title'     => $exp->name . $badge,
                'className' => $eventClass . 'bg-' . $exp->status->color(),
                'textColor' => 'white',

                'event_id'      => $exp->id,
                'type'          => 'class',
                'instructor_id' => $exp->instructor_id,
                'datetime'      => $exp->datetime->format('Y-m-d H:i:s'),
                'move'          => true,
                '_type'         => ClassTypesEnum::EXPERIMENTAL->value,
            ];
        }

        $events = collect($events)
            ->when(
                request('status') ?? null,
                fn ($c, $v) => $c->where('status', $v)
            )
            ->when(
                request('type') ?? null,
                fn ($c, $v) => $c->where('_type', $v)
            )
            ->values()
            ->all();

        return response()->json($events);
    }

    #[On('calendar-show-event')]
    public function open($id, $start, $props)
    {
        $this->currentId = $id;
        $this->dispatch('show-class-card', props: $props);
    }

    #[On('calendar-slot-clicked')]
    public function onCalendarSlotClicked($datetime, $x, $y)
    {
        $this->slotMenuX    = $x;
        $this->slotMenuY    = $y;
        $this->slotDatetime = $datetime;
        $this->showSlotMenu = true;
    }

    // public function makeup($datetime)
    // {
    //     $this->slotDatetime = Carbon::parse($datetime);

    //     $this->makeupStudents = Student::with(['makeup', 'user'])->whereHas('makeup', function ($q) {
    //         return $q->where('status', 'active')->where('expires_at', '>=', now())->orderBy('expires_at');
    //     })->get()->sortBy('user.name')->pluck('user.name', 'id');

    //     $this->dispatch('show-modal', modal:'modal-makeup');
    // }

    // public function createExperimentalClass($datetime = null)
    // {
    //     $this->slotDatetime = Carbon::parse($datetime);
    //     $this->dispatch('show-modal', modal:'modal-experimental');
    // }

    // public function saveExperimental()
    // {
    //     ExperimentalClass::create([
    //         'name'          => $this->expName,
    //         'phone'         => $this->expPhone,
    //         'datetime'      => $this->slotDatetime,
    //         'instructor_id' => $this->expInstructorId,
    //         'modality_id'   => $this->expModalityId,
    //         'comments'      => $this->expComments,
    //     ]);

    //     $this->dispatch('hide-modal', modal:'modal-experimental');
    //     $this->dispatch('refresh-calendar');
    // }

    // public function listMakeupClass($studentId)
    // {
    //     $classes = ClassMakeup::with('origin')->where('status', 'active')->where('student_id', $studentId)->where('expires_at', '>=', now())->orderBy('expires_at')->get();

    //     dd($classes);

    //     foreach ($classes as $class) {
    //         $this->makeupClasses[$class->id] = $class->origin->datetime->format('d/m/Y H:i') . ' - ' . $class->origin->datetime->format('l') . ' - ' . $class->origin->status->label();
    //     }

    //     // $this->makeupClasses = ClassMakeup::with('origin')->where('status', 'active')->where('student_id', $studentId)->where('expires_at', '>=', now())->orderBy('expires_at')->get()->pluck('origin.datetime', 'id');
    // }

    // public function saveMakeup()
    // {
    //     // dd($this->makeupInstructorId, $this->makeupStudentId, $this->makeupId, $this->slotDatetime);

    //     $makeup = ClassMakeup::with('origin')->find($this->makeupId);

    //     $origin = Classes::find($makeup->origin_class_id);

    //     $class = Classes::create([
    //         'student_id'      => $makeup->student_id,
    //         'registration_id' => $makeup->origin->registration_id,

    //         'modality_id'   => $makeup->origin->modality_id,
    //         'instructor_id' => $this->makeupInstructorId,

    //         'scheduled_datetime' => $this->slotDatetime,
    //         'datetime'           => $this->slotDatetime,

    //         'status'            => ClassStatusEnum::SCHEDULED,
    //         'type'              => ClassTypesEnum::MAKEUP,
    //         'is_makeup'         => true,
    //         'original_class_id' => $makeup->origin_class_id,
    //         'makeup_credit_id'  => $makeup->id,
    //     ]);

    //     // 2) Consome o crédito
    //     $makeup->update([
    //         'status'        => 'used',
    //         'used_at'       => now(),
    //         'used_class_id' => $class->id,
    //     ]);

    //     $origin->update(['makup_class_id' => $class->id]);

    //     $this->dispatch('hide-modal', modal:'modal-makeup');
    //     $this->dispatch('refresh-calendar');
    //     $this->dispatch('$refresh');
    // }

    // #[On('calendar-event-dropped')]
    // public function createClassOnMove($id, $start, $props)
    // {
    //     if ($props['type'] == 'scheduled') {
    //         $registration = Registration::find($props['registration_id']);

    //         $class = Classes::create([
    //             'registration_id'          => $registration->id,
    //             'student_id'               => $registration->student_id,
    //             'instructor_id'            => $props['instructor_id'],
    //             'modality_id'              => $registration->modality_id,
    //             'datetime'                 => Carbon::parse($start),
    //             'scheduled_datetime'       => $props['scheduled_datetime'],
    //             'registration_schedule_id' => $props['registration_schedule_id'],
    //             'status'                   => ClassStatusEnum::SCHEDULED,
    //         ]);
    //     } else {
    //         if ($props['type'] == 'exp') {
    //             $class = ExperimentalClass::find($props['exp_class_id']);
    //         } else {
    //             $class = Classes::find($props['class_id']);
    //         }

    //         $class->update([
    //             'datetime' => Carbon::parse($start),
    //         ]);
    //     }

    //     $this->dispatch('refresh-calendar');
    // }

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
