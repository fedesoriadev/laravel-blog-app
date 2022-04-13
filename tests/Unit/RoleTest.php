<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use App\Models\Role;
use BackedEnum;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /** @test */
    public function it_casts_role_name_to_enum(): void
    {
        $role = Role::create(['name' => UserRole::ADMIN]);
        $this->assertInstanceOf(BackedEnum::class, $role->name);

        $role = Role::create(['name' => 'author']);
        $this->assertInstanceOf(BackedEnum::class, $role->name);
    }
}
