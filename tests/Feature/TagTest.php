<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_a_tag_with_its_posts(): void
    {
        $tag = Tag::factory()->create();

        $tag->posts()->sync(Post::factory(2)->create());

        $response = $this->get(route('tags.show', $tag->slug));

        $response->assertOk();

        $response->assertSee($tag->name);

        $this->assertCount(2, $tag->posts);
    }
}
