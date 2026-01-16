<?php

declare(strict_types = 1);

namespace App\Enums;

enum ClassTypesEnum: string
{
    case NORMAL       = 'aula normal';
    case REPOSITION   = 'reposicao';
    case EXPERIMENTAL = 'experimental';
    case SINGLE       = 'avulsa';

    public function label(): string
    {
        return match ($this) {
            self::NORMAL       => 'Aula Normal',
            self::REPOSITION   => 'Reposição',
            self::EXPERIMENTAL => 'Experimental',
            self::SINGLE       => 'Aula Avulsa',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::NORMAL       => 'primary',
            self::REPOSITION   => 'success',
            self::EXPERIMENTAL => 'warning',
            self::SINGLE       => 'purple',
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
