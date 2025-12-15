<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $commission_type
 * @property float $commission_value
 * @property bool $calculate_on_justified_absence
 */
class InstructorModality extends Pivot
{
    //
}
