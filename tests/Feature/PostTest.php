<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_blog_index_only_shows_published_posts(): void
    {
        Post::factory()->create();

        Post::factory()->draft()->create();

        $response = $this->get('/');

        $response->assertOk();

        $response->assertJsonCount(1);
    }

    /** @test */
    public function search_posts_by_keyword_present_in_the_title_or_body(): void
    {
        Post::factory()->create(['title' => 'This post talks about Laravel']);

        Post::factory()->create(['title' => 'Unrelated sports post']);

        Post::factory()->create(['title' => 'Post about Symfony', 'body' => 'But Laravel is mentioned in the body']);

        $response = $this->get('/?search=Laravel');

        $response->assertOk();

        $response->assertJsonCount(2);
    }

    /** @test */
    public function it_shows_a_published_post(): void
    {
        $publishedPost = Post::factory()->create();

        $response = $this->get(route('posts.show', $publishedPost->slug));

        $response->assertOk();

        $response->assertSee($publishedPost->title);
    }

    /** @test */
    public function show_an_unpublished_post_is_forbidden(): void
    {
        $unpublishedPost = Post::factory()->draft()->create();

        $response = $this->get(route('posts.show', $unpublishedPost->slug));

        $response->assertForbidden();
    }
}
