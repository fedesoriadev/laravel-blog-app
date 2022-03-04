<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_blog_index_only_shows_published_posts()
    {
        Post::factory()->create();

        Post::factory()->draft()->create();

        $response = $this->get('/');

        $response->assertOk();

        $response->assertJsonCount(1);
    }

    public function test_show_a_published_post()
    {
        $publishedPost = Post::factory()->create();

        $response = $this->get("/posts/$publishedPost->slug");

        $response->assertOk();

        $response->assertSee($publishedPost->title);
    }

    public function test_show_an_unpublished_post_is_forbidden()
    {
        $unpublishedPost = Post::factory()->draft()->create();

        $response = $this->get("/posts/$unpublishedPost->slug");

        $response->assertForbidden();
    }
}
