<?php

namespace Tests\Unit;

use App\Enums\PostStatus;
use App\Exceptions\AlreadyArchivedException;
use App\Exceptions\AlreadyPublishedException;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function it_generates_a_slug_if_not_present(): void
    {
        $postA = Post::factory()->create(['title' => 'Post A', 'slug' => 'post-a']);
        $this->assertEquals('post-a', $postA->slug);
        $this->assertDatabaseHas('posts', ['slug' => 'post-a']);

        $postB = Post::factory()->create(['title' => 'Post B']);
        $this->assertEquals('post-b', $postB->slug);
        $this->assertDatabaseHas('posts', ['slug' => 'post-b']);

        $postSameTitleAsPostB = Post::factory()->create(['title' => 'Post B']);
        $this->assertEquals('post-b-2', $postSameTitleAsPostB->slug);
        $this->assertDatabaseHas('posts', ['slug' => 'post-b-2']);
    }

    /** @test */
    public function it_filters_only_published_posts(): void
    {
        Post::factory(3)->draft()->create();
        Post::factory(2)->archived()->create();
        Post::factory(5)->published()->create();

        $this->assertDatabaseCount('posts', 10);
        $this->assertCount(5, Post::published()->get());
    }

    /** @test */
    public function it_filters_posts_by_keyword_on_title_or_body(): void
    {
        Post::factory(4)->sequence(
            ['title' => 'Post title KEYWORD'],
            ['title' => 'Some post title'],
            ['body' => 'Body containing KEYWORD'],
            ['body' => 'Some body content']
        )->create();

        $this->assertCount(4, Post::all());
        $this->assertCount(4, Post::filter([])->get());
        $this->assertCount(4, Post::filter(['NOT-EXISTING-KEYWORD' => 'ABC'])->get());
        $this->assertCount(0, Post::filter(['search' => 'ZERO-RESULTS-KEYWORD'])->get());
        $this->assertCount(2, Post::filter(['search' => 'KEYWORD'])->get());
    }

    /** @test */
    public function it_filters_posts_by_user_id(): void
    {
        $authorA = User::factory()->author()->create();
        Post::factory()->create(['user_id' => $authorA->id]);

        $authorB = User::factory()->author()->create();
        Post::factory()->create(['user_id' => $authorB->id]);

        $this->assertCount(2, Post::all());
        $this->assertCount(2, Post::filter([])->get());
        $this->assertCount(1, Post::filter(['user_id' => 1])->get());
        $this->assertCount(0, Post::filter(['user_id' => 50])->get());
    }

    /** @test */
    public function it_may_publish_posts_in_isolation(): void
    {
        $post = Post::factory()->draft()->create();
        $this->assertFalse($post->status === PostStatus::PUBLISHED);

        $post->publish();
        $this->assertTrue($post->status === PostStatus::PUBLISHED);

        $this->expectException(AlreadyPublishedException::class);

        $post->publish();
    }

    /** @test */
    public function it_may_archive_posts_in_isolation(): void
    {
        $post = Post::factory()->published()->create();
        $this->assertFalse($post->status === PostStatus::ARCHIVED);

        $post->archive();
        $this->assertTrue($post->status === PostStatus::ARCHIVED);

        $this->expectException(AlreadyArchivedException::class);

        $post->archive();
    }

    /** @test */
    public function it_scopes_posts_by_status(): void
    {
        Post::factory(2)->published()->create();
        Post::factory(2)->archived()->create();
        Post::factory(2)->draft()->create();

        $this->assertCount(2, Post::withStatus(PostStatus::PUBLISHED)->get());
        $this->assertCount(2, Post::withStatus('published')->get());

        $this->assertCount(2, Post::withStatus(PostStatus::ARCHIVED)->get());
        $this->assertCount(2, Post::withStatus('archived')->get());

        $this->assertCount(2, Post::withStatus(PostStatus::DRAFT)->get());
        $this->assertCount(2, Post::withStatus('draft')->get());

        $this->assertCount(6, Post::withStatus(null)->get());
        $this->assertCount(6, Post::withStatus('wrong-status')->get());
    }

    /** @test */
    public function it_returns_a_cover_image(): void
    {
        $post = Post::factory()->create(['image' => null]);
        $this->assertNull($post->cover_image);

        $post = Post::factory()->create(['image' => 'https://example.com/remote-image.jpg']);
        $this->assertEquals('https://example.com/remote-image.jpg', $post->cover_image);

        $post = Post::factory()->create(['image' => 'posts/local-image.jpg']);
        $this->assertEquals(asset('storage/posts/local-image.jpg'), $post->cover_image);
    }

    /** @test */
    public function it_returns_a_cover_image_for_seo(): void
    {
        $post = Post::factory()->create(['image' => 'https://example.com/remote-image.jpg']);
        $this->assertEquals($post->seo_cover_image, $post->cover_image);

        $post = Post::factory()->create(['image' => 'posts/local-image.jpg']);
        $this->assertEquals($post->seo_cover_image, $post->cover_image);

        $post = Post::factory()->create(['image' => null]);
        $this->assertNotNull($post->seo_cover_image);
        $this->assertEquals(asset('img/site_cover.jpg'), $post->seo_cover_image);
    }
}
