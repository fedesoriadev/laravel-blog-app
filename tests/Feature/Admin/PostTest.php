<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    public function it_stores_a_post_if_user_is_authenticated(): void
    {
        $user = $this->login();

        $this
            ->post(route('posts.store'), [
                'user_id'      => $user->id,
                'title'        => 'My awesome post',
                'slug'         => 'my-awesome-post',
                'published_at' => now(),
                'body'         => '## Some markdown body content'
            ])
            ->assertCreated();

        $this->assertDatabaseHas('posts', ['title' => 'My awesome post']);
    }

    /** @test */
    public function it_updates_a_post(): void
    {
        $this->login();

        $post = Post::factory()->create(['title' => 'Original post title']);

        $this
            ->patch(route('posts.update', $post->slug), [
                'user_id' => $post->user_id,
                'title'   => 'Updated post title',
                'slug'    => $post->slug,
                'body'    => '## Some markdown body content'
            ])
            ->assertSuccessful();

        $this->assertDatabaseMissing(Post::class, ['title' => 'Original post title']);

        $this->assertDatabaseHas(Post::class, ['title' => 'Updated post title']);
    }

    /** @test */
    public function it_attaches_tags_when_save_a_post(): void
    {
        $user = $this->login();

        $this
            ->post(route('posts.store'), [
                'user_id' => $user->id,
                'title'   => 'A post with tags',
                'slug'    => 'a-post-with-tags',
                'body'    => '## Some markdown body content',
                'tags'    => ['Laravel', 'PHP']
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas(Tag::class, ['name' => 'Laravel']);

        $this->assertDatabaseHas(Tag::class, ['name' => 'PHP']);

        $post = Post::find(1);

        $this->assertCount(2, $post->tags);

        $this
            ->patch(route('posts.update', $post->slug), [
                'user_id' => $post->user_id,
                'title'   => $post->title,
                'slug'    => $post->slug,
                'body'    => $post->body,
                'tags'    => ['Programming']
            ])
            ->assertSuccessful();

        $this->assertCount(1, $post->refresh()->tags);

        $this->assertEquals(['Programming'], $post->refresh()->tags->pluck('name')->all());
    }

    /** @test */
    public function it_uploads_a_cover_image(): void
    {
        $this->withoutExceptionHandling();

        $user = $this->login();

        Storage::fake('public');

        $postCover = UploadedFile::fake()->image('post-cover.jpg');

        $this
            ->post(route('posts.store'), [
                'user_id' => $user->id,
                'title'   => 'My awesome post',
                'slug'    => 'my-awesome-post',
                'image'   => $postCover,
                'body'    => '## Some markdown body content'
            ])
            ->assertCreated();

        $imagePath = "posts/{$postCover->hashName()}";

        Storage::disk('public')->assertExists($imagePath);

        $this->assertDatabaseHas('posts', ['image' => $imagePath]);
    }

    /** @test */
    public function it_deletes_a_post(): void
    {
        $this->login();

        $post = Post::factory()->create();

        $this
            ->delete(route('posts.destroy', $post->slug))
            ->assertSuccessful();

        $this->assertModelMissing($post);
    }
}
