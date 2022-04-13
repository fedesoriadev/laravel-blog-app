<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Tests\TestCase;

class RedirectUserTest extends TestCase
{
    /** @test */
    public function it_redirects_after_login_according_to_user_role(): void
    {
        $regularUser = User::factory()->create();

        $this
            ->post(route('login'), [
                'email'    => $regularUser->email,
                'password' => 'password'
            ])
            ->assertRedirect(config('fortify.home'));

        $this->post(route('logout'), []);

        $authorUser = User::factory()->author()->create();

        $this
            ->post(route('login'), [
                'email'    => $authorUser->email,
                'password' => 'password'
            ])
            ->assertRedirect(route('posts.index'));

        $this->post(route('logout'), []);

        $adminUser = User::factory()->admin()->create();

        $this
            ->post(route('login'), [
                'email'    => $adminUser->email,
                'password' => 'password'
            ])
            ->assertRedirect(route('admin.home'));
    }
}
