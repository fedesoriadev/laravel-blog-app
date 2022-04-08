<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function it_returns_admin_homepage(): void
    {
        $this
            ->get('admin')
            ->assertRedirect();

        $this->actingAs(User::factory()->admin()->create());

        $this
            ->get('admin')
            ->assertViewIs('admin.index')
            ->assertViewHasAll(['postsCount', 'commentsCount', 'userCount', 'topPosts', 'latestComments', 'newUsers']);
    }
}
