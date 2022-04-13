<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Tests\TestCase;

class ShowPostsByTagTest extends TestCase
{
    /** @test */
    public function it_shows_a_tag_with_its_posts(): void
    {
        $tag = Tag::factory()->create();

        $this->assertEquals($tag->slug, Str::slug($tag->name));

        $tag
            ->posts()
            ->sync(Post::factory(2)->create());

        $this
            ->get(route('tags.show', $tag->slug))
            ->assertOk()
            ->assertSee($tag->name);

        $this->assertCount(2, $tag->posts);
    }
}
