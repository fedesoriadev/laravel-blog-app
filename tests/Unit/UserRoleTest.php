<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    /** @test */
    public function it_has_admin_and_author_roles(): void
    {
        $roles = collect(UserRole::cases());

        $this->assertTrue($roles->contains('name', 'ADMIN'));
        $this->assertTrue($roles->contains('value', 'admin'));
        $this->assertTrue($roles->contains('name', 'AUTHOR'));
        $this->assertTrue($roles->contains('value', 'author'));
    }
}
