<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_required_fields(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('users.store'), []);

        $response->assertInvalid(['name', 'username', 'email', 'password']);

        $response = $this->post(route('users.store'), [
            'email'                 => 'test@test.com',
            'name'                  => 'Some user test',
            'username'              => 'some.user',
            'password'              => 'test1234',
            'password_confirmation' => 'test1234'
        ]);

        $response->assertValid();
    }

    /** @test */
    public function it_validates_email_is_unique(): void
    {
        $this->actingAs(User::factory()->create());

        User::factory()->create(['email' => 'test@test.com']);

        $response = $this->post(route('users.store'), [
            'email' => 'test@test.com',
        ]);

        $response->assertInvalid(['email' => 'The email has already been taken.']);
    }

    /** @test */
    public function it_validates_username_is_unique(): void
    {
        $this->actingAs(User::factory()->create());

        User::factory()->create(['username' => 'test']);

        $response = $this->post(route('users.store'), [
            'username' => 'test',
        ]);

        $response->assertInvalid(['username' => 'The username has already been taken.']);
    }

    /** @test */
    public function it_validates_password_must_be_confirmed(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('users.store'), [
            'password'              => 'test1234',
            'password_confirmation' => 'wrong-match'
        ]);

        $response->assertInvalid(['password' => 'The password confirmation does not match.']);

        $response = $this->post(route('users.store'), [
            'password'              => 'test1234',
            'password_confirmation' => 'test1234'
        ]);

        $response->assertValid(['password']);
    }

    /** @test */
    public function it_creates_a_user(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('users.store'), [
            'email'                 => 'test@test.com',
            'name'                  => 'Some user test',
            'username'              => 'some.user',
            'password'              => 'test1234',
            'password_confirmation' => 'test1234'
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas(User::class, ['email' => 'test@test.com']);
    }

    /** @test */
    public function it_updates_a_user(): void
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $response = $this->patch(route('users.update', $user->username), [
            'email'    => $user->email,
            'name'     => 'John Doe',
            'username' => $user->username,
            'about_me' => 'I like to make tests'
        ]);

        $response->assertValid();

        $this->assertDatabaseHas(User::class, ['name' => 'John Doe', 'about_me' => 'I like to make tests']);

        $this->assertEquals($user->email, $response['email']);
    }

    /** @test */
    public function it_deletes_a_user(): void
    {
        $this->actingAs(User::factory()->create());

        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', [$user->username]));

        $response->assertSuccessful();

        $this->assertModelMissing($user);
    }
}
