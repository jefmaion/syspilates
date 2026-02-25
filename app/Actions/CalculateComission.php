<?php

namespace App\Actions;

use App\Enums\ClassStatusEnum;
use App\Models\InstructorComission;
use App\Models\InstructorModality;

class CalculateComission
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function run($class)
    {

        if (InstructorComission::where('class_id', $class->id)->count() > 0) {
            return;
        }

        if (!$comiss = InstructorModality::where('instructor_id', $class->instructor_id)->where('modality_id', $class->modality_id)->first()) {
            return;
        }

        if ($class->status != ClassStatusEnum::PRESENCE && $class->status != ClassStatusEnum::JUSTIFIED) {
            return;
        }

        if ($class->status == ClassStatusEnum::JUSTIFIED && $comiss->calculate_on_justified_absence == 0) {
            return;
        }

        $value = $comiss->commission_value;

        if ($comiss->commission_type == 'percent') {
            $value = ($comiss->commission_value / 100) * $class->value;
        }

        InstructorComission::create([
            'class_id' => $class->id,
            'instructor_id' => $class->instructor_id,
            'datetime' => $class->datetime,
            'comission_type' => $comiss->commission_type,
            'comission_value' => $comiss->commission_value,
            'class_value' => $class->value,
            'value' => $value
        ]);
    }
}
