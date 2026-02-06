<?php

namespace App\Actions;

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
        if (!$comiss = InstructorModality::where('instructor_id', $class->instructor_id)->where('modality_id', $class->modality_id)->first()) {
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
