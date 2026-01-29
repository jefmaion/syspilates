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
            self::PRESENCE  => 'teal',
            self::ABSENSE   => 'danger',
            self::JUSTIFIED => 'warning',
            self::CANCELED  => 'secondary',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::SCHEDULED => 'icons.clock',
            self::PRESENCE  => 'icons.success',
            self::ABSENSE   => 'icons.times',
            self::JUSTIFIED => 'icons.exclamation',
            self::CANCELED  => 'icons.times',
        };
    }

    public static function filter($value)
    {
        $filtered = array_filter(self::cases(), function ($item) use ($value) {
            return ($item->label() == $value) ? $item->value : null;
        });

        if ($filtered) {
            return array_shift($filtered)->value;
        }

        return null;
    }

    public static function toSelectArray($except = []): array
    {
        $array = [];

        foreach (self::cases() as $case) {
            if (in_array($case, $except)) {
                continue;
            }

            $array[$case->value] = $case->label(); // Use $case->value for the key and $case->name for the label
        }

        return $array;
    }
}
