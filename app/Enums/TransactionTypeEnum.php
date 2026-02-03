<?php

declare(strict_types = 1);

namespace App\Enums;

enum TransactionTypeEnum: string
{
    case DEBIT  = 'D';
    case CREDIT = 'C';

    public function label(): string
    {
        return match ($this) {
            self::DEBIT  => 'Despesas',
            self::CREDIT => 'Receitas',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::DEBIT  => 'danger',
            self::CREDIT => 'teal',
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
