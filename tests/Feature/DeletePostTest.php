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
        $this->be(\factory(User::class)->create());
        $post = \factory(Post::class)->create();

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
}
