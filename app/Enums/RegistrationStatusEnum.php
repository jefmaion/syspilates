<?php

declare(strict_types = 1);

namespace App\Enums;

enum RegistrationStatusEnum: string
{
    case ACTIVE    = 'A';
    case CANCELED  = 'C';
    case FINALIZED = 'F';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE    => 'Ativo',
            self::CANCELED  => 'Cancelado',
            self::FINALIZED => 'Finalizado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE    => 'success',
            self::CANCELED  => 'warning',
            self::FINALIZED => 'secondary',
        };
    }
}
