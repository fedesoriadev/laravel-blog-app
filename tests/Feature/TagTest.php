<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_show_a_tag_with_its_posts(): void
    {
        $tag = Tag::factory()->create();

        $tag->posts()->sync(Post::factory(2)->create());

        $response = $this->get("/tags/$tag->slug");

        $response->assertOk();

        $response->assertSee($tag->name);

        $this->assertCount(2, $tag->posts);
    }

    /** @test */
    public function it_makes_me_cry(): void
    {
        $this->assertTrue(true);
    }
}
