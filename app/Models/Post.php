<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Fields
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string|null $image
 * @property string|null $excerpt
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * Relationships
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 *
 * Scopes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post filter(array $filters = [])
 *
 * Attribute Casting
 * @property-read bool $is_draft
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
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

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Filters only published posts.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now());
    }

    /**
     * Filter posts by multiple criteria
     *
     * @param Builder $query
     * @param array $filter
     * @return Builder
     */
    public function scopeFilter(Builder $query, array $filter = []): Builder
    {
        if (!empty($filter['search'])) {
            return $query
                ->where('title', 'LIKE', "%{$filter['search']}%")
                ->orWhere('body', 'LIKE', "%{$filter['search']}%");
        }

        return $query;
    }

    /**
     * @return Attribute
     */
    public function isDraft(): Attribute
    {
        return new Attribute(
            get: fn() => is_null($this->published_at) || $this->published_at >= now()
        );
    }
}
