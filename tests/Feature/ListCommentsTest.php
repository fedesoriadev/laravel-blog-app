<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use Tests\TestCase;

class ListCommentsTest extends TestCase
{
    /** @test */
    public function it_lists_comments_ordered_by_creation_date(): void
    {
        $post = Post::factory()->published()->create();

        $post->comments()->saveMany([
            Comment::factory()->create(['body' => 'Comment A', 'created_at' => now()->subDays(3)]),
            Comment::factory()->create(['body' => 'Comment B', 'created_at' => now()->subDays(2)]),
            Comment::factory()->create(['body' => 'Comment C', 'created_at' => now()]),
        ]);

        $this
            ->get(route('posts.show', $post->slug))
            ->assertSeeInOrder(['Comment C', 'Comment B', 'Comment A']);
    }
}
