<?php

declare(strict_types = 1);

namespace App\Enums;

enum WeekdaysEnum: int
{
    case SUNDAY    = 0;
    case MONDAY    = 1;
    case TUESDAY   = 2;
    case WEDNESDAY = 3;
    case THURSDAY  = 4;
    case FRIDAY    = 5;
    case SATURDAY  = 6;

    public function label(): string
    {
        return match ($this) {
            self::SUNDAY    => 'Domingo',
            self::MONDAY    => 'Segunda-feira',
            self::TUESDAY   => 'Terça-feira',
            self::WEDNESDAY => 'Quarta-feira',
            self::THURSDAY  => 'Quinta-feira',
            self::FRIDAY    => 'Sexta-feira',
            self::SATURDAY  => 'Sábado',
        };
    }

    public function short(): string
    {
        return match ($this) {
            self::SUNDAY    => substr(self::SUNDAY->label(), 0, 3),
            self::MONDAY    => substr(self::MONDAY->label(), 0, 3),
            self::TUESDAY   => substr(self::TUESDAY->label(), 0, 3),
            self::WEDNESDAY => substr(self::WEDNESDAY->label(), 0, 3),
            self::THURSDAY  => substr(self::THURSDAY->label(), 0, 3),
            self::FRIDAY    => substr(self::FRIDAY->label(), 0, 3),
            self::SATURDAY  => substr(self::SATURDAY->label(), 0, 3),
        };
    }
}
