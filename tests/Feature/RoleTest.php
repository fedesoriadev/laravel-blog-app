<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /** @test */
    public function it_adds_a_role_to_a_user(): void
    {
        $user = User::factory()->create();

        $this->assertFalse($user->hasRole(UserRole::ADMIN));

        $role = Role::create(['name' => UserRole::ADMIN]);

        $role->users()->save($user);

        $this->assertTrue($user->refresh()->hasRole(UserRole::ADMIN));
    }

    /** @test */
    public function it_removes_a_role_from_a_user(): void
    {
        $user = User::factory()->create();

        $role = Role::create(['name' => UserRole::ADMIN]);

        $role->users()->save($user);

        $this->assertTrue($user->hasRole(UserRole::ADMIN));

        $user->role()->dissociate();

        $user->save();

        $this->assertFalse($user->refresh()->hasRole(UserRole::ADMIN));
    }
}
