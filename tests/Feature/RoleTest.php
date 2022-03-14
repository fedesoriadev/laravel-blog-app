<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /** @test */
    public function it_adds_a_role_to_a_user(): void
    {
        $user = User::factory()->create();

        $this->assertFalse($user->hasRole('admin'));

        $role = Role::create(['name' => 'admin']);

        $user->roles()->attach($role);

        $this->assertTrue($user->refresh()->hasRole('admin'));
    }

    /** @test */
    public function it_removes_a_role_from_a_user(): void
    {
        $user = User::factory()->create();

        $role = Role::create(['name' => 'admin']);

        $user->roles()->attach($role);

        $this->assertTrue($user->hasRole('admin'));

        $user->roles()->detach($role);

        $this->assertFalse($user->refresh()->hasRole('admin'));
    }
}
