<?php

declare(strict_types=1);

namespace App\Enums;

enum QuotationStatus: int
{
    case Pending = 'En Attente';
    case Sent = 'Envoyé';
    case Canceled = 'Annulé';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
