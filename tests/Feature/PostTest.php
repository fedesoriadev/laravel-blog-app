<?php

namespace Tests\Feature;

use App\Enums\Pagination;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
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
