<?php

declare(strict_types = 1);

namespace App\Enums;

enum ClassTypesEnum: string
{
    case REGULAR      = 'regular';
    case MAKEUP       = 'makeup';
    case EXPERIMENTAL = 'experimental';
    case SINGLE       = 'single';

    public function label(): string
    {
        return match ($this) {
            self::REGULAR      => 'Aula Normal',
            self::MAKEUP       => 'Reposição',
            self::EXPERIMENTAL => 'Experimental',
            self::SINGLE       => 'Aula Avulsa',
        };
    }

    public function nick(): string
    {
        return match ($this) {
            self::REGULAR      => '',
            self::MAKEUP       => 'REP',
            self::EXPERIMENTAL => 'EXP',
            self::SINGLE       => 'AVU',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::REGULAR      => 'white',
            self::MAKEUP       => 'info',
            self::EXPERIMENTAL => 'purple',
            self::SINGLE       => 'gray',
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
