<?php

declare(strict_types=1);

namespace App\Enums;

enum PurchaseStatus: int
{
    case Pending = 'En Attente';
    case Approved = 'Approuvé';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
