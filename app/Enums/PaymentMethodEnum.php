<?php

declare(strict_types = 1);

namespace App\Enums;

enum PaymentMethodEnum: string
{
    case DEBIT    = 'debit';
    case CREDIT   = 'credit';
    case PIX      = 'pix';
    case MONEY    = 'money';
    case TRANSFER = 'transfer';

    public function label(): string
    {
        return match ($this) {
            self::DEBIT    => 'Cartão Débito',
            self::CREDIT   => 'Cartão Crédito',
            self::PIX      => 'Pix',
            self::MONEY    => 'Dinheiro',
            self::TRANSFER => 'Transferência',
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
