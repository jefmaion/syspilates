<?php

declare(strict_types = 1);

namespace App\Enums;

enum GenderEnum: string
{
    case MALE   = 'M';
    case FEMALE = 'F';
    case OTHERS = 'O';

    public function label(): string
    {
        return match ($this) {
            self::MALE   => 'Masculino',
            self::FEMALE => 'Feminino',
            self::OTHERS => 'Outro',
        };
    }
}
