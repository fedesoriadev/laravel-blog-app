<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()
            ->admin()
            ->create([
                'email'    => 'admin@admin.com',
                'username' => 'admin',
                'name'     => 'Admin'
            ]);

        $authors = User::factory(3)
            ->author()
            ->create();

        $commenters = User::factory(10)->create();

        $tags = Tag::factory(5)->create();

        Post::factory(50)
            ->sequence(fn(Sequence $sequence) => ['user_id' => $authors->random()->id])
            ->has(
                Comment::factory(5)->sequence(fn(Sequence $sequence) => ['user_id' => $commenters->random()->id])
            )
            ->published()
            ->create()
            ->each(fn(Post $post) => $post->tags()->sync($tags->random()));

        Post::factory(10)
            ->sequence(fn(Sequence $sequence) => ['user_id' => $authors->random()->id])
            ->draft()
            ->create()
            ->each(fn(Post $post) => $post->tags()->sync($tags->random()));

        Post::factory(10)
            ->sequence(fn(Sequence $sequence) => ['user_id' => $authors->random()->id])
            ->archived()
            ->create()
            ->each(fn(Post $post) => $post->tags()->sync($tags->random()));
    }
}
