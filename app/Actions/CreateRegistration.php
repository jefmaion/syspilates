<?php

declare(strict_types = 1);

namespace App\Actions;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Models\Registration;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CreateRegistration
{
    public static function run(array $data)
    {
        $schedules = $data['schedule'] ?? null;
        unset($data['schedule']);

        $registration = Registration::create($data);

        $registration->schedule()->createMany($schedules);

        $period = CarbonPeriod::create($registration->start, $registration->end);

        foreach ($period as $date) {
            foreach ($registration->schedule as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday->value) {
                    $registration->classes()->create([
                        'student_id'               => $registration->student_id,
                        'modality_id'              => $registration->modality_id,
                        'datetime'                 => Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time),
                        'instructor_id'            => $schedule->instructor_id,
                        'scheduled_datetime'       => Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time),
                        'type'                     => ClassTypesEnum::REGULAR,
                        'registration_schedule_id' => $schedule->id,
                        'status'                   => ClassStatusEnum::SCHEDULED,
                    ]);
                }
            }
        }

        return $registration;
    }
}
