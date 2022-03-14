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
        Post::factory()->create();

        Post::factory()->draft()->create();

        $this
            ->get('/')
            ->assertOk()
            ->assertJsonCount(1);
    }

    /** @test */
    public function it_searches_posts_by_keyword(): void
    {
        Post::factory()->create(['title' => 'This post talks about Laravel']);

        Post::factory()->create(['title' => 'Unrelated sports post']);

        Post::factory()->create([
            'title' => 'Post about Symfony',
            'body'  => 'But Laravel is mentioned in the body'
        ]);

        $this
            ->get('/?search=Laravel')
            ->assertOk()
            ->assertJsonCount(2);
    }

    /** @test */
    public function it_shows_a_published_post(): void
    {
        $publishedPost = Post::factory()->create();

        $this
            ->get(route('posts.show', $publishedPost->slug))
            ->assertOk()
            ->assertSee($publishedPost->title);
    }

    /** @test */
    public function it_denies_access_to_unpublished_posts(): void
    {
        $unpublishedPost = Post::factory()->draft()->create();

        $this
            ->get(route('posts.show', $unpublishedPost->slug))
            ->assertForbidden();
    }

    /** @test */
    public function it_shows_posts_of_an_author(): void
    {
        $author = User::factory()->create();

        $author
            ->posts()
            ->saveMany(Post::factory(3)->create());

        $this
            ->get(route('authors.show', $author->username))
            ->assertOk()
            ->assertSee($author->name);

        $this->assertCount(3, $author->posts);
    }
}
