<?php

declare(strict_types=1);

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

        $registrations = Registration::with('schedule', 'student.user')->whereBetween('start', [$start, $end])
            ->get();

            $events = [];

        foreach ($registrations as $registration) {
            foreach ($registration->schedule as $schedule) {

                $events[] = [
                    'id' => $registration->id . '-' . $schedule->id,
                    'title' => $registration->student->user->shortName,
                    'daysOfWeek' => [(int) $schedule->weekday], // ✅ ARRAY
                    'startTime' => $schedule->time,
                    // opcional
                    // 'endTime' => Carbon::createFromFormat('H:i', $schedule->time)
                    //     ->addMinutes(60)
                    //     ->format('H:i'),
                ];
            }
        }

        // dd($registrations[0]);

        return response()->json($events);
    }

    public function render(): View | Closure | string
    {
        return view('livewire.calendar.full-calendar');
    }
}
