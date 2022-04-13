<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class ShowPostsByAuthorTest extends TestCase
{
    /** @test */
    public function it_shows_posts_of_an_author(): void
    {
        $author = User::factory()->author()->create();

        $author
            ->posts()
            ->saveMany(
                Post::factory(3)
                    ->published()
                    ->create()
            );

        $this
            ->get(route('authors.show', $author->username))
            ->assertOk()
            ->assertSee($author->name)
            ->assertViewHasAll(['author', 'posts']);

        $this->assertCount(3, $author->posts);
    }
}
