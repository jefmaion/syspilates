<?php

declare(strict_types=1);

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

    public static function run(Classes $class, $daysToExpire = 20, $dateLimit = null)
    {
        if (in_array($class->status->value, self::$makeupConditions)) {
            if (ClassMakeup::where('origin_class_id', $class->id)->count() > 0) {
                return;
            }

            $dateLimit = is_null($dateLimit) ? now()->addDays($daysToExpire) : $dateLimit;

            ClassMakeup::create([
                'student_id'      => $class->student_id,
                'registration_id' => $class->registration_id,
                'origin_class_id' => $class->id,
                'reason'          => $class->status,
                'expires_at'      => $dateLimit,
                'status'          => 'active',
            ]);
        }
    }
}
