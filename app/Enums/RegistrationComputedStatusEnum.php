<?php

declare(strict_types = 1);

namespace App\Enums;

enum RegistrationComputedStatusEnum: string
{
    case EXPIRED  = 'expired';
    case EXPIRING = 'expiring';
    case WORKING  = 'working';
    case CLOSED   = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::EXPIRED  => 'Expirado',
            self::EXPIRING => 'Expirando',
            self::WORKING  => 'Em Andamento',
            self::CLOSED   => 'Finalizado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::EXPIRED  => 'secondary',
            self::EXPIRING => 'warning',
            self::WORKING  => 'success',
            self::CLOSED   => 'secondary',
        };
    }
}
