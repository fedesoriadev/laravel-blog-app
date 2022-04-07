<?php

namespace App\Enums;

enum UserRole: string implements Arrayable {
    case ADMIN = 'admin';
    case AUTHOR = 'author';

    /**
     * @return string
     */
    public function background(): string
    {
        return match ($this) {
            self::ADMIN => 'bg-indigo-100',
            self::AUTHOR => 'bg-sky-100',
        };
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
