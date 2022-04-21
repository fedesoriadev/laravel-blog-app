<?php

namespace App\Models;

use App\Enums\UserRole;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
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
 * @property string|null $profile_picture
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withRole(\App\Enums\UserRole|string|null $role)
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
        'profile_picture',
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
     * @param array $attributes
     * @param \Carbon\Carbon|null $emailVerifiedAt
     * @return static
     */
    public static function createVerified(array $attributes = [], Carbon $emailVerifiedAt = null): self
    {
        $attributes['email_verified_at'] = $emailVerifiedAt ?? now();

        return self::create($attributes);
    }

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
     * @param \App\Enums\UserRole|string|null $role
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithRole(Builder $query, mixed $role): Builder
    {
        if (!$role) {
            return $query;
        }

        if (is_string($role) && !$role = UserRole::tryFrom($role)) {
            return $query;
        }

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
     * @param \Illuminate\Http\UploadedFile $profilePicture
     * @return void
     */
    public function uploadProfilePicture(UploadedFile $profilePicture): void
    {
        $this->update([
            'profile_picture' => $profilePicture->storePublicly('profile', ['disk' => 'public'])
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function profilePicture(): Attribute
    {
        return Attribute::get(function ($value) {
            return is_null($value) || str_starts_with($value, 'http') ? $value : asset('storage/' . $value);
        });
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function password(): Attribute
    {
        return Attribute::set(fn($plainPassword) => Hash::make($plainPassword));
    }

    /**
     * @return string
     */
    public function adminRoute(): string
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
