<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function it_shows_a_list_of_published_posts_only(): void
    {
        Post::factory()->published()->create();

        Post::factory()->draft()->create();

        $this
            ->get('/')
            ->assertOk()
            ->assertJsonCount(1);
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

        $this
            ->get('/?search=Laravel')
            ->assertOk()
            ->assertJsonCount(2);
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
        $author = User::factory()->editor()->create();

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
            ->assertSee($author->name);

        $this->assertCount(3, $author->posts);
    }
}
