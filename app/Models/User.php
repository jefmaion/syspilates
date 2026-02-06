<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\Models\User
 *
 * @property string $short_name
 */
class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
    use AuditingAuditable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'birthdate'         => 'date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return $this->casts;
    }

    public function isActive(): int
    {
        return $this->active;
    }

    /**
     * @return Attribute<string, string>
     */
    protected function shortName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $parts = explode(' ', trim($attributes['name']));

                if (count($parts) === 1) {
                    return $parts[0]; // só um nome
                }

                $first = $parts[0];
                $last  = $parts[count($parts) - 1];

                return "{$first} {$last}";
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function age(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return Carbon::parse($this->birthdate)->age;
            }
        );
    }

    // Carbon::parse('1990-05-15')

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return ($attributes['active']) ? 'Ativo' : 'Bloqueado';
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function initials(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return initials($this->short_name);
            }
        );
    }

    /**
     * @return HasOne<Student, $this>
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    /**
     * @return HasOne<Instructor, $this>
     */
    public function instructor(): HasOne
    {
        return $this->hasOne(Instructor::class);
    }
}
