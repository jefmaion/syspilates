<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;
use App\Models\Registration;
use App\Models\Student;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Closure;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CalendarPage extends Component
{
    public $modality_id;

    public $showSlotMenu = false;
    public $slotMenuX;
        public $slotMenuY;
        public $slotDatetime = null;


        public $makeupStudents=[];
        public $makeupStudentId;
        public $makeupClasses;
        public $makeupInstructorId;
        public $makeupId;

    public function events()
    {
        $start = Carbon::parse(request()->get('start'));
        $end   = Carbon::parse(request()->get('end'));

        $registration = Registration::with(['schedule', 'student.user', 'classes.student.user'])->withinRange($start, $end)->justActives();
        $class        = Classes::with('student.user')->whereBetween('scheduled_datetime', [$start, $end]);

        if (request()->filled('modality_id')) {
            $registration->where('modality_id', request()->get('modality_id'));
            $class->where('modality_id', request()->get('modality_id'));
        }

        // if (request()->filled('status')) {
        //     $class->where('status', request()->get('status'));
        // }

        if (request()->filled('student')) {
            $registration->where('student_id', request()->get('student'));
            $class->where('student_id', request()->get('student'));
        }

        if (request()->filled('instructor')) {
            // $registration->where('instructor_id', request()->get('instructor'));
            $registration->whereHas('schedule', function($q) {
                return $q->where('instructor_id', request()->get('instructor'));
            });
            $class->where('instructor_id', request()->get('instructor'));
        }

        $registrations = $registration->get();
        $classes       = $class->get();

        $events = [];

        $bullet = '<span class="mx-1"><span class="bg-%s status-dot"></span></span>';

        foreach ($registrations as $reg) {
            $schedules = $reg->schedule;

            $period = CarbonPeriod::create($reg->start, $reg->end);

            foreach ($period as $date) {

                if (! $date->between($start, $end)) {
                    continue;
                }

                foreach ($schedules as $schedule) {
                    if ($date->dayOfWeek === $schedule->weekday->value) {
                        $key          = $date->format('Y-m-d') . '.' . $schedule->id;
                        $events[$key] = [
                            'id'        => 'scheduled-' . $reg->id,
                            'start'     => $date->format('Y-m-d') . ' ' . $schedule->time,
                            'title'     => sprintf($bullet, 'white').$reg->student->user->shortName,
                            'className' => 'bg-' . ClassStatusEnum::SCHEDULED->color(),
                            'textColor' => 'white',

                            'type'                     => 'scheduled',
                            'type_class' => '',
                            'type_class_color' => '',
                            'registration_id'          => $reg->id,
                            'instructor_id'            => $schedule->instructor_id,
                            'registration_schedule_id' => $schedule->id,
                            'student_id'               => $reg->student_id,
                            'datetime'                 => $date->format('Y-m-d') . ' ' . $schedule->time,
                            'scheduled_datetime'       => $date->format('Y-m-d') . ' ' . $schedule->time,
                            'executed_datetime'        => null,
                            'status' => ClassStatusEnum::SCHEDULED->value
                        ];
                    }
                }
            }
        }

        foreach ($classes as $class) {
            $key  = $class->scheduled_datetime->format('Y-m-d') . '.' . $class->registration_schedule_id;
            $item = [
                'id'        => 'class-' . $class->id,
                'start'     => $class->datetime->format('Y-m-d H:i:s'),
                'title'     => sprintf($bullet, $class->type->color()).$class->student->user->shortName,
                'className' => 'bg-' .  $class['status']->color(),
                'textColor' => 'white',

                'type'                     => 'class',
                'type_class' => $class->type->label(),
                'type_class_color' => $class->type->color(),
                'class_id'                 => $class->id,
                'registration_id'          => $class->registration_id,
                'instructor_id'            => $class->instructor_id,
                'registration_schedule_id' => $class->registration_schedule_id,
                'student_id'               => $class->student_id,
                'datetime'                 => $class->datetime->format('Y-m-d H:i:s'),
                'scheduled_datetime'       => $class->scheduled_datetime->format('Y-m-d H:i:s'),
                'executed_datetime'        => $class->datetime->format('Y-m-d H:i:s'),
                'status'                   => $class->status,
            ];

            $events[$key] = $item;
        }

        $events = array_values($events);

        $events = collect($events)
            ->when(request('status') ?? null, fn ($c, $v) =>
                $c->where('status', $v)
            )
            ->values()
            ->all();

        return response()->json($events);
    }

    #[On('calendar-slot-clicked')]
    public function onCalendarSlotClicked($datetime, $x, $y)
    {
        $this->slotMenuX = $x;
        $this->slotMenuY = $y;
        $this->slotDatetime = Carbon::parse($datetime);
        $this->showSlotMenu = true;
    }

    public function makeup($datetime) {
        $this->slotDatetime = Carbon::parse($datetime);


        $this->makeupStudents = Student::with(['makeup', 'user'])->whereHas('makeup', function($q) {
            return $q->where('status', 'active')->where('expires_at', '>=', now())->orderBy('expires_at');
        })->get()->sortBy('user.name')->pluck('user.name', 'id');




        $this->dispatch('show-modal', modal:'modal-makeup');
    }

    public function listMakeupClass($studentId) {
        $this->makeupClasses = ClassMakeup::with('origin')->where('status', 'active')->where('student_id', $studentId)->where('expires_at', '>=', now())->orderBy('expires_at')->get()->pluck('origin.datetime', 'id');
    }

    public function saveMakeup() {
        // dd($this->makeupInstructorId, $this->makeupStudentId, $this->makeupId, $this->slotDatetime);

        $makeup = ClassMakeup::with('origin')->find($this->makeupId);

        $class = Classes::create([
            'student_id'        => $makeup->student_id,
            'registration_id'   => $makeup->origin->registration_id,

            'modality_id'       => $makeup->origin->modality_id,
            'instructor_id'     => $this->makeupInstructorId,

            'scheduled_datetime'=> $this->slotDatetime,
            'datetime'          => $this->slotDatetime,

            'status'            => ClassStatusEnum::SCHEDULED,
            'type' => ClassTypesEnum::REPOSITION,
            'is_makeup'         => true,
            'original_class_id'   => $makeup->origin_class_id,
            'makeup_credit_id'  => $makeup->id,
        ]);

        // 2) Consome o crédito
        $makeup->update([
            'status'        => 'used',
            'used_at'       => now(),
            'used_class_id'=> $class->id,
        ]);

        $this->dispatch('hide-modal', modal:'modal-makeup');
        $this->dispatch('refresh-calendar');
    }

    public function render(): View | Closure | string
    {
        $students = Student::whereHas('registrations', function($q) {
            return $q->justActives();
        })->with('user')->get()->sortBy('user.name')->pluck('user.name', 'id');



        return view('livewire.calendar.calendar-page', [
            'students' => $students
        ]);
    }
}
