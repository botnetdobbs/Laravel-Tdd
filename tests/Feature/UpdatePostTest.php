<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group view-edit-page
     * @test
     *
     * @return void
     */
    public function userShouldBeAbleToViewEditPage()
    {
        $user = \factory(User::class)->create();
        $this->be($user);
        $post = \factory(Post::class)->create(['user_id' => $user->id]);

        $response = $this->get("post/{$post->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Edit');
    }

    /**
     * @group update-post
     * @test
     *
     * @return void
     */
    public function aUserShouldBeAbleToUpdatePosts()
    {
        $user = \factory(User::class)->create();
        $this->be($user);
        $post = \factory(Post::class)->create(['user_id' => $user->id]);
        
        $updatePost = ['title' => 'Update Title', 'body' => 'Update description'];

        $response = $this->put("/post/{$post->id}", $updatePost);

        $response->assertStatus(302); // redirect to the specific post view
        $this->assertDatabaseHas('posts', ['title' => $updatePost['title']]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function unauthenticatedUsersCannotViewEditPage()
    {
        $post = \factory(Post::class)->create();

        $response = $this->get("post/{$post->id}/edit");

        $response->assertStatus(302); // redirect to login
    }

    /**
     * @group edit-non
     * @test
     *
     * @return void
     */
    public function userEditNonExistingPostReturns404()
    {
        $this->be(\factory(User::class)->create());
        $nonExistingPostID = 1;

        $response = $this->get("post/{$nonExistingPostID}/edit");

        $response->assertStatus(404);
    }

    /**
     * @group edit-non-owner
     * @test
     *
     * @return void
     */
    public function nonPostOwnerShouldNotBeAbleToAccessEditPage()
    {
        $user = \factory(User::class)->create();
        $user1 = \factory(User::class)->create(['email' => 'testmail@email.com']);
        $this->be($user);

        $post = \factory(Post::class)->create(['user_id' => $user1->id]);

        $response = $this->get("/post/{$post->id}/edit");

        $response->assertStatus(302);
    }
}
