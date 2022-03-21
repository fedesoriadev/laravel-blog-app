<?php

namespace Tests\Feature\Admin;

use App\Models\Comment;
use App\Models\User;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /** @test */
    public function it_deletes_a_comment(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $comment = Comment::factory()->create();

        $this
            ->delete(route('comments.destroy', $comment->id))
            ->assertSuccessful();

        $this->assertModelMissing($comment);
    }
}
