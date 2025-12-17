<?php

declare(strict_types = 1);

namespace App\Enums;

enum RegistrationStatusEnum: string
{
    case SCHEDULED = 'scheduled';
    case ACTIVE    = 'active';
    case CANCELED  = 'canceled';
    case CLOSED    = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => 'Agendada',
            self::ACTIVE    => 'Ativo',
            self::CANCELED  => 'Cancelado',
            self::CLOSED    => 'Finalizado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SCHEDULED => 'primary',
            self::ACTIVE    => 'success',
            self::CANCELED  => 'warning',
            self::CLOSED    => 'secondary',
        };
    }
}
