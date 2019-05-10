<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @group delete-post
     * @test
     *
     * @return void
     */
    public function userCanDeletePost()
    {
        $user = \factory(User::class)->create();
        $this->be($user);
        $post = \factory(Post::class)->create(['user_id' => $user->id]);

        $response = $this->delete("/post/{$post->id}");

        $response->assertStatus(302);
        $this->assertDatabaseMissing('posts', ['title' => $post->title]);
    }

    /**
     * @group delete-non
     * @test
     *
     * @return void
     */
    public function userDeletingNonExistingArticleReturns404()
    {
        $this->be(\factory(User::class)->create());
        $nonExistingPostId = 9;

        $response = $this->delete("post/{$nonExistingPostId}");

        $response->assertStatus(404);
    }

    /**
     * @group non-owner-deletion
     * @test
     *
     * @return void
     */
    public function nonOwnerCannotDeletePost()
    {
        $user = \factory(User::class)->create();
        $user1 = \factory(User::class)->create(["email" => "email.test@email.com"]);
        $this->be($user);

        $post = \factory(Post::class)->create(['user_id' => $user1->id]);

        $response = $this->delete("/post/{$post->id}");

        $response->assertStatus(302);
    }
}
