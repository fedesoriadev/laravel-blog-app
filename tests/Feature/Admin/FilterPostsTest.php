<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class FilterPostsTest extends TestCase
{
    /** @test */
    public function it_filters_posts_by_status(): void
    {
        Post::factory(2)->published()->create();
        Post::factory(2)->archived()->create();
        Post::factory(2)->draft()->create();

        $response = $this
            ->actingAs(User::factory()->admin()->create())
            ->get(route('posts.index'))
            ->assertOk();

        $this->assertCount(6, $response['posts']);

        $response = $this
            ->get(route('posts.index', ['status' => 'published']))
            ->assertOk();

        $this->assertCount(2, $response['posts']);

        $response = $this
            ->get(route('posts.index', ['status' => 'archived']))
            ->assertOk();

        $this->assertCount(2, $response['posts']);

        $response = $this
            ->get(route('posts.index', ['status' => 'draft']))
            ->assertOk();

        $this->assertCount(2, $response['posts']);

        $response = $this
            ->get(route('posts.index', ['status' => 'wrong-status']))
            ->assertOk();

        $this->assertCount(6, $response['posts']);
    }
}
