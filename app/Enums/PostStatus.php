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
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this === self::PUBLISHED;
    }

    /**
     * @return string
     */
    public function background(): string
    {
        return match ($this) {
            self::DRAFT => 'bg-gray-400',
            self::PUBLISHED => 'bg-green-400',
            self::ARCHIVED => 'bg-red-400',
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
