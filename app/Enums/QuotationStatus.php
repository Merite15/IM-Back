<?php

declare(strict_types=1);

namespace App\Enums;

enum QuotationStatus: int
{
    case PENDING = 0;
    case SENT = 1;
    case CANCELED = 2;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
