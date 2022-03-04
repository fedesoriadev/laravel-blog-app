<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $tag = $this->faker->sentence(Arr::random([1, 2]));

        return [
            'name'        => Str::title($tag),
            'slug'        => Str::slug($tag),
            'description' => $this->faker->sentence()
        ];
    }
}
