<?php

namespace App\Enums;

enum Language:string implements Arrayable
{
    case EN = 'en';
    case ES = 'es';

    /**
     * @return string
     */
    public function toUpper(): string
    {
        return strtoupper($this->value);
    }

    /**
     * @return array
     */
    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
