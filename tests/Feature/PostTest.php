<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_blog_index_only_shows_published_posts(): void
    {
        Post::factory()->create();

        Post::factory()->draft()->create();

        $response = $this->get('/');

        $response->assertOk();

        $response->assertJsonCount(1);
    }

    /** @test */
    public function search_posts_by_keyword_present_in_the_title_or_body(): void
    {
        Post::factory()->create(['title' => 'This post talks about Laravel']);

        Post::factory()->create(['title' => 'Unrelated sports post']);

        Post::factory()->create(['title' => 'Post about Symfony', 'body' => 'But Laravel is mentioned in the body']);

        $response = $this->get('/?search=Laravel');

        $response->assertOk();

        $response->assertJsonCount(2);
    }

    /** @test */
    public function it_shows_a_published_post(): void
    {
        $publishedPost = Post::factory()->create();

        $response = $this->get(route('posts.show', $publishedPost->slug));

        $response->assertOk();

        $response->assertSee($publishedPost->title);
    }

    /** @test */
    public function show_an_unpublished_post_is_forbidden(): void
    {
        $unpublishedPost = Post::factory()->draft()->create();

        $response = $this->get(route('posts.show', $unpublishedPost->slug));

        $response->assertForbidden();
    }

    /** @test */
    public function it_shows_posts_of_an_author(): void
    {
        $author = User::factory()->create();

        $author->posts()->saveMany(Post::factory(3)->create());

        $response = $this->get(route('authors.show', $author->username));

        $response->assertOk();

        $response->assertSee($author->name);

        $this->assertCount(3, $author->posts);
    }

    /** @test */
    public function it_stores_a_post_if_user_is_authenticated(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $this->assertAuthenticated();

        Storage::fake('public');

        $postCover = UploadedFile::fake()->image('post-cover.jpg');

        $response = $this->post(route('posts.store'), [
            'user_id' => $user->id,
            'title' => 'My awesome post',
            'slug' => 'my-awesome-post',
            'published_at' => now(),
            'image' => $postCover,
            'body' => '## Some markdown body content'
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('posts', ['title' => 'My awesome post']);

        Storage::disk('public')->assertExists("posts/{$postCover->hashName()}");
    }

    /** @test */
    public function it_updates_a_post(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $this->assertAuthenticated();

        $post = Post::factory()->create(['title' => 'Original post title']);

        $response = $this->patch(route('posts.update', $post->slug), [
            'user_id' => $post->user_id,
            'title' => 'Updated post title',
            'slug' => $post->slug,
            'body' => '## Some markdown body content'
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseMissing(Post::class, ['title' => 'Original post title']);

        $this->assertDatabaseHas(Post::class, ['title' => 'Updated post title']);
    }
}
