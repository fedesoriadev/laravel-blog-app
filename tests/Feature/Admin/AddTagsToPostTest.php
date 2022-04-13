<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;

class AddTagsToPostTest extends TestCase
{
    /** @test */
    public function it_attaches_tags_when_save_a_post(): void
    {
        $this->actingAs($user = User::factory()->admin()->create());

        $this
            ->post(route('posts.store'), [
                'user_id' => $user->id,
                'title'   => 'A post with tags',
                'body'    => '## Some markdown body content',
                'tags'    => ['Laravel', 'PHP']
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas(Tag::class, ['name' => 'Laravel']);

        $this->assertDatabaseHas(Tag::class, ['name' => 'PHP']);

        $post = Post::first();

        $this->assertCount(2, $post->tags);

        $this
            ->patch(route('posts.update', $post->slug), [
                'user_id' => $post->user_id,
                'title'   => $post->title,
                'body'    => $post->body,
                'tags'    => ['Programming']
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertCount(1, $post->refresh()->tags);

        $this->assertEquals(['Programming'], $post->refresh()->tags->pluck('name')->all());
    }
}
