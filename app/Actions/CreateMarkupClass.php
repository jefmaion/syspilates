<?php

declare(strict_types = 1);

namespace App\Actions;

use App\Enums\ClassStatusEnum;
use App\Models\Classes;
use App\Models\ClassMakeup;

class CreateMarkupClass
{
    public static $makeupConditions = [
        ClassStatusEnum::CANCELED->value,
        ClassStatusEnum::JUSTIFIED->value,
    ];

    public static function run(Classes $class, $daysToExpire = 20)
    {
        if (in_array($class->status->value, self::$makeupConditions)) {
            if (ClassMakeup::where('origin_class_id', $class->id)->count() > 0) {
                return;
            }

            ClassMakeup::create([
                'student_id'      => $class->student_id,
                'registration_id' => $class->registration_id,
                'origin_class_id' => $class->id,
                'reason'          => $class->status,
                'expires_at'      => now()->addDays($daysToExpire),
                'status'          => 'active',
            ]);
        }
    }
}
