<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Exceptions\AlreadyArchivedException;
use App\Exceptions\AlreadyPublishedException;
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
 * @property string|null $image
 * @property string|null $excerpt
 * @property string $body
 * @property \App\Enums\PostStatus $status
 * @property \Illuminate\Support\Carbon|null $date
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post withStatus(\App\Enums\PostStatus|string|null $status)
 *
 * Casts
 * @property-read string|null $cover_image
 * @property-read string $seo_cover_image
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Post extends Model
{
    use HasFactory, HasSlug;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'excerpt',
        'body',
        'status',
        'date',
    ];

    /**
     * @inheritdoc
     */
    protected $casts = [
        'status' => PostStatus::class,
        'date'   => 'date'
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
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Filters only published posts.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('date', '<=', now())
            ->where('status', PostStatus::PUBLISHED->value)
            ->latest('date');
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

        if (!empty($filter['user_id'])) {
            return $query
                ->where('user_id', $filter['user_id']);
        }

        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Enums\PostStatus|string|null $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithStatus(Builder $query, mixed $status): Builder
    {
        if (!$status) {
            return $query;
        }

        if (is_string($status) && !$status = PostStatus::tryFrom($status)) {
            return $query;
        }

        return $query->where('status', $status->value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function coverImage(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            if (!isset($attributes['image'])) {
                return null;
            }

            return str_starts_with($attributes['image'], 'http')
                ? $attributes['image']
                : asset('storage/' . $attributes['image']);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function seoCoverImage(): Attribute
    {
        return Attribute::get(fn() => $this->cover_image ?? asset('img/site_cover.jpg'));
    }

    /**
     * @param string|null $date
     * @return $this
     * @throws \App\Exceptions\AlreadyPublishedException
     */
    public function publish(string $date = null): self
    {
        if ($this->status->isPublished()) {
            throw new AlreadyPublishedException;
        }

        $this->update(['status' => PostStatus::PUBLISHED, 'date' => $date ?? now()]);

        return $this;
    }

    /**
     * @return $this
     * @throws \App\Exceptions\AlreadyArchivedException
     */
    public function archive(): self
    {
        if ($this->status === PostStatus::ARCHIVED) {
            throw new AlreadyArchivedException;
        }

        $this->update(['status' => PostStatus::ARCHIVED]);

        return $this;
    }
}
