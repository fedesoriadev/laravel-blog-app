<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $username = $this->faker->userName();

        return [
            'name'              => $this->faker->name(),
            'username'          => $username,
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => 'password',
            'remember_token'    => Str::random(10),
            'profile_picture'   => 'https://i.pravatar.cc/150?u=' . $username,
            'about_me'          => $this->faker->sentence(20),
            'twitter'           => 'https://twitter.com/' . $username,
            'youtube'           => 'https://www.youtube.com/' . $username,
            'twitch'            => 'https://www.twitch.tv/' . $username,
            'github'            => 'https://github.com/' . $username,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * @return $this
     */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [])->afterCreating(function (User $user) {
            Role::firstOrCreate(['name' => UserRole::ADMIN])
                ->users()
                ->save($user);
        });
    }

    /**
     * @return $this
     */
    public function author(): static
    {
        return $this->state(fn(array $attributes) => [])->afterCreating(function (User $user) {
            Role::firstOrCreate(['name' => UserRole::AUTHOR])
                ->users()
                ->save($user);
        });
    }
}
