<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadProfilePictureTest extends TestCase
{
    /** @test */
    public function it_adds_an_profile_picture_for_a_user(): void
    {
        $this->actingAsAdmin();

        Storage::fake('public');

        $profilePicture = UploadedFile::fake()->image('profile_picture.jpg');

        $this
            ->post(route('users.store'), [
                'email'                 => 'test@test.com',
                'name'                  => 'Some user test',
                'username'              => 'some.user',
                'password'              => 'test1234',
                'password_confirmation' => 'test1234',
                'profile_picture'       => $profilePicture,
            ])
            ->assertRedirect(route('users.index'));

        $imagePath = "profile/{$profilePicture->hashName()}";

        Storage::disk('public')->assertExists($imagePath);

        $this->assertDatabaseHas('users', ['profile_picture' => $imagePath]);
    }
}
