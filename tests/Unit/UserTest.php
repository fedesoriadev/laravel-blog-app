<?php

namespace Tests\Unit;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_scopes_users_by_role(): void
    {
        $authors = User::factory(2)->author()->create();

        User::factory(2)->create();

        $scopedUsers = User::withRole(UserRole::AUTHOR)->get();

        $this->assertCount(2, $scopedUsers);

        $this->assertEquals($authors->pluck('id'), $scopedUsers->pluck('id'));
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

        $this->assertEquals(route('admin.home'), $adminUser->home());

        $authorUser = User::factory()->author()->create();

        $this->assertEquals(route('posts.index'), $authorUser->home());

        $regularUser = User::factory()->create();

        $this->assertEquals(route('home'), $regularUser->home());
    }

    /** @test */
    public function it_handles_user_avatars(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['avatar' => null]);

        $this->assertNull($user->avatar);

        $avatar = UploadedFile::fake()->image('avatar.jpg');

        $user->uploadAvatar($avatar);

        $this->assertNotNull($user->fresh()->avatar);

        $this->assertDatabaseHas('users', ['avatar' => "avatars/{$avatar->hashName()}"]);
    }
}
