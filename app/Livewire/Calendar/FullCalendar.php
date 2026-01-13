<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Registration;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Component;

class FullCalendar extends Component
{
    public $id;

    public $eventsEndpoint = '/calendar/events';

    public function events()
    {
        $start = Carbon::parse(request()->query('start'));
        $end   = Carbon::parse(request()->query('end'));

        $registrations = Registration::with(['schedule', 'classes', 'student.user'])->where(function ($query) use ($start, $end) {
            $query->where('start', '<=', $end)->where('end', '>=', $start);
        })->whereIn('status', ['sheduled', 'active'])
            ->whereHas('student.user', function ($q) {
                // $q->where('name', 'like', '%Melina%');
            })
            ->get();

        $dates = [];

        foreach ($registrations as $registration) {
            $hasClass = [];

            foreach ($registration->classes as $class) {
                $dates[] = [
                    'id'              => $class->id,
                    'start'           => $class->date . 'T' . $class->time,
                    'title'           => $registration->student->user->shortName,
                    'type'            => 'class',
                    'registration_id' => $registration->id,
                    'backgroundColor' => 'var(--tblr-' . str_replace('bg', '', $class->status->color()) . ')',
                    'borderColor'     => 'var(--tblr-' . str_replace('bg', '', $class->status->color()) . ')',
                    'textColor'       => 'white',
                ];

                $hasClass[] = $class->date;
            }

            foreach ($registration->preClasses() as $ev) {
                if (! in_array($ev['date']->format('Y-m-d'), $hasClass)) {
                    $dates[] = [
                        'id'              => $registration->id,
                        'start'           => $ev['datetime'],
                        'title'           => $registration->student->user->shortName,
                        'type'            => 'schedule',
                        'registration_id' => $registration->id,
                        'backgroundColor' => 'var(--tblr-' . str_replace('bg', '', ClassStatusEnum::SCHEDULED->color()) . ')',
                        'borderColor'     => 'var(--tblr-' . str_replace('bg', '', ClassStatusEnum::SCHEDULED->color()) . ')',
                        'textColor'       => 'white',
                    ];
                }
            }
        }

        // dd($dates);

        return $dates;

        // // if ($event->classes->registration->status !== RegistrationStatusEnum::ACTIVE && $event->classes->status == EnumClassStatus::SCHEDULED) {
        // //     return [];
        // // }

        // $title = $event->start->format('H\h') . ' ';

        // if ($event->type == 'C') {
        //     $title = $title . $event->classes->registration->student->user->name;
        // }

        // if ($event->type == 'E') {
        //     $title = $title . $event->experimental?->name;
        // }

        // return [
        //     'id'              => $event->id,
        //     'type'            => $event->type,
        //     'title'           => $title,
        //     'start'           => $event->start->toIso8601String(),
        //     'end'             => $event->end->toIso8601String(),
        //     'backgroundColor' => 'var(--tblr' . str_replace('bg', '', $event->color) . ')',
        //     'borderColor'     => 'var(--tblr' . str_replace('bg', '', $event->color) . ')',
        //     'textColor'       => 'white',
        //];

        // dd($registrations[0]);

        // return $registrations[0];
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.full-calendar');
    }
}
