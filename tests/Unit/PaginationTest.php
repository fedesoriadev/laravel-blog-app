<?php

namespace Tests\Unit;

use App\Enums\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    /** @test */
    public function it_provides_default_pagination_for_frontend_and_admin_lists(): void
    {
        $this->assertEquals(10, Pagination::FRONT->value);
        $this->assertEquals(20, Pagination::ADMIN->value);
    }
}
