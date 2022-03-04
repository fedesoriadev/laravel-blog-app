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

        $response->assertStatus(200);

        $response->assertJsonCount(1);
    }
}
