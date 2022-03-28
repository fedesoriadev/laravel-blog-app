<?php

namespace App\Enums;

enum Pagination: int implements Arrayable
{
    case FRONT = 10;
    case ADMIN = 20;

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
