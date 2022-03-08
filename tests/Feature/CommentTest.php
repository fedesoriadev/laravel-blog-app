<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_adds_a_comment_for_a_post(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $post = Post::factory()->create();

        $response = $this->post(route('comments.store', $post->slug), [
            'user_id' => $user->id,
            'body'    => 'This comment belongs to a post.'
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas(Comment::class, ['body' => 'This comment belongs to a post.']);
    }

    /** @test */
    public function it_deletes_a_comment(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->actingAs($user);

        $comment = Comment::factory()->create();

        $response = $this->delete(route('comments.destroy', $comment->id));

        $response->assertSuccessful();

        $this->assertModelMissing($comment);
    }

    /** @test */
    public function a_post_has_many_comments(): void
    {
        $post = Post::factory()->has(Comment::factory(5))->create();

        $this->assertCount(5, $post->comments);
    }
}
