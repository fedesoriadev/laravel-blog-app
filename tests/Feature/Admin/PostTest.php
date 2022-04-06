<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function validationDataProvider(): array
    {
        return [
            'Test author is required'         => ['user_id', '', 'required'],
            'Test author id is an integer'    => ['user_id', 'some-string', 'integer'],
            'Test author exists'              => ['user_id', 50, 'exists'],
            'Test title is required'          => ['title', '', 'required'],
            'Test title is string'            => ['title', true, 'string'],
            'Test slug is string'             => ['slug', 10.5, 'string'],
            'Test slug has allowed character' => ['slug', '$//[]ñ', 'regex'],
            'Test slug is unique'             => ['slug', 'first-post', 'unique'],
            'Test field date is a date'       => ['date', '2022-50-100', 'date'],
            'Test image is valid'             => ['image', 'not-a-image', 'image'],
            'Test excerpt is a string'        => ['excerpt', 1, 'string'],
            'Test body is required'           => ['body', '', 'required'],
        ];
    }

    /**
     * @test
     * @dataProvider validationDataProvider
     */
    public function it_validates_post_request(
        $field,
        $value,
        $errorRule,
        array $messageParams = []
    ): void {
        Post::factory()->create(['slug' => 'first-post']);

        $admin = User::factory()->admin()->create();

        $this->actingAs($admin);

        $this
            ->post(route('posts.store'), [$field => $value])
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
    public function it_denies_create_posts_for_anonymous_or_regular_users(): void
    {
        $this
            ->post(route('posts.store'), [], ['Accept' => 'application/json'])
            ->assertUnauthorized();

        $this
            ->actingAs($regularUser = User::factory()->create())
            ->assertAuthenticated()
            ->post(route('posts.store'), [])
            ->assertForbidden();

        $this->assertFalse($regularUser->hasRole(UserRole::ADMIN));
        $this->assertFalse($regularUser->hasRole(UserRole::AUTHOR));
    }

    /** @test */
    public function it_denies_update_posts_for_anonymous_or_regular_users(): void
    {
        $post = Post::factory()->create();

        $this->assertDatabaseHas('posts', ['title' => $post->title]);

        $this
            ->patch(route('posts.update', $post->slug), [
                'title' => 'Updating title'
            ], ['Accept' => 'application/json'])
            ->assertUnauthorized();

        $this
            ->actingAs($regularUser = User::factory()->create())
            ->assertAuthenticated()
            ->patch(route('posts.update', $post->slug), [
                'title' => 'Updating title'
            ], ['Accept' => 'application/json'])
            ->assertForbidden();

        $this->assertFalse($regularUser->hasRole(UserRole::ADMIN));
        $this->assertFalse($regularUser->hasRole(UserRole::AUTHOR));

        $this->assertDatabaseMissing('posts', ['title' => 'Updating title']);
    }

    /** @test */
    public function it_allows_admins_to_create_update_and_delete_posts(): void
    {
        $this
            ->actingAs($adminUser = User::factory()->admin()->create())
            ->assertAuthenticated()
            ->assertTrue($adminUser->hasRole(UserRole::ADMIN));

        $this
            ->post(route('posts.store'), [
                'user_id'      => $adminUser->id,
                'title'        => 'My awesome post',
                'body'         => '## Some markdown body content'
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'My awesome post',
            'slug'  => Str::slug('My awesome post')
        ]);

        $post = Post::firstOrFail();

        $this
            ->patch(route('posts.update', $post->slug), [
                'title'   => 'Updated post',
                'user_id' => $post->user_id,
                'body'    => $post->body
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', ['title' => 'Updated post']);

        $this
            ->delete(route('posts.destroy', $post->slug))
            ->assertRedirect(route('posts.index'));

        $this->assertModelMissing($post);
    }

    /** @test */
    public function it_allows_authors_to_create_posts(): void
    {
        $this
            ->actingAs($authorUser = User::factory()->author()->create())
            ->assertAuthenticated()
            ->assertTrue($authorUser->hasRole(UserRole::AUTHOR));

        $this
            ->post(route('posts.store'), [
                'user_id'      => $authorUser->id,
                'title'        => 'This post was created by an author',
                'body'         => '## Some markdown body content'
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'This post was created by an author',
            'slug'  => Str::slug('This post was created by an author')
        ]);
    }

    /** @test */
    public function it_allows_authors_to_update_or_delete_owned_posts(): void
    {
        $this
            ->actingAs($authorUser = User::factory()->author()->create())
            ->assertAuthenticated()
            ->assertTrue($authorUser->hasRole(UserRole::AUTHOR));

        $post = Post::factory()->create(['user_id' => $authorUser->id]);

        $this
            ->patch(route('posts.update', $post->slug), [
                'title'   => 'My post was updated',
                'user_id' => $post->user_id,
                'body'    => $post->body
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas('posts', ['title' => 'My post was updated']);

        $this
            ->delete(route('posts.destroy', $post->slug))
            ->assertRedirect(route('posts.index'));

        $this->assertModelMissing($post);

        $notMyPost = Post::factory()->create();

        $this
            ->patch(route('posts.update', $notMyPost->slug), [])
            ->assertForbidden();

        $this
            ->delete(route('posts.destroy', $notMyPost->slug), [])
            ->assertForbidden();
    }

    /** @test */
    public function it_attaches_tags_when_save_a_post(): void
    {
        $this->actingAs($user = User::factory()->admin()->create());

        $this
            ->post(route('posts.store'), [
                'user_id' => $user->id,
                'title'   => 'A post with tags',
                'body'    => '## Some markdown body content',
                'tags'    => ['Laravel', 'PHP']
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertDatabaseHas(Tag::class, ['name' => 'Laravel']);

        $this->assertDatabaseHas(Tag::class, ['name' => 'PHP']);

        $post = Post::first();

        $this->assertCount(2, $post->tags);

        $this
            ->patch(route('posts.update', $post->slug), [
                'user_id' => $post->user_id,
                'title'   => $post->title,
                'body'    => $post->body,
                'tags'    => ['Programming']
            ])
            ->assertRedirect(route('posts.index'));

        $this->assertCount(1, $post->refresh()->tags);

        $this->assertEquals(['Programming'], $post->refresh()->tags->pluck('name')->all());
    }

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
