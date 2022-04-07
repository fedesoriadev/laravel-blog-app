<?php

namespace Tests\Unit;

use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    /** @test */
    public function it_generates_a_slug_if_not_present(): void
    {
        $tagA = Tag::factory()->create(['name' => 'Tag A', 'slug' => 'tag-a']);
        $this->assertEquals('tag-a', $tagA->slug);
        $this->assertDatabaseHas('tags', ['slug' => 'tag-a']);

        $tagB = Tag::factory()->create(['name' => 'Tag B']);
        $this->assertEquals('tag-b', $tagB->slug);
        $this->assertDatabaseHas('tags', ['slug' => 'tag-b']);

        $tagSameNameAsTagB = Tag::factory()->create(['name' => 'Tag B']);
        $this->assertEquals('tag-b-2', $tagSameNameAsTagB->slug);
        $this->assertDatabaseHas('tags', ['slug' => 'tag-b-2']);
    }
}
