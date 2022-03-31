<?php

namespace App\Enums;

enum UserRole: string implements Arrayable {
    case ADMIN = 'admin';
    case AUTHOR = 'author';

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
