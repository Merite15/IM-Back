<?php

namespace App\Enums;

enum OrderStatus: int
{
    case PENDING = 0;
    case COMPLETE = 1;
    case CANCEL = 2;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
