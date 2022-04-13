<?php

namespace Tests\Feature\Admin;

use App\Enums\UserRole;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Tests\TestCase;

class ManagePostsTest extends TestCase
{
    public function validationDataProvider(): array
    {
        return [
            'Test author is required'         => ['user_id', '', 'required'],
            'Test author is an integer'       => ['user_id', 'some-string', 'integer'],
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

        $this->actingAsAdmin();

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
    public function it_denies_authors_to_set_another_owner_while_creating_posts(): void
    {
        $authorA = User::factory()->author()->create();

        $this
            ->actingAs($authorB = User::factory()->author()->create())
            ->assertAuthenticated()
            ->assertTrue($authorB->hasRole(UserRole::AUTHOR));

        $this
            ->post(route('posts.store'), [
                'user_id'      => $authorA->id,
                'title'        => 'This post was created by AUTHOR B',
                'body'         => '## Some markdown body content'
            ])
            ->assertForbidden();

        $this->assertDatabaseMissing('posts', ['title' => 'This post was created by AUTHOR B']);
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
}
