<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    /** @test */
    public function it_shows_a_page_for_update_profile_information_of_current_user(): void
    {
        $this
            ->actingAs(User::factory()->create())
            ->get('/profile')
            ->assertOk()
            ->assertViewIs('profile.show');
    }

    /** @test */
    public function it_can_delete_account_after_password_confirmation(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this
            ->delete(route('profile.destroy'))
            ->assertRedirect(route('password.confirm'));

        $this
            ->post('/user/confirm-password', ['password' => 'password']);

        $this
            ->delete(route('profile.destroy'))
            ->assertRedirect(route('home'));

        $this->assertModelMissing($user);
    }
}
