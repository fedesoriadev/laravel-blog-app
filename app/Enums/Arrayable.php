<?php

namespace App\Enums;

interface Arrayable
{
    /**
     * Returns enum cases as an array of name strings
     *
     * @return array
     */
    public static function toArray(): array;
}
