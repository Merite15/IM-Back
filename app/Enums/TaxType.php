<?php

declare(strict_types=1);

namespace App\Enums;

enum TaxType: string
{
    case CA = 'CA';
    case TVA = 'TVA';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
