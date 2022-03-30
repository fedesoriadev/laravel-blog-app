<?php

namespace App\Enums;

enum PostStatus: string implements Arrayable
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    /**
     * @return bool
     */
    public function isPubliclyAccessible(): bool
    {
        return match ($this) {
            self::DRAFT, self::ARCHIVED => false,
            self::PUBLISHED => true,
        };
    }

    /**
     * @return string
     */
    public function color(): string
    {
        return match ($this) {
            self::DRAFT => 'bg-gray-500',
            self::PUBLISHED => 'bg-green-500',
            self::ARCHIVED => 'bg-red-500',
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
