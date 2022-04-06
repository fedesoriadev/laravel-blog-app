<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function route;

class UserTest extends TestCase
{
    public function validationDataProvider(): array
    {
        return [
            'Test email is required'                 => ['email', '', 'required'],
            'Test email is valid'                    => ['email', 'not-an-email', 'email'],
            'Test email is unique'                   => ['email', 'admin@admin.com', 'unique'],
            'Test username is required'              => ['username', '', 'required'],
            'Test username is unique'                => ['username', 'admin', 'unique'],
            'Test name is required'                  => ['name', '', 'required'],
            'Test password is required'              => ['password', '', 'required'],
            'Test password is min 8 characters long' => ['password', '1234', 'min.string', ['min' => 8]],
            'Test password is confirmed'             => [
                'password',
                'random1234',
                'confirmed',
                [],
                ['password_confirmation' => 'random5678']
            ],
        ];
    }

    /**
     * @test
     * @dataProvider validationDataProvider
     */
    public function it_validates_user_request(
        $field,
        $value,
        $errorRule,
        array $messageParams = [],
        array $extraFields = []
    ): void {
        $admin = User::factory()->admin()->create([
            'email'    => 'admin@admin.com',
            'username' => 'admin'
        ]);

        $this->actingAs($admin);

        $this
            ->post(route('users.store'), array_merge([$field => $value], $extraFields))
            ->assertInvalid(
                [
                    $field => Lang::get(
                        "validation.$errorRule",
                        array_merge(['attribute' => str_replace('_', ' ', $field)], $messageParams)
                    )
                ]
            );
    }

    /** @test */
    public function it_denies_to_create_update_and_delete_users_for_anonymous_regular_and_authors_users(): void
    {
        $this
            ->post(route('users.store'), [])
            ->assertRedirect(route('login'));

        $this
            ->patch(route('users.update', 'some.username'), [])
            ->assertRedirect(route('login'));

        $this
            ->delete(route('users.destroy', 'some.username'), [])
            ->assertRedirect(route('login'));

        $user = User::factory()->create();
        $this->assertDatabaseHas('users', ['email' => $user->email]);

        $this
            ->actingAs($regularUser = User::factory()->create())
            ->assertAuthenticated()
            ->post(route('users.store'), [])
            ->assertForbidden();

        $this->assertFalse($regularUser->hasRole(UserRole::ADMIN));
        $this->assertFalse($regularUser->hasRole(UserRole::AUTHOR));

        $this
            ->patch(route('users.update', $user->username), ['name' => 'John Doe'])
            ->assertForbidden();

        $this->assertDatabaseMissing('users', ['name' => 'John Doe']);

        $this
            ->delete(route('users.destroy', $user->username))
            ->assertForbidden();

        $this
            ->actingAs($authorUser = User::factory()->author()->create())
            ->assertAuthenticated()
            ->post(route('users.store'), [])
            ->assertForbidden();

        $this->assertFalse($authorUser->hasRole(UserRole::ADMIN));
        $this->assertTrue($authorUser->hasRole(UserRole::AUTHOR));

        $this
            ->patch(route('users.update', $user->username), ['name' => 'John Doe'])
            ->assertForbidden();

        $this->assertDatabaseMissing('users', ['name' => 'John Doe']);

        $this
            ->delete(route('users.destroy', $user->username))
            ->assertForbidden();
    }

    /** @test */
    public function it_allows_admins_to_create_update_and_delete_users(): void
    {
        $adminUser = User::factory()->admin()->create();
        $this->assertTrue($adminUser->hasRole(UserRole::ADMIN));

        $this
            ->actingAs($adminUser)
            ->assertAuthenticated()
            ->post(route('users.store'), [
                'email'                 => 'moderator@example.com',
                'username'              => 'moderator',
                'name'                  => 'Moderator',
                'password'              => 'password',
                'password_confirmation' => 'password',
            ])
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', ['email' => 'moderator@example.com']);

        $user = User::where('email', 'moderator@example.com')->first();

        $this
            ->patch(route('users.update', $user->username), [
                'email'    => $user->email,
                'username' => $user->username,
                'name'     => 'Mr. Moderator'
            ])
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', ['name' => 'Mr. Moderator']);

        $this
            ->delete(route('users.destroy', $user->username))
            ->assertRedirect(route('users.index'));

        $this->assertModelMissing($user);
    }

    /** @test */
    public function it_adds_an_avatar_for_a_user(): void
    {
        $this->actingAs(User::factory()->admin()->create());

        Storage::fake('public');

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $this
            ->post(route('users.store'), [
                'email'                 => 'test@test.com',
                'name'                  => 'Some user test',
                'username'              => 'some.user',
                'password'              => 'test1234',
                'password_confirmation' => 'test1234',
                'avatar'                => $avatar,
            ])
            ->assertRedirect(route('users.index'));

        $imagePath = "avatars/{$avatar->hashName()}";

        Storage::disk('public')->assertExists($imagePath);

        $this->assertDatabaseHas('users', ['avatar' => $imagePath]);
    }

    /** @test */
    public function it_attaches_a_role_for_a_user(): void
    {
        $role = Role::create(['name' => UserRole::ADMIN]);

        $this->actingAs(User::factory()->admin()->create());;

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

    /** @test */
    public function it_redirects_after_login_according_to_user_role(): void
    {
        $regularUser = User::factory()->create();

        $this
            ->post(route('login'), [
                'email' => $regularUser->email,
                'password' => 'password'
            ])
            ->assertRedirect(config('fortify.home'));

        $this->post(route('logout'), []);

        $authorUser = User::factory()->author()->create();

        $this
            ->post(route('login'), [
                'email' => $authorUser->email,
                'password' => 'password'
            ])
            ->assertRedirect(route('posts.index'));

        $this->post(route('logout'), []);

        $adminUser = User::factory()->admin()->create();

        $this
            ->post(route('login'), [
                'email' => $adminUser->email,
                'password' => 'password'
            ])
            ->assertRedirect(route('admin.home'));
    }
}
