<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClassStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends BaseModel
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    public $guarded = ['id'];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function makeup()
    {
        return $this->hasMany(ClassMakeup::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function getLastEvolutions($idRegistration)
    {
        return $this->classes()->with('instructor.user')->where('status', ClassStatusEnum::PRESENCE)->where('registration_id', $idRegistration)->orderBy('datetime', 'desc')->limit(3)->get();
    }
}
