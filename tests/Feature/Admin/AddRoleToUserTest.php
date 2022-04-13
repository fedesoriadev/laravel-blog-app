<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Tests\TestCase;

class AddRoleToUserTest extends TestCase
{
    /** @test */
    public function it_attaches_a_role_for_a_user(): void
    {
        $role = Role::create(['name' => UserRole::ADMIN]);

        $this->actingAsAdmin();

        $this
            ->post(route('users.store'), [
                'email'                 => 'test@test.com',
                'name'                  => 'Some user test',
                'username'              => 'some.user',
                'password'              => 'test1234',
                'password_confirmation' => 'test1234',
                'role_id'               => $role->id,
            ])
            ->assertRedirect(route('users.index'));

        $user = User::where('email', 'test@test.com')->first();

        $this->assertNotNull($user->role);

        $this->assertTrue($user->hasRole(UserRole::ADMIN));
    }
}
