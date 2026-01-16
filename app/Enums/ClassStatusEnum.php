<?php

declare(strict_types = 1);

namespace App\Enums;

enum ClassStatusEnum: string
{
    case SCHEDULED = 'scheduled';
    case PRESENCE  = 'presence';
    case ABSENSE   = 'absense';
    case JUSTIFIED = 'justified';
    case CANCELED  = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::SCHEDULED => 'Agendada',
            self::PRESENCE  => 'Presença',
            self::ABSENSE   => 'Falta',
            self::JUSTIFIED => 'Falta Com Aviso',
            self::CANCELED  => 'Falta Professor',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::SCHEDULED => 'blue',
            self::PRESENCE  => 'success',
            self::ABSENSE   => 'danger',
            self::JUSTIFIED => 'warning',
            self::CANCELED  => 'secondary',
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
