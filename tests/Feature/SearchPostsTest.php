<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;

class SearchPostsTest extends TestCase
{
    /** @test */
    public function it_searches_posts_by_keyword(): void
    {
        Post::factory()
            ->count(3)
            ->published()
            ->sequence(
                ['title' => 'This post talks about Laravel'],
                ['title' => 'Unrelated sports post'],
                ['title' => 'Post about Symfony', 'body' => 'But Laravel is mentioned in the body']
            )
            ->create();

        $response = $this
            ->get('/?search=Laravel')
            ->assertOk()
            ->assertSee("We found 2 posts");

        $this->assertCount(2, $response['posts']);
    }
}
