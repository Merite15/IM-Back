<?php

declare(strict_types=1);

namespace App\Enums;

enum UserGender: string
{
    case M = 'M';
    case F = 'F';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
