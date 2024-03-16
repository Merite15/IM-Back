<?php

declare(strict_types=1);

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'En Attente';
    case Complete = 'Complété';
    case Cancel = 'Annulé';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
