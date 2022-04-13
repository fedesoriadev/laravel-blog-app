<?php

namespace Tests\Unit;

use App\Enums\PostStatus;
use PHPUnit\Framework\TestCase;

class PostStatusTest extends TestCase
{
    /** @test */
    public function it_provides_default_cases_for_post_status(): void
    {
        $this->assertEquals('published', PostStatus::PUBLISHED->value);
        $this->assertEquals('archived', PostStatus::ARCHIVED->value);
        $this->assertEquals('draft', PostStatus::DRAFT->value);
    }

    /** @test */
    public function it_checks_if_a_post_status_is_publicly_accessible(): void
    {
        $this->assertFalse(PostStatus::DRAFT->isPubliclyAccessible());
        $this->assertFalse(PostStatus::ARCHIVED->isPubliclyAccessible());
        $this->assertTrue(PostStatus::PUBLISHED->isPubliclyAccessible());
    }

    /** @test */
    public function it_checks_if_a_post_status_is_published(): void
    {
        $this->assertFalse(PostStatus::DRAFT->isPublished());
        $this->assertFalse(PostStatus::ARCHIVED->isPublished());
        $this->assertTrue(PostStatus::PUBLISHED->isPublished());
    }

    /** @test */
    public function it_returns_html_classes_depending_post_status(): void
    {
        $this->assertTrue(str_contains(PostStatus::PUBLISHED->background(), 'green'));
        $this->assertTrue(str_contains(PostStatus::ARCHIVED->background(), 'red'));
        $this->assertTrue(str_contains(PostStatus::DRAFT->background(), 'gray'));
    }
}
