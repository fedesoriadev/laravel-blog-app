<?php

namespace App\Enums;

enum AlertType: string implements Arrayable
{
    case SUCCESS = 'success';
    case DANGER = 'danger';
    case WARNING = 'warning';
    case INFO = 'info';
    case DEFAULT = 'default';

    /**
     * @return string
     */
    public function containerClasses(): string
    {
        return match ($this) {
            self::SUCCESS => 'bg-green-100 text-green-700',
            self::DANGER => 'bg-red-100 text-red-700',
            self::WARNING => 'bg-yellow-100 text-yellow-700',
            self::INFO => 'bg-blue-100 text-blue-700',
            default => 'bg-gray-100 text-gray-700'
        };
    }

    /**
     * @return string
     */
    public function closeButtonClasses(): string
    {
        return match ($this) {
            self::SUCCESS => 'text-green-500 focus:ring-green-400 hover:bg-green-200',
            self::DANGER => 'text-red-500 focus:ring-red-400 hover:bg-red-200',
            self::WARNING => 'text-yellow-500 focus:ring-yellow-400 hover:bg-yellow-200',
            self::INFO => 'text-blue-500 focus:ring-blue-400 hover:bg-blue-200',
            self::DEFAULT => 'text-gray-500 focus:ring-gray-400 hover:bg-gray-200',
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
