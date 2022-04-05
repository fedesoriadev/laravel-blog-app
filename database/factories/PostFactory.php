<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(PostStatus::cases());

        return [
            'user_id' => User::factory(),
            'title'   => $this->faker->sentence(),
            'image'   => 'https://picsum.photos/seed/' . Str::random(8) . '/1600/700',
            'excerpt' => $this->faker->sentence(20),
            'body'    => File::get(database_path('factories/stubs/post_body.md')),
            'status'  => $status->value,
            'date'    => $status->isPublished() ? now() : null,
        ];
    }

    /**
     * @param \Carbon\Carbon|null $timestamp
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function published(Carbon $timestamp = null ): Factory
    {
        return $this->state(fn(array $attributes) => [
            'status' => PostStatus::PUBLISHED,
            'date' => $timestamp ?? now()
        ]);
    }

    /**
     * @return Factory
     */
    public function draft(): Factory
    {
        return $this->state(fn(array $attributes) => [
            'status' => PostStatus::DRAFT,
            'date' => null
        ]);
    }

    /**
     * @return Factory
     */
    public function archived(): Factory
    {
        return $this->state(fn(array $attributes) => [
            'status' => PostStatus::ARCHIVED,
            'date' => now()->subDays($this->faker->numberBetween(1, 15))
        ]);
    }
}
