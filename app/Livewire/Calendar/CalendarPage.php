<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\Registration;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Closure;
use Illuminate\View\View;
use Livewire\Component;

class CalendarPage extends Component
{
    public $modality_id;

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

        if (request()->filled('status')) {
            $class->where('status', request()->get('status'));
        }

        if (request()->filled('student')) {
            $registration->where('student_id', request()->get('student'));
            $class->where('student_id', request()->get('student'));
        }

        if (request()->filled('instructor')) {
            // $registration->where('instructor_id', request()->get('instructor'));
            $class->where('instructor_id', request()->get('instructor'));
        }

        $registrations = $registration->get();
        $classes       = $class->get();

        $events = [];

        foreach ($registrations as $reg) {
            $schedules = $reg->schedule;

            $period = CarbonPeriod::create($reg->start, $reg->end);

            foreach ($period as $date) {
                if (! $date->between($start, $end)) {
                    continue;
                }

                // if (request()->filled('status') && request()->filled('status') == 'scheduled') {
                //     break;
                // }

                foreach ($schedules as $schedule) {
                    if ($date->dayOfWeek === $schedule->weekday->value) {
                        $key          = $date->format('Y-m-d') . '.' . $schedule->id;
                        $events[$key] = [
                            'id'        => 'scheduled-' . $reg->id,
                            'start'     => $date->format('Y-m-d') . ' ' . $schedule->time,
                            'title'     => $reg->student->user->shortName,
                            'className' => 'bg-' . ClassStatusEnum::SCHEDULED->color(),
                            'textColor' => 'white',

                            'type'                     => 'scheduled',
                            'registration_id'          => $reg->id,
                            'instructor_id'            => $schedule->instructor_id,
                            'registration_schedule_id' => $schedule->id,
                            'student_id'               => $reg->student_id,
                            'datetime'                 => $date->format('Y-m-d') . ' ' . $schedule->time,
                            'scheduled_datetime'       => $date->format('Y-m-d') . ' ' . $schedule->time,
                            'executed_datetime'        => null,
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
                'title'     => $class->student->user->shortName,
                'className' => 'bg-' . $class['status']->color(),

                'type'                     => 'class',
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

        return response()->json($events);
    }

    public function render(): View | Closure | string
    {
        $reg = Registration::find(3);

        return view('livewire.calendar.calendar-page');
    }
}
