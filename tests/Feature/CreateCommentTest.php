<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class CreateCommentTest extends TestCase
{
    /** @test */
    public function it_denies_create_a_comment_when_unauthenticated(): void
    {
        $post = Post::factory()->published()->create();

        $this
            ->post(route('comments.store', $post->slug), [], ['Accept' => 'application/json'])
            ->assertUnauthorized();
    }

    /** @test */
    public function it_allows_users_to_add_comments(): void
    {
        $this->actingAs(User::factory()->create());

        $post = Post::factory()->published()->create();

        $this
            ->post(route('comments.store', $post->slug), ['comment' => 'This comment belongs to a post.'])
            ->assertRedirect();

        $this->assertDatabaseHas('comments', ['body' => 'This comment belongs to a post.']);
    }

    /** @test */
    public function it_denies_to_create_comments_for_other_user(): void
    {
        $this->actingAs($currentUser = User::factory()->create());

        $post = Post::factory()->published()->create();

        $otherUser = User::factory()->create();

        $this
            ->post(route('comments.store', $post->slug), [
                'user_id' => $otherUser->id,
                'comment' => 'This comment belongs to the current user.'
            ])
            ->assertRedirect();

        $comment = Comment::first();

        $this->assertEquals($currentUser->id, $comment->user_id);
        $this->assertNotEquals($otherUser->id, $comment->user_id);
    }
}
