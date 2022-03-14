<?php

namespace Database\Factories;

use App\Models\User;
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
        return [
            'user_id'      => User::factory(),
            'title'        => $this->faker->sentence(),
            'published_at' => now(),
            'image'        => 'https://picsum.photos/seed/' . Str::random(8) . '/1600/700',
            'excerpt'      => $this->faker->sentence(10),
            'body'         => File::get(database_path('factories/stubs/post_body.md'))
        ];
    }

    /**
     * Indicate that the post is a draft or is unpublished
     *
     * @return Factory
     */
    public function draft(): Factory
    {
        return $this->state(fn(array $attributes) => ['published_at' => null]);
    }
}
