<?php

declare(strict_types=1);

namespace App\Models;

use App\Policies\InstructorPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[UsePolicy(InstructorPolicy::class)]
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
     * @return BelongsToMany<
     *     Modality,
     *     $this,
     *     InstructorModality
     * >
     */
    public function modalities(): BelongsToMany
    {
        return $this->belongsToMany(Modality::class)
            ->using(InstructorModality::class)
            ->withPivot([
                'commission_type',
                'commission_value',
                'calculate_on_justified_absence',
            ]);
    }
}
