<?php

declare(strict_types = 1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
    use AuditingAuditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
        ];
    }

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
}
