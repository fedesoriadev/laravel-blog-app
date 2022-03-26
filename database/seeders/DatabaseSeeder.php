<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
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
        User::factory()
            ->admin()
            ->create([
                'email'    => 'admin@admin.com',
                'username' => 'admin',
                'name'     => 'Admin'
            ]);

        /** @var \Illuminate\Database\Eloquent\Collection $authors */
        $authors = User::factory(3)
            ->editor()
            ->create();

        $tags = Tag::factory(5)->create();

        Post::factory(100)
            ->sequence(
                ['user_id' => $authors[0]->id],
                ['user_id' => $authors[1]->id],
                ['user_id' => $authors[2]->id],
            )
            ->published()
            ->create()
            ->each(fn(Post $post) => $post->tags()->sync($tags->random()));
    }
}
