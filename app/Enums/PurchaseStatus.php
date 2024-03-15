<?php

namespace App\Enums;

enum PurchaseStatus: int
{
    case PENDING = 0;
    case APPROVED = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
