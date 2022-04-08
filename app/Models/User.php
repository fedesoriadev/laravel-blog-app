<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Fields
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $avatar
 * @property string|null $about_me
 * @property string|null $twitter
 * @property string|null $youtube
 * @property string|null $twitch
 * @property string|null $github
 *
 * Relationships
 * @property-read \App\Models\Role[] $role
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 *
 * Scopes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withRole(\App\Enums\UserRole $role)
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'role_id',
        'password',
        'email_verified_at',
        'avatar',
        'about_me',
        'twitter',
        'youtube',
        'twitch',
        'github'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Enums\UserRole $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithRole(Builder $query, UserRole $role): Builder
    {
        return $query->whereHas('role', function (Builder $query) use ($role) {
            return $query->where('name', $role->value);
        });
    }

    /**
     * @param \App\Enums\UserRole $role
     * @return bool
     */
    public function hasRole(UserRole $role): bool
    {
        return $this->role?->name === $role;
    }

    /**
     * @return string
     */
    public function home(): string
    {
        if ($this->role?->name === UserRole::ADMIN) {
            return route('admin.home');
        }

        if ($this->role?->name === UserRole::AUTHOR) {
            return route('posts.index');
        }

        return route('home');
    }
}
