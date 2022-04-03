<?php

namespace App\Enums;

enum AlertType
{
    case SUCCESS;
    case DANGER;
    case WARNING;
    case INFO;
    case DEFAULT;

    /**
     * @return string
     */
    public function containerClasses(): string
    {
        return match ($this) {
            self::SUCCESS => 'bg-green-100 text-green-700 dark:bg-green-200 dark:text-green-800',
            self::DANGER => 'bg-red-100 text-red-700 dark:bg-red-200 dark:text-red-800',
            self::WARNING => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-200 dark:text-yellow-800',
            self::INFO => 'bg-blue-100 text-blue-700 dark:bg-blue-200 dark:text-blue-800',
            default => 'bg-gray-100 text-gray-700 dark:bg-gray-200 dark:text-gray-800'
        };
    }

    /**
     * @return string
     */
    public function closeButtonClasses(): string
    {
        return match ($this) {
            self::SUCCESS => 'text-green-500 focus:ring-green-400 hover:bg-green-200 dark:text-green-600 dark:hover:bg-green-300',
            self::DANGER => 'text-red-500 focus:ring-red-400 hover:bg-red-200 dark:text-red-600 dark:hover:bg-red-300',
            self::WARNING => 'text-yellow-500 focus:ring-yellow-400 hover:bg-yellow-200 dark:text-yellow-600 dark:hover:bg-yellow-300',
            self::INFO => 'text-blue-500 focus:ring-blue-400 hover:bg-blue-200 dark:text-blue-600 dark:hover:bg-blue-300',
            self::DEFAULT => 'text-gray-500 focus:ring-gray-400 hover:bg-gray-200 dark:text-gray-600 dark:hover:bg-gray-300',
        };
    }
}
