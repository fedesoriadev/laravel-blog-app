<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            if (!$model->slug) {
                $model->slug = self::generateSlug($model);
            }
        });
    }

    private static function generateSlug(Model $model): string
    {
        $slug = Str::slug($model->title ?? $model->name);
        $iteration = 1;

        while (static::where('slug', $slug)->exists()) {
            $iteration++;
            $slug = "$slug-$iteration";
        }

        return $slug;
    }
}
