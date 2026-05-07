<?php

declare(strict_types=1);

namespace App\Enums;

enum ComissionTypeEnum: string
{
    case PERCENT  = 'percent';
    case FIXED = 'fixed';
    case TIME = 'hour';

    public function label(): string
    {
        return match ($this) {
            self::PERCENT  => 'Percentual (%)',
            self::FIXED => 'Valor Fixo',
            self::TIME => 'Hora Aula',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::PERCENT  => '%',
            self::FIXED => 'R$',
            self::TIME => 'R$',
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
