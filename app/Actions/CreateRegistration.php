<?php

declare(strict_types = 1);

namespace App\Actions;

use App\Models\Registration;

class CreateRegistration
{
    public static function run(array $data)
    {
        $schedules = $data['schedule'] ?? null;
        unset($data['schedule']);

        $registration = Registration::create($data);

        $registration->schedule()->createMany($schedules);

        $registration = GenerateRegistrationClasses::run($registration, $registration->start, $registration->end);

        return $registration;
    }
}
