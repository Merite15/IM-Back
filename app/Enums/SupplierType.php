<?php

declare(strict_types=1);

namespace App\Enums;

enum SupplierType: string
{
    case DISTRIBUTOR = 'distributor';

    case WHOLESALER = 'wholesaler';

    case PRODUCER = 'producer';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
