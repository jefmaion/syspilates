<?php

declare(strict_types=1);

namespace App\Actions;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Models\Registration;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class GenerateRegistrationClasses
{
    public static function run(Registration $registration, $start, $end)
    {
        $period = CarbonPeriod::create($start, $end);

        $countClasses = 0;
        $classes = [];
        foreach ($period as $date) {
            foreach ($registration->schedule as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday->value) {

                    $classes[] = Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time);

                    // $registration->classes()->create([
                    //     'student_id'               => $registration->student_id,
                    //     'modality_id'              => $registration->modality_id,
                    //     'datetime'                 => Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time),
                    //     'instructor_id'            => $schedule->instructor_id,
                    //     'scheduled_datetime'       => Carbon::parse($date->format('Y-m-d') . ' ' . $schedule->time),
                    //     'type'                     => ClassTypesEnum::REGULAR,
                    //     'registration_schedule_id' => $schedule->id,
                    //     'status'                   => ClassStatusEnum::SCHEDULED,
                    // ]);

                    $countClasses++;
                }
            }
        }

        $classValue = $registration->value / count($classes);

        foreach ($classes as $class) {
            $registration->classes()->create([
                'student_id'               => $registration->student_id,
                'modality_id'              => $registration->modality_id,
                'datetime'                 => $class,
                'scheduled_datetime'       => $class,
                'instructor_id'            => $schedule->instructor_id,
                'registration_schedule_id' => $schedule->id,
                'value'                    => $classValue,
                'type'                     => ClassTypesEnum::REGULAR,
                'status'                   => ClassStatusEnum::SCHEDULED,
            ]);
        }

        $registration->update(['class_value' => $registration->value / $countClasses]);

        return $registration;
    }
}
