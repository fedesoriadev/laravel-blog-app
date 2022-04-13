<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Tests\TestCase;

use function route;

class ManageUsersTest extends TestCase
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

        $this->actingAsAdmin($admin);

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
}
