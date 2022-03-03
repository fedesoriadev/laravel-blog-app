<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'published_at',
        'image',
        'excerpt',
        'body'
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'published_at' => 'datetime'
    ];
}
