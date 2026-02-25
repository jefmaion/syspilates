<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Modality extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ModalityFactory> */
    use HasFactory;

    public $guarded = ['id'];

    /**
     * @return BelongsToMany<Instructor, $this>
     *
     * @property-read string $pivot->commission_type
     * @property-read float $pivot->commission_value
     * @property-read bool $pivot->calculate_on_justified_absence
     */
    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(Instructor::class)
            ->withPivot([
                'commission_type',
                'commission_value',
                'calculate_on_justified_absence',
            ]);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}
