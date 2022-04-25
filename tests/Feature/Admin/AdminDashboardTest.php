<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    /** @test */
    public function it_returns_admin_homepage(): void
    {
        $this
            ->get('admin')
            ->assertRedirect();

        $this->actingAsAdmin();

        $this
            ->get('admin')
            ->assertViewIs('admin.index')
            ->assertViewHasAll(['postsCount', 'commentsCount', 'usersCount', 'topPosts', 'latestComments', 'newUsers']);
    }
}
