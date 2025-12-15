<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Instructor extends BaseModel
{
    /** @use HasFactory<\Database\Factories\InstructorFactory> */
    use HasFactory;

    public $guarded = ['id'];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany<Modality, $this>
     *
     * @property-read string $pivot->commission_type
     * @property-read float $pivot->commission_value
     * @property-read bool $pivot->calculate_on_justified_absence
     */
    public function modalities(): BelongsToMany
    {
        return $this->belongsToMany(Modality::class)
            ->withPivot([
                'commission_type',
                'commission_value',
                'calculate_on_justified_absence',
            ]);
    }
}
