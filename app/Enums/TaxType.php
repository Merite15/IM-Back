<?php

namespace App\Enums;

enum TaxType: int
{
    case EXCLUSIVE = 0;
    case INCLUSIVE = 1;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
