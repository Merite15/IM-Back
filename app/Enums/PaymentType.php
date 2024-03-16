<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentType: int
{
    case CASH = 'cash';
    case CARD = 'card';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
