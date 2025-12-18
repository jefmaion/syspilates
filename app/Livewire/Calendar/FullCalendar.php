<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

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

        $registrations = Registration::with('schedule')->whereBetween('start', [$start, $end])
            ->get()->map(function ($event) {
                $dates = [];

                foreach ($event->preClasses() as $ev) {
                    $dates[] = [
                        'id'    => 'v' . $ev['date'],
                        'start' => Carbon::parse($ev['date']->format('Y-m-d') . ' ' . $ev['time'])->format('Y-m-d\TH:i:s'),
                        'title' => $event->student->user->shortName,
                    ];
                }

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
            })->toArray();

        // dd($registrations[0]);

        return $registrations[0];
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.full-calendar');
    }
}
