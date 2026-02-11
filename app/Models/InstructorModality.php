<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $commission_type
 * @property float $commission_value
 * @property bool $calculate_on_justified_absence
 */
class InstructorModality extends Pivot
{
    //

    /**
     * @return Attribute<string, string>
     */
    protected function comission_value(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return brlToUsd($value);
            }
        );
    }
}
