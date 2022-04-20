<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ResendVerificationEmailTest extends TestCase
{
    /** @test */
    public function it_resends_verification_email(): void
    {
        $this->withoutExceptionHandling();

        $this->actingAsAdmin();

        Notification::fake();

        $user = User::factory()->create(['email_verified_at' => null]);

        $this
            ->post(route('users.resend-verification', $user->username), [])
            ->assertRedirect(route('users.index'));

        Notification::assertSentTo($user, VerifyEmail::class);
    }
}
