<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatus: int
{
    case PENDING = 'En Attente';
    case COMPLETE = 'Complété';
    case CANCEL = 'Annulé';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
