<?php

declare(strict_types=1);

namespace App\Enums;

enum QuotationStatus: int
{
    case PENDING = 'En Attente';
    case SENT = 'Envoyé';
    case CANCELED = 'Annulé';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
