<?php

namespace Tests\Feature;

use App\Enums\Pagination;
use App\Models\Post;
use Carbon\Carbon;
use Tests\TestCase;

class PublishedPostsTest extends TestCase
{
    /** @test */
    public function it_shows_a_list_of_published_posts_only(): void
    {
        $publishedPost = Post::factory()->published()->create();

        $draftPost = Post::factory()->draft()->create();

        $response = $this
            ->get('/')
            ->assertOk()
            ->assertSee($publishedPost->title)
            ->assertDontSee($draftPost->title);

        $this->assertCount(1, $response['posts']);
    }

    /** @test */
    public function it_lists_posts_ordered_by_published_date(): void
    {
        Post::factory()
            ->published(Carbon::createFromDate(2022, 1, 1))
            ->create(['title' => 'Post A']);

        Post::factory()
            ->published(Carbon::createFromDate(2022, 2, 1))
            ->create(['title' => 'Post B']);

        Post::factory()
            ->published(now()->addWeek())
            ->create(['title' => 'Post C']);

        $this
            ->get('/')
            ->assertSeeInOrder(['Post B', 'Post A'])
            ->assertDontSee('Post C');

        $this->travel(2)->weeks();

        $this
            ->get('/')
            ->assertSeeInOrder(['Post C', 'Post B', 'Post A']);
    }

    /** @test */
    public function it_paginates_a_list_of_posts(): void
    {
        $posts = Post::factory(Pagination::FRONT->value + 1)
            ->published()
            ->create();

        $this
            ->get('/')
            ->assertOk()
            ->assertSeeTextInOrder($posts->take(Pagination::FRONT->value)->pluck('title')->all())
            ->assertDontSee($posts->last()->title);

        $this
            ->get('/?page=2')
            ->assertOk()
            ->assertSeeText($posts->last()->title);
    }

    /** @test */
    public function it_shows_a_published_post(): void
    {
        $publishedPost = Post::factory()->published()->create();

        $this
            ->get(route('posts.show', $publishedPost->slug))
            ->assertOk()
            ->assertSee($publishedPost->title);
    }

    /** @test */
    public function it_denies_access_to_unpublished_posts(): void
    {
        $draftPost = Post::factory()->draft()->create();

        $this
            ->get(route('posts.show', $draftPost->slug))
            ->assertForbidden();
    }
}
