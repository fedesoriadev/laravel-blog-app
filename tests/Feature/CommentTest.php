<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /** @test */
    public function it_adds_a_comment(): void
    {
        $this->actingAs($user = User::factory()->create());

        $post = Post::factory()->published()->create();

        $this
            ->post(route('comments.store', $post->slug), [
                'user_id' => $user->id,
                'body'    => 'This comment belongs to a post.'
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas(Comment::class, ['body' => 'This comment belongs to a post.']);
    }

    /** @test */
    public function a_post_may_have_many_comments(): void
    {
        $post = Post::factory()
            ->published()
            ->has(Comment::factory(5))
            ->create();

        $this->assertCount(5, $post->comments);
    }
}
