<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function route;

class UserTest extends TestCase
{
    // Regular users and editor or unauthenticated cannot create users
    // Regular users and editor or unauthenticated cannot update or delete users

    // Admin can create update and delete users

    // Authenticated can update own user

    // Validate fields
    // Unique email
    // Unique username
    // Upload avatar
    // Attach Role

    /** @test */
    public function it_validates_required_fields(): void
    {
        $this->actingAs(User::factory()->admin()->create());

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
        $this->actingAs(User::factory()->admin()->create(['email' => 'test@test.com']));

        $response = $this->post(route('users.store'), [
            'email' => 'test@test.com',
        ]);

        $response->assertInvalid(['email' => 'The email has already been taken.']);
    }

    /** @test */
    public function it_validates_username_is_unique(): void
    {
        $this->actingAs(User::factory()->admin()->create(['username' => 'test']));

        $response = $this->post(route('users.store'), [
            'username' => 'test',
        ]);

        $response->assertInvalid(['username' => 'The username has already been taken.']);
    }

    /** @test */
    public function it_validates_password_must_be_confirmed(): void
    {
        $this->actingAs(User::factory()->admin()->create());

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
        $this->actingAs(User::factory()->admin()->create());

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
        $this->actingAs($user = User::factory()->admin()->create());

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
    public function it_adds_an_avatar_for_a_user(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        Storage::fake('public');

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post(route('users.store'), [
            'email'                 => 'test@test.com',
            'name'                  => 'Some user test',
            'username'              => 'some.user',
            'password'              => 'test1234',
            'password_confirmation' => 'test1234',
            'avatar'                => $avatar,
        ]);

        $response->assertCreated();

        $imagePath = "avatars/{$avatar->hashName()}";

        Storage::disk('public')->assertExists($imagePath);

        $this->assertDatabaseHas('users', ['avatar' => $imagePath]);
    }

    /** @test */
    public function it_attaches_a_role_for_a_user(): void
    {
        $this->withoutExceptionHandling();

        $role = Role::create(['name' => UserRole::ADMIN]);

        $this->actingAs(User::factory()->admin()->create());;

        $response = $this->post(route('users.store'), [
            'email'                 => 'test@test.com',
            'name'                  => 'Some user test',
            'username'              => 'some.user',
            'password'              => 'test1234',
            'password_confirmation' => 'test1234',
            'roles'                 => [$role->id],
        ]);

        $response->assertCreated();

        $user = User::where('email', 'test@test.com')->first();

        $this->assertCount(1, $user->roles);

        $this->assertTrue($user->hasRole(UserRole::ADMIN));
    }

    /** @test */
    public function it_deletes_a_user(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        $user = User::factory()->create();

        $response = $this->delete(route('users.destroy', [$user->username]));

        $response->assertSuccessful();

        $this->assertModelMissing($user);
    }
}
