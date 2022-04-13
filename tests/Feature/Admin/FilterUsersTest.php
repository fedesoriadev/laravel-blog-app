<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Tests\TestCase;

class FilterUsersTest extends TestCase
{
    /** @test */
    public function it_filters_users_by_role(): void
    {
        $admins = User::factory(2)->admin()->create();

        $authors = User::factory(5)->author()->create();

        User::factory(3)->create();

        $response = $this
            ->actingAsAdmin($admins[0])
            ->get(route('users.index'))
            ->assertOk();

        $this->assertCount(User::count(), $response['users']);

        $response = $this
            ->get(route('users.index', ['role' => 'admin']))
            ->assertOk();

        $this->assertCount($admins->count(), $response['users']);

        $response = $this
            ->get(route('users.index', ['role' => 'author']))
            ->assertOk();

        $this->assertCount($authors->count(), $response['users']);

        $response = $this
            ->get(route('users.index', ['role' => 'wrong-role']))
            ->assertOk();

        $this->assertCount(User::count(), $response['users']);
    }
}
