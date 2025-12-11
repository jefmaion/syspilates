<?php

declare(strict_types = 1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'birthdate'         => 'date',
        ];
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
    protected function initials(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // usa o shortName já calculado
                $shortName = $this->short_name; // camelCase vira snake_case no acesso

                $parts    = explode(' ', $shortName);
                $initials = '';

                foreach ($parts as $p) {
                    $initials .= strtoupper(substr($p, 0, 1));
                }

                return $initials;
            }
        );
    }

    /**
     * @return HasOne<Student, User>
     */
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }
}
