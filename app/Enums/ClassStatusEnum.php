<?php

declare(strict_types = 1);

namespace App\Enums;

enum ClassStatusEnum: string
{
    case SCHEDULED = 'scheduled';
    case PRESENCE  = 'presence';
    case ABSENSE   = 'absense';
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

    public static function toSelectArray(): array
    {
        $array = [];

        foreach (self::cases() as $case) {
            $array[$case->value] = $case->label(); // Use $case->value for the key and $case->name for the label
        }

        return $array;
    }
}
