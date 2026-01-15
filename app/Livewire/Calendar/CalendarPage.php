<?php

declare(strict_types = 1);

namespace App\Livewire\Calendar;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\Registration;
use Carbon\Carbon;
use Closure;
use Illuminate\View\View;
use Livewire\Component;

class CalendarPage extends Component
{
    public function events()
    {
        $start = Carbon::parse(request()->get('start'));
        $end   = Carbon::parse(request()->get('end'));

        $data = $this->getScheduledClasses($start, $end);

        return response()->json($data);
    }

    private function getScheduledClasses($start, $end)
    {
        $calendar = [];
        $events   = [];

        $classes = Classes::with('student.user')->whereBetween('date', [$start, $end])->get();

        foreach ($classes as $class) {
            $key = $class->date->format('Y-m-d') . '.' . $class->registration_id;

            $events[$key] = [
                'id'              => $class->id,
                'type'            => 'class',
                'start'           => $class->datetime,
                'registration_id' => $class->registration_id,
                'title'           => $class->student->user->shortName,
                'backgroundColor' => 'var(--tblr-' . $class->status->color() . ')',
                'textColor'       => 'white',
            ];
        }

        $registrations = Registration::with(['schedule', 'student.user'])
            ->whereHas('schedule.instructor.user', function ($q) {
                // return $q->where('name', 'Marina Barros Delgado');
            })->withinRange($start, $end)->justActives()->get();

        foreach ($registrations as $registration) {
            foreach ($registration->scheduledClasses($start, $end) as $schedClass) {
                $event = null;
                $key   = $schedClass['date'] . '.' . $registration->id;

                if (isset($events[$key])) {
                    // $event = $events[$key];
                    continue;
                }


                $event = [
                    'id'              => $registration->id,
                    'start'           => $schedClass['datetime'],
                    'type'            => 'schedule',
                    'registration_id' => $registration->id,
                    'title'           => $registration->student->user->shortName,
                    'backgroundColor' => 'var(--tblr-' . ClassStatusEnum::SCHEDULED->color() . ')',
                    'textColor'       => 'white',
                ];



                // $calendar[$key] = $event;
                $events[$key] = $event;
            }
        }

        $calendar = array_values($events);

        // $calendar = array_values($events);

        return $calendar;
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.calendar-page');
    }
}
