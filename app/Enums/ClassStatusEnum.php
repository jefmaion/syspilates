<?php

declare(strict_types = 1);

namespace App\Enums;

enum ClassStatusEnum: string
{
    case SCHEDULED = 'scheduled';
    case PRESENCE  = 'active';
    case ABSENSE   = 'canceled';
    case CLOSED    = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => 'Agendada',
            self::PRESENCE  => 'Presença',
            self::ABSENSE   => 'Falta',
            self::CLOSED    => 'Finalizado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SCHEDULED => 'primary',
            self::PRESENCE  => 'success',
            self::ABSENSE   => 'warning',
            self::CLOSED    => 'secondary',
        };
    }
}
