<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_scopes_users_by_role(): void
    {
        $authors = User::factory(2)->author()->create();

        User::factory(2)->create();

        $scopedUsers = User::withRole(UserRole::AUTHOR)->get();

        $this->assertCount(2, $scopedUsers);

        $this->assertEquals($authors->pluck('id'), $scopedUsers->pluck('id'));
    }

    /** @test */
    public function it_checks_if_a_user_has_role(): void
    {
        $adminUser = User::factory()->admin()->create();

        $this->assertTrue($adminUser->hasRole(UserRole::ADMIN));

        $authorUser = User::factory()->create();

        Role::create(['name' => UserRole::AUTHOR->value])->users()->save($authorUser);

        $this->assertTrue($authorUser->hasRole(UserRole::AUTHOR));

        $regularUser = User::factory()->create();

        $this->assertFalse($regularUser->hasRole(UserRole::ADMIN));
        $this->assertFalse($regularUser->hasRole(UserRole::AUTHOR));
    }
}
