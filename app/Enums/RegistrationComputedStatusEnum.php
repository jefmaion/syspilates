<?php

declare(strict_types=1);

namespace App\Enums;

enum RegistrationComputedStatusEnum: string
{
    case EXPIRED  = 'expired';
    case EXPIRING = 'expiring';
    case WORKING  = 'working';
    case CLOSED   = 'closed';
    case TODAY   = 'today';

    public function label($prep = null): string
    {
        return match ($this) {
            self::EXPIRED  => 'Expirado' . $prep,
            self::EXPIRING => 'Expirando' . $prep,
            self::WORKING  => 'Em Andamento' . $prep,
            self::CLOSED   => 'Finalizado' . $prep,
            self::TODAY   => 'Vence Hoje' . $prep,
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::EXPIRED  => 'secondary',
            self::EXPIRING => 'warning',
            self::WORKING  => 'success',
            self::CLOSED   => 'secondary',
            self::TODAY   => 'warning',
        };
    }
}
