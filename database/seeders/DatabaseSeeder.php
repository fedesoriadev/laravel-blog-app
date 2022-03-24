<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        /** @var \Illuminate\Database\Eloquent\Collection $authors */
        $authors = User::factory(3)
            ->editor()
            ->create();

        Post::factory(100)
            ->sequence(
                ['user_id' => $authors[0]->id],
                ['user_id' => $authors[1]->id],
                ['user_id' => $authors[2]->id],
            )
            ->published()
            ->create();
    }
}
