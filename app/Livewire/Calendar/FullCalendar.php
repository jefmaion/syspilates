<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Models\Registration;
use App\Models\RegistrationSchedules;
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

        $weekdays = RegistrationSchedules::with(['registration.student.user'])->get();

        $dates = [];

        foreach ($weekdays as $weekday) {
            $dates[] = [
                'id'         => $weekday->registration->id,
                'title'      => $weekday->registration->student->user->shortName,
                'daysOfWeek' => [$weekday->weekday],
                'startTime'  => $weekday->time,
                'startRecur' => $weekday->registration->start,
                'endRecur'   => $weekday->registration->end,
                'type'       => 'scheduled',
            ];
        }

        return $dates;

        // $registrations = Registration::with(['schedule', 'student.user'])->whereBetween('start', [$start, $end])->get();

        // $dates = [];

        // foreach ($registrations as $registration) {
        //     foreach ($registration->preClasses() as $ev) {
        //         $dates[] = [
        //             // 'id'    => 'v' . $ev['date'],
        //             'id'    => $registration->id,
        //             'start' => Carbon::parse($ev['date']->format('Y-m-d') . ' ' . $ev['time'])->format('Y-m-d\TH:i:s'),
        //             'title' => $registration->student->user->shortName,
        //             'type'  => $ev['type'],
        //         ];
        //     }
        // }

        // return $dates;

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
