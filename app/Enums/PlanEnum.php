<?php

declare(strict_types = 1);

namespace App\Enums;

//  30  => 'Mensal',
//         60  => 'Bimestral',
//         90  => 'Trimestral',
//         120 => 'Quadrimestral',
//         180 => 'Semestral',
//         365 => 'Anual',    monthly bimonthly quarterly four-monthly semiannual annual

enum PlanEnum: int
{

    case MONTHLY = 30;
    case BIMONTHLY  = 60;
    case QUARTELY   = 90;
    case FOURMONTHLY = 120;
    case SEMIANNUAL  = 180;
    case ANNUAL  = 365;

    public function label(): string
    {
        return match ($this) {
            self::MONTHLY => 'Mensal',
            self::BIMONTHLY => 'Bimestral',
            self::QUARTELY => 'Trimestral',
            self::FOURMONTHLY => 'Quadrimestral',
            self::SEMIANNUAL => 'Semestral',
            self::ANNUAL => 'Anual',
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
