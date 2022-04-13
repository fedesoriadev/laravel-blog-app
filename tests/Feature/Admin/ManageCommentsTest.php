<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\Comment;
use App\Models\User;
use Tests\TestCase;

class ManageCommentsTest extends TestCase
{
    /** @test */
    public function it_denies_to_delete_comments_for_anonymous_regular_and_authors_users(): void
    {
        $comment = Comment::factory()->create();

        $this
            ->delete(route('comments.destroy', $comment->id), [], ['Accept' => 'application/json'])
            ->assertUnauthorized();

        $this
            ->actingAs(User::factory()->create())
            ->delete(route('comments.destroy', $comment->id), [], ['Accept' => 'application/json'])
            ->assertForbidden();

        $this
            ->actingAs($authorUser = User::factory()->author()->create())
            ->delete(route('comments.destroy', $comment->id), [], ['Accept' => 'application/json'])
            ->assertForbidden();

        $this->assertTrue($authorUser->hasRole(UserRole::AUTHOR));

        $this->assertModelExists($comment);
    }

    /** @test */
    public function it_allows_admins_to_delete_comments(): void
    {
        $this->actingAsAdmin();

        $comment = Comment::factory()->create();

        $this
            ->delete(route('comments.destroy', $comment->id))
            ->assertRedirect(route('comments.index'));

        $this->assertModelMissing($comment);
    }
}
