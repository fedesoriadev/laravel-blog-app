<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadImagePostTest extends TestCase
{
    /** @test */
    public function it_uploads_a_cover_image(): void
    {
        $this->actingAs($user = User::factory()->admin()->create());

        Storage::fake('public');

        $postCover = UploadedFile::fake()->image('post-cover.jpg');

        $this
            ->post(route('posts.store'), [
                'user_id' => $user->id,
                'title'   => 'My awesome post',
                'image'   => $postCover,
                'body'    => '## Some markdown body content'
            ])
            ->assertRedirect(route('posts.index'));

        $imagePath = "posts/{$postCover->hashName()}";

        Storage::disk('public')->assertExists($imagePath);

        $this->assertDatabaseHas('posts', ['image' => $imagePath]);
    }
}
