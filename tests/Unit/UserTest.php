<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use App\Models\Comment;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function it_can_create_verified_users(): void
    {
        $userA = User::createVerified([
            'email'    => 'user-a@test.com',
            'username' => 'user-a',
            'name'     => 'User A',
            'password' => 'password'
        ]);

        $this->assertNotNull($userA->email_verified_at);

        $userB = User::createVerified([
            'email'    => 'user-b@test.com',
            'username' => 'user-b',
            'name'     => 'User B',
            'password' => 'password'
        ], Carbon::create(2022, 01, 01));

        $this->assertEquals('2022-01-01 00:00:00', $userB->email_verified_at);
    }

    /** @test */
    public function it_scopes_users_by_role(): void
    {
        $authors = User::factory(2)->author()->create();

        User::factory(2)->create();

        $scopedUsersByEnum = User::withRole(UserRole::AUTHOR)->get();

        $this->assertCount(2, $scopedUsersByEnum);
        $this->assertEquals($authors->pluck('id'), $scopedUsersByEnum->pluck('id'));

        $scopedUsersByString = User::withRole('author')->get();

        $this->assertCount(2, $scopedUsersByString);
        $this->assertEquals($authors->pluck('id'), $scopedUsersByString->pluck('id'));

        $this->assertCount(4, User::withRole(null)->get());
        $this->assertCount(4, User::withRole('wrong-role-name')->get());
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

    /** @test */
    public function it_generates_a_home_link_depending_the_role(): void
    {
        $adminUser = User::factory()->admin()->create();
        $this->assertEquals(route('admin.home'), $adminUser->adminRoute());

        $authorUser = User::factory()->author()->create();
        $this->assertEquals(route('posts.index'), $authorUser->adminRoute());

        $regularUser = User::factory()->create();
        $this->assertEquals(route('home'), $regularUser->adminRoute());
    }

    /** @test */
    public function it_handles_user_profile_picture(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['profile_picture' => null]);
        $this->assertNull($user->profile_picture);

        $profilePicture = UploadedFile::fake()->image('profile_picture.jpg');
        $user->uploadProfilePicture($profilePicture);

        $this->assertNotNull($user->fresh()->profile_picture);
        $this->assertDatabaseHas('users', ['profile_picture' => "profile/{$profilePicture->hashName()}"]);
    }

    /** @test */
    public function it_deletes_comments_after_account_deletion(): void
    {
        $user = User::factory()->has(Comment::factory())->create();

        $this->assertDatabaseHas('comments', ['user_id' => $user->id]);
        $this->assertCount(1, $user->comments);

        $user->delete();
        $this->assertDatabaseMissing('comments', ['user_id' => $user->id]);
    }
}
